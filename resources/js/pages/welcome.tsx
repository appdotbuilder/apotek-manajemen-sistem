import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Sistem Informasi Apotek">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
                {/* Header */}
                <header className="bg-white/80 backdrop-blur-sm border-b border-gray-200 dark:bg-gray-900/80 dark:border-gray-700">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center py-4">
                            <div className="flex items-center space-x-3">
                                <div className="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <span className="text-white font-bold text-lg">💊</span>
                                </div>
                                <div>
                                    <h1 className="text-xl font-bold text-gray-900 dark:text-white">SIA</h1>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">Sistem Informasi Apotek</p>
                                </div>
                            </div>
                            <nav className="flex items-center space-x-4">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors"
                                    >
                                        Dashboard
                                    </Link>
                                ) : (
                                    <div className="flex items-center space-x-3">
                                        <Link
                                            href={route('login')}
                                            className="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white px-4 py-2 rounded-lg transition-colors"
                                        >
                                            Masuk
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors"
                                        >
                                            Daftar
                                        </Link>
                                    </div>
                                )}
                            </nav>
                        </div>
                    </div>
                </header>

                {/* Hero Section */}
                <section className="py-20 px-4 text-center">
                    <div className="max-w-4xl mx-auto">
                        <h1 className="text-5xl font-bold text-gray-900 dark:text-white mb-6">
                            🏥 Sistem Informasi Apotek
                        </h1>
                        <p className="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                            Solusi lengkap untuk mengelola apotek modern dengan teknologi terdepan. 
                            Kelola inventori, penjualan, dan laporan dengan mudah dan efisien.
                        </p>
                        <div className="flex justify-center space-x-4">
                            {!auth.user && (
                                <>
                                    <Link
                                        href={route('register')}
                                        className="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium text-lg transition-colors shadow-lg"
                                    >
                                        Mulai Sekarang
                                    </Link>
                                    <Link
                                        href={route('login')}
                                        className="bg-white hover:bg-gray-50 text-gray-900 px-8 py-3 rounded-lg font-medium text-lg transition-colors shadow-lg border border-gray-200"
                                    >
                                        Masuk ke Akun
                                    </Link>
                                </>
                            )}
                        </div>
                    </div>
                </section>

                {/* Features Section */}
                <section className="py-16 px-4">
                    <div className="max-w-6xl mx-auto">
                        <h2 className="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">
                            ✨ Fitur Unggulan
                        </h2>
                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            {/* Multi-User System */}
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">👥</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    Multi-User & Role
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Sistem peran pengguna (Superadmin, Admin, User) dengan hak akses yang berbeda untuk keamanan optimal.
                                </p>
                            </div>

                            {/* Inventory Management */}
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">📦</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    Manajemen Inventori
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Kelola stok obat dengan multi-batch, multi-distributor, tanggal kedaluwarsa, dan peringatan stok habis.
                                </p>
                            </div>

                            {/* Sales System */}
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">💰</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    Sistem Penjualan
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Penjualan real-time dengan berbagai metode pembayaran, cetak struk otomatis, dan pencatatan resep dokter.
                                </p>
                            </div>

                            {/* KFA Integration */}
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">🔗</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    Integrasi KFA
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Pemetaan produk lokal ke referensi KFA (Katalog Farmasi dan Alkes) untuk standarisasi data.
                                </p>
                            </div>

                            {/* Reporting */}
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">📊</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    Laporan Lengkap
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Laporan penjualan, keuntungan, stok, dan analisis bisnis dengan export ke PDF dan Excel.
                                </p>
                            </div>

                            {/* Audit Trail */}
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
                                <div className="w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mb-4">
                                    <span className="text-2xl">🔍</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    Audit Trail
                                </h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Pencatatan lengkap semua aktivitas sistem untuk keamanan dan tracking perubahan data.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                {/* User Roles Section */}
                <section className="py-16 px-4 bg-white/50 dark:bg-gray-800/50">
                    <div className="max-w-4xl mx-auto">
                        <h2 className="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">
                            🎭 Peran Pengguna
                        </h2>
                        <div className="grid md:grid-cols-3 gap-6">
                            <div className="text-center p-6">
                                <div className="w-20 h-20 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-3xl">👑</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Superadmin</h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Kontrol penuh sistem, pengaturan global, konfigurasi apotek, dan audit trail.
                                </p>
                            </div>
                            <div className="text-center p-6">
                                <div className="w-20 h-20 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-3xl">⚙️</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">Admin</h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Mengelola transaksi, distributor, laporan, mutasi stok, dan pemetaan KFA.
                                </p>
                            </div>
                            <div className="text-center p-6">
                                <div className="w-20 h-20 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-3xl">🧑‍💼</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">User/Kasir</h3>
                                <p className="text-gray-600 dark:text-gray-300">
                                    Melakukan penjualan dan melihat data stok untuk operasional harian.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                {/* Technology Section */}
                <section className="py-16 px-4">
                    <div className="max-w-4xl mx-auto text-center">
                        <h2 className="text-3xl font-bold text-gray-900 dark:text-white mb-8">
                            💻 Teknologi Modern
                        </h2>
                        <p className="text-lg text-gray-600 dark:text-gray-300 mb-8">
                            Dibangun dengan teknologi terdepan untuk performa optimal, keamanan tinggi, dan kemudahan penggunaan.
                        </p>
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
                            <div className="flex flex-col items-center">
                                <div className="w-16 h-16 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center mb-3">
                                    <span className="text-2xl font-bold">L</span>
                                </div>
                                <span className="text-sm font-medium text-gray-700 dark:text-gray-300">Laravel</span>
                            </div>
                            <div className="flex flex-col items-center">
                                <div className="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-3">
                                    <span className="text-2xl font-bold">R</span>
                                </div>
                                <span className="text-sm font-medium text-gray-700 dark:text-gray-300">React</span>
                            </div>
                            <div className="flex flex-col items-center">
                                <div className="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-3">
                                    <span className="text-2xl font-bold">I</span>
                                </div>
                                <span className="text-sm font-medium text-gray-700 dark:text-gray-300">Inertia.js</span>
                            </div>
                            <div className="flex flex-col items-center">
                                <div className="w-16 h-16 bg-cyan-100 dark:bg-cyan-900 rounded-lg flex items-center justify-center mb-3">
                                    <span className="text-2xl font-bold">T</span>
                                </div>
                                <span className="text-sm font-medium text-gray-700 dark:text-gray-300">Tailwind</span>
                            </div>
                        </div>
                    </div>
                </section>

                {/* CTA Section */}
                {!auth.user && (
                    <section className="py-16 px-4 bg-blue-600 dark:bg-blue-800">
                        <div className="max-w-4xl mx-auto text-center">
                            <h2 className="text-3xl font-bold text-white mb-6">
                                Siap Mendigitalkan Apotek Anda? 🚀
                            </h2>
                            <p className="text-xl text-blue-100 mb-8">
                                Bergabunglah dengan ribuan apotek yang telah mempercayai sistem kami untuk operasional sehari-hari.
                            </p>
                            <Link
                                href={route('register')}
                                className="bg-white hover:bg-gray-100 text-blue-600 px-8 py-3 rounded-lg font-medium text-lg transition-colors shadow-lg inline-block"
                            >
                                Daftar Sekarang - Gratis! 🎉
                            </Link>
                        </div>
                    </section>
                )}

                {/* Footer */}
                <footer className="bg-gray-900 text-white py-8 px-4">
                    <div className="max-w-4xl mx-auto text-center">
                        <div className="flex justify-center items-center space-x-3 mb-4">
                            <div className="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                <span className="text-white font-bold">💊</span>
                            </div>
                            <span className="text-lg font-semibold">Sistem Informasi Apotek</span>
                        </div>
                        <p className="text-gray-400 mb-4">
                            Solusi digital terpercaya untuk apotek modern di Indonesia.
                        </p>
                        <p className="text-sm text-gray-500">
                            © 2024 Sistem Informasi Apotek. Dibuat dengan ❤️ menggunakan Laravel & React.
                        </p>
                    </div>
                </footer>
            </div>
        </>
    );
}