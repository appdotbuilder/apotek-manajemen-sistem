<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // System Management
            ['name' => 'system.settings', 'display_name' => 'Kelola Pengaturan Sistem', 'module' => 'system'],
            ['name' => 'system.audit', 'display_name' => 'Lihat Audit Trail', 'module' => 'system'],
            ['name' => 'system.pharmacy-settings', 'display_name' => 'Kelola Pengaturan Apotek', 'module' => 'system'],
            
            // User Management
            ['name' => 'users.view', 'display_name' => 'Lihat Pengguna', 'module' => 'users'],
            ['name' => 'users.create', 'display_name' => 'Tambah Pengguna', 'module' => 'users'],
            ['name' => 'users.edit', 'display_name' => 'Edit Pengguna', 'module' => 'users'],
            ['name' => 'users.delete', 'display_name' => 'Hapus Pengguna', 'module' => 'users'],
            
            // Product Management
            ['name' => 'products.view', 'display_name' => 'Lihat Produk', 'module' => 'products'],
            ['name' => 'products.create', 'display_name' => 'Tambah Produk', 'module' => 'products'],
            ['name' => 'products.edit', 'display_name' => 'Edit Produk', 'module' => 'products'],
            ['name' => 'products.delete', 'display_name' => 'Hapus Produk', 'module' => 'products'],
            ['name' => 'products.kfa-mapping', 'display_name' => 'Pemetaan KFA', 'module' => 'products'],
            
            // Stock Management
            ['name' => 'stock.view', 'display_name' => 'Lihat Stok', 'module' => 'stock'],
            ['name' => 'stock.mutation', 'display_name' => 'Mutasi Stok', 'module' => 'stock'],
            ['name' => 'stock.adjustment', 'display_name' => 'Penyesuaian Stok', 'module' => 'stock'],
            ['name' => 'stock.return', 'display_name' => 'Retur ke Distributor', 'module' => 'stock'],
            
            // Sales
            ['name' => 'sales.create', 'display_name' => 'Penjualan', 'module' => 'sales'],
            ['name' => 'sales.view', 'display_name' => 'Lihat Penjualan', 'module' => 'sales'],
            ['name' => 'sales.reports', 'display_name' => 'Laporan Penjualan', 'module' => 'sales'],
            
            // Distributors
            ['name' => 'distributors.view', 'display_name' => 'Lihat Distributor', 'module' => 'distributors'],
            ['name' => 'distributors.create', 'display_name' => 'Tambah Distributor', 'module' => 'distributors'],
            ['name' => 'distributors.edit', 'display_name' => 'Edit Distributor', 'module' => 'distributors'],
            ['name' => 'distributors.delete', 'display_name' => 'Hapus Distributor', 'module' => 'distributors'],
            
            // Categories & Units
            ['name' => 'categories.manage', 'display_name' => 'Kelola Kategori', 'module' => 'master'],
            ['name' => 'units.manage', 'display_name' => 'Kelola Satuan', 'module' => 'master'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Create roles
        $superadmin = Role::create([
            'name' => 'superadmin',
            'display_name' => 'Super Administrator',
            'description' => 'Full system access and control'
        ]);

        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Manages transactions, distributors, reports, and stock'
        ]);

        $user = Role::create([
            'name' => 'user',
            'display_name' => 'Pengguna',
            'description' => 'Can perform sales and view stock'
        ]);

        // Assign permissions to roles
        
        // Superadmin gets all permissions
        $superadmin->permissions()->attach(Permission::all());

        // Admin permissions
        $adminPermissions = Permission::whereIn('name', [
            'products.view', 'products.create', 'products.edit', 'products.kfa-mapping',
            'stock.view', 'stock.mutation', 'stock.adjustment', 'stock.return',
            'sales.create', 'sales.view', 'sales.reports',
            'distributors.view', 'distributors.create', 'distributors.edit', 'distributors.delete',
            'categories.manage', 'units.manage'
        ])->get();
        $admin->permissions()->attach($adminPermissions);

        // User permissions
        $userPermissions = Permission::whereIn('name', [
            'sales.create',
            'stock.view'
        ])->get();
        $user->permissions()->attach($userPermissions);
    }
}