<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\PharmacySetting;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get pharmacy settings
        $pharmacySettings = PharmacySetting::getInstance();
        
        // Get dashboard stats
        $todayRevenue = Sale::completed()->whereDate('sale_date', today())->sum('total_amount');
        $stats = [
            'total_products' => Product::active()->count(),
            'low_stock_products' => 0, // Simplified for now
            'today_sales' => Sale::completed()->whereDate('sale_date', today())->count(),
            'today_revenue' => $todayRevenue ?: 0,
        ];
        
        // Get recent sales (last 10)
        $recentSales = Sale::completed()
            ->with(['createdBy:id,name'])
            ->latest('sale_date')
            ->take(10)
            ->get()
            ->map(function ($sale) {
                return [
                    'id' => $sale->id,
                    'invoice_number' => $sale->invoice_number,
                    'customer_name' => $sale->customer_name ?? 'Umum',
                    'total_amount' => $sale->total_amount,
                    'sale_date' => $sale->sale_date->format('d/m/Y H:i'),
                    'created_by' => $sale->createdBy->name,
                ];
            });
        
        // Get low stock products - simplified for now
        $lowStockProductsDisplay = collect([]);
        
        // Get recent audit logs (for superadmin only)
        $recentAudits = [];
        if ($user->isSuperadmin()) {
            $recentAudits = AuditLog::with('user:id,name')
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($audit) {
                    return [
                        'id' => $audit->id,
                        'action' => $audit->action,
                        'model' => $audit->model,
                        'user_name' => $audit->user ? $audit->user->name : 'System',
                        'created_at' => $audit->created_at->format('d/m/Y H:i'),
                    ];
                });
        }
        
        return Inertia::render('dashboard', [
            'pharmacy' => [
                'name' => $pharmacySettings->name,
                'address' => $pharmacySettings->address,
                'phone' => $pharmacySettings->phone,
            ],
            'stats' => $stats,
            'recent_sales' => $recentSales,
            'low_stock_products' => $lowStockProductsDisplay,
            'recent_audits' => $recentAudits,
            'user_permissions' => [
                'can_view_audit' => $user->hasPermission('system.audit'),
                'can_manage_sales' => $user->hasPermission('sales.create'),
                'can_view_reports' => $user->hasPermission('sales.reports'),
                'can_manage_products' => $user->hasPermission('products.view'),
                'can_manage_stock' => $user->hasPermission('stock.view'),
            ],
        ]);
    }
}