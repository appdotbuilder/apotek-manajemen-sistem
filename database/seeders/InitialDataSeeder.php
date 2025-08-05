<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Distributor;
use App\Models\PharmacySetting;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create pharmacy settings
        PharmacySetting::create([
            'name' => 'Apotek Sehat Bersama',
            'address' => 'Jl. Kesehatan Raya No. 123, Jakarta Pusat 10110',
            'phone' => '021-12345678',
            'email' => 'info@apoteksehat.com',
            'low_stock_threshold' => 20,
            'notification_recipients' => ['admin@apoteksehat.com', 'manager@apoteksehat.com'],
        ]);

        // Create default users
        $superadminRole = Role::where('name', 'superadmin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@apotek.com',
            'password' => Hash::make('password'),
            'role_id' => $superadminRole->id,
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@apotek.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir1@apotek.com',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
            'is_active' => true,
        ]);

        // Create units
        $units = [
            ['name' => 'Box', 'code' => 'BOX', 'description' => 'Kemasan box/dus'],
            ['name' => 'Strip', 'code' => 'STRIP', 'description' => 'Kemasan strip'],
            ['name' => 'Tablet', 'code' => 'TAB', 'description' => 'Tablet/kapsul satuan'],
            ['name' => 'Botol', 'code' => 'BTL', 'description' => 'Kemasan botol'],
            ['name' => 'Sachet', 'code' => 'SCH', 'description' => 'Kemasan sachet'],
            ['name' => 'Tube', 'code' => 'TUBE', 'description' => 'Kemasan tube'],
            ['name' => 'Vial', 'code' => 'VIAL', 'description' => 'Kemasan vial/ampul'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }

        // Create categories
        $categories = [
            ['name' => 'Obat Keras', 'code' => 'KERAS', 'type' => 'obat_keras', 'description' => 'Obat yang hanya dapat diperoleh dengan resep dokter'],
            ['name' => 'Obat Bebas', 'code' => 'BEBAS', 'type' => 'obat_bebas', 'description' => 'Obat yang dapat dibeli tanpa resep dokter'],
            ['name' => 'Obat Bebas Terbatas', 'code' => 'BEBAS_TERBATAS', 'type' => 'obat_bebas', 'description' => 'Obat yang dapat dibeli tanpa resep dengan batasan tertentu'],
            ['name' => 'Alat Kesehatan', 'code' => 'ALKES', 'type' => 'alat_kesehatan', 'description' => 'Peralatan dan perlengkapan kesehatan'],
            ['name' => 'Vitamin & Suplemen', 'code' => 'VITAMIN', 'type' => 'vitamin', 'description' => 'Vitamin dan suplemen kesehatan'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create distributors
        $distributors = [
            [
                'name' => 'PT. Kimia Farma Trading & Distribution',
                'code' => 'KFTD',
                'address' => 'Jl. Veteran No. 9, Jakarta Pusat',
                'phone' => '021-3847301',
                'email' => 'sales@kimiafarma.co.id',
                'contact_person' => 'Budi Santoso',
            ],
            [
                'name' => 'PT. Pharos Indonesia',
                'code' => 'PHAROS',
                'address' => 'Jl. Letjen S. Parman Kav. 12, Jakarta Barat',
                'phone' => '021-5694223',
                'email' => 'info@pharos.co.id',
                'contact_person' => 'Sari Dewi',
            ],
            [
                'name' => 'PT. Enseval Putera Megatrading',
                'code' => 'EPM',
                'address' => 'Jl. Letjen Suprapto No. 1, Jakarta Pusat',
                'phone' => '021-4248300',
                'email' => 'customer@enseval.com',
                'contact_person' => 'Ahmad Fauzi',
            ],
        ];

        foreach ($distributors as $distributor) {
            Distributor::create($distributor);
        }

        // Create sample products with stock
        $tabletUnit = Unit::where('code', 'TAB')->first();
        $stripUnit = Unit::where('code', 'STRIP')->first();
        $botolUnit = Unit::where('code', 'BTL')->first();
        $tubeUnit = Unit::where('code', 'TUBE')->first();

        $obatKerasCategory = Category::where('code', 'KERAS')->first();
        $obatBebasCategory = Category::where('code', 'BEBAS')->first();
        $vitaminCategory = Category::where('code', 'VITAMIN')->first();

        $kimiaFarma = Distributor::where('code', 'KFTD')->first();
        $pharos = Distributor::where('code', 'PHAROS')->first();
        $enseval = Distributor::where('code', 'EPM')->first();

        $products = [
            [
                'name' => 'Paracetamol 500mg',
                'code' => 'PCT500',
                'kfa_code' => 'KFA001',
                'description' => 'Obat penurun panas dan pereda nyeri',
                'category_id' => $obatBebasCategory->id,
                'unit_id' => $tabletUnit->id,
                'base_price' => 500,
                'selling_price' => 750,
                'min_stock' => 50,
                'stocks' => [
                    [
                        'distributor_id' => $kimiaFarma->id,
                        'batch_number' => 'PCT001',
                        'expiry_date' => '2025-12-31',
                        'cost_price' => 500,
                        'selling_price' => 750,
                        'current_stock' => 100,
                        'initial_stock' => 100,
                    ]
                ]
            ],
            [
                'name' => 'Amoxicillin 500mg',
                'code' => 'AMX500',
                'kfa_code' => 'KFA002',
                'description' => 'Antibiotik untuk infeksi bakteri',
                'category_id' => $obatKerasCategory->id,
                'unit_id' => $tabletUnit->id,
                'base_price' => 1200,
                'selling_price' => 1800,
                'min_stock' => 30,
                'stocks' => [
                    [
                        'distributor_id' => $pharos->id,
                        'batch_number' => 'AMX001',
                        'expiry_date' => '2025-10-15',
                        'cost_price' => 1200,
                        'selling_price' => 1800,
                        'current_stock' => 80,
                        'initial_stock' => 80,
                    ]
                ]
            ],
            [
                'name' => 'Betadine Solution 60ml',
                'code' => 'BTD60',
                'kfa_code' => 'KFA003',
                'description' => 'Antiseptik untuk luka luar',
                'category_id' => $obatBebasCategory->id,
                'unit_id' => $botolUnit->id,
                'base_price' => 15000,
                'selling_price' => 22500,
                'min_stock' => 20,
                'stocks' => [
                    [
                        'distributor_id' => $enseval->id,
                        'batch_number' => 'BTD001',
                        'expiry_date' => '2026-05-20',
                        'cost_price' => 15000,
                        'selling_price' => 22500,
                        'current_stock' => 45,
                        'initial_stock' => 45,
                    ]
                ]
            ],
            [
                'name' => 'Vitamin C 500mg',
                'code' => 'VTC500',
                'kfa_code' => 'KFA004',
                'description' => 'Suplemen vitamin C untuk daya tahan tubuh',
                'category_id' => $vitaminCategory->id,
                'unit_id' => $tabletUnit->id,
                'base_price' => 300,
                'selling_price' => 450,
                'min_stock' => 40,
                'stocks' => [
                    [
                        'distributor_id' => $kimiaFarma->id,
                        'batch_number' => 'VTC001',
                        'expiry_date' => '2025-08-30',
                        'cost_price' => 300,
                        'selling_price' => 450,
                        'current_stock' => 15,  // Low stock to test alerts
                        'initial_stock' => 60,
                    ]
                ]
            ],
            [
                'name' => 'Salep Hydrocortisone 10g',
                'code' => 'HYD10',
                'kfa_code' => 'KFA005',
                'description' => 'Salep untuk peradangan kulit',
                'category_id' => $obatKerasCategory->id,
                'unit_id' => $tubeUnit->id,
                'base_price' => 8000,
                'selling_price' => 12000,
                'min_stock' => 25,
                'stocks' => [
                    [
                        'distributor_id' => $pharos->id,
                        'batch_number' => 'HYD001',
                        'expiry_date' => '2025-03-15',
                        'cost_price' => 8000,
                        'selling_price' => 12000,
                        'current_stock' => 35,
                        'initial_stock' => 35,
                    ]
                ]
            ]
        ];

        foreach ($products as $productData) {
            $stocks = $productData['stocks'];
            unset($productData['stocks']);
            
            $product = Product::create($productData);
            
            foreach ($stocks as $stockData) {
                $stockData['product_id'] = $product->id;
                ProductStock::create($stockData);
            }
        }
    }
}