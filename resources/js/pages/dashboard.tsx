import { Head } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';

interface Props {
    pharmacy: {
        name: string;
        address: string;
        phone: string;
    };
    stats: {
        total_products: number;
        low_stock_products: number;
        today_sales: number;
        today_revenue: number;
    };
    recent_sales: Array<{
        id: number;
        invoice_number: string;
        customer_name: string;
        total_amount: number;
        sale_date: string;
        created_by: string;
    }>;
    low_stock_products: Array<{
        id: number;
        name: string;
        code: string;
        category: string;
        unit: string;
        current_stock: number;
        min_stock: number;
    }>;
    recent_audits: Array<{
        id: number;
        action: string;
        model: string;
        user_name: string;
        created_at: string;
    }>;
    user_permissions: {
        can_view_audit: boolean;
        can_manage_sales: boolean;
        can_view_reports: boolean;
        can_manage_products: boolean;
        can_manage_stock: boolean;
    };
    [key: string]: unknown;
}

export default function Dashboard({ 
    pharmacy, 
    stats, 
    recent_sales, 
    low_stock_products, 
    recent_audits, 
    user_permissions 
}: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(amount);
    };

    return (
        <AppShell>
            <Head title="Dashboard - Apotek" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                    <div className="flex items-center justify-between">
                        <div>
                            <h1 className="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                🏥 {pharmacy.name}
                            </h1>
                            <p className="text-gray-600 dark:text-gray-400 mt-1">
                                📍 {pharmacy.address} • 📞 {pharmacy.phone}
                            </p>
                        </div>
                        <div className="text-right">
                            <p className="text-sm text-gray-500 dark:text-gray-400">
                                {new Date().toLocaleDateString('id-ID', { 
                                    weekday: 'long', 
                                    year: 'numeric', 
                                    month: 'long', 
                                    day: 'numeric' 
                                })}
                            </p>
                        </div>
                    </div>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div className="flex items-center">
                            <div className="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <span className="text-2xl">📦</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Total Produk</p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">{stats.total_products}</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div className="flex items-center">
                            <div className="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center">
                                <span className="text-2xl">⚠️</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Stok Menipis</p>
                                <p className="text-2xl font-bold text-red-600 dark:text-red-400">{stats.low_stock_products}</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div className="flex items-center">
                            <div className="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                <span className="text-2xl">🛒</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Penjualan Hari Ini</p>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">{stats.today_sales}</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div className="flex items-center">
                            <div className="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                                <span className="text-2xl">💰</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Omzet Hari Ini</p>
                                <p className="text-lg font-bold text-gray-900 dark:text-white">
                                    {formatCurrency(stats.today_revenue)}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Recent Sales */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h2 className="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                🧾 Penjualan Terbaru
                            </h2>
                        </div>
                        <div className="p-6">
                            {recent_sales.length > 0 ? (
                                <div className="space-y-4">
                                    {recent_sales.slice(0, 5).map((sale) => (
                                        <div key={sale.id} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-white">
                                                    {sale.invoice_number}
                                                </p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                                    {sale.customer_name} • {sale.sale_date}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="font-medium text-green-600 dark:text-green-400">
                                                    {formatCurrency(sale.total_amount)}
                                                </p>
                                                <p className="text-xs text-gray-500">{sale.created_by}</p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <p className="text-gray-500 dark:text-gray-400 text-center py-4">
                                    Belum ada penjualan hari ini
                                </p>
                            )}
                        </div>
                    </div>

                    {/* Low Stock Products */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h2 className="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                ⚠️ Produk Stok Menipis
                            </h2>
                        </div>
                        <div className="p-6">
                            {low_stock_products.length > 0 ? (
                                <div className="space-y-4">
                                    {low_stock_products.slice(0, 5).map((product) => (
                                        <div key={product.id} className="flex items-center justify-between p-3 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-white">
                                                    {product.name}
                                                </p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                                    {product.code} • {product.category}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="font-medium text-red-600 dark:text-red-400">
                                                    {product.current_stock} {product.unit}
                                                </p>
                                                <p className="text-xs text-gray-500">
                                                    Min: {product.min_stock}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <p className="text-gray-500 dark:text-gray-400 text-center py-4">
                                    ✅ Semua produk stoknya aman
                                </p>
                            )}
                        </div>
                    </div>
                </div>

                {/* Audit Trail (Superadmin only) */}
                {user_permissions.can_view_audit && recent_audits.length > 0 && (
                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                        <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                            <h2 className="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                🔍 Aktivitas Terbaru (Audit Trail)
                            </h2>
                        </div>
                        <div className="p-6">
                            <div className="space-y-3">
                                {recent_audits.slice(0, 5).map((audit) => (
                                    <div key={audit.id} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div>
                                            <p className="font-medium text-gray-900 dark:text-white">
                                                {audit.action} - {audit.model}
                                            </p>
                                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                                oleh {audit.user_name}
                                            </p>
                                        </div>
                                        <p className="text-xs text-gray-500">{audit.created_at}</p>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                )}

                {/* Quick Actions */}
                <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                        ⚡ Aksi Cepat
                    </h2>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                        {user_permissions.can_manage_sales && (
                            <button className="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800 hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors">
                                <div className="text-2xl mb-2">🛒</div>
                                <div className="text-sm font-medium text-blue-900 dark:text-blue-100">Penjualan Baru</div>
                            </button>
                        )}
                        {user_permissions.can_manage_products && (
                            <button className="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800 hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors">
                                <div className="text-2xl mb-2">📦</div>
                                <div className="text-sm font-medium text-green-900 dark:text-green-100">Kelola Produk</div>
                            </button>
                        )}
                        {user_permissions.can_manage_stock && (
                            <button className="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800 hover:bg-yellow-100 dark:hover:bg-yellow-900/30 transition-colors">
                                <div className="text-2xl mb-2">📊</div>
                                <div className="text-sm font-medium text-yellow-900 dark:text-yellow-100">Mutasi Stok</div>
                            </button>
                        )}
                        {user_permissions.can_view_reports && (
                            <button className="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg border border-purple-200 dark:border-purple-800 hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors">
                                <div className="text-2xl mb-2">📈</div>
                                <div className="text-sm font-medium text-purple-900 dark:text-purple-100">Laporan</div>
                            </button>
                        )}
                    </div>
                </div>
            </div>
        </AppShell>
    );
}