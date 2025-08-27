import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="ChemLab - Laboratory Equipment Management System">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-white dark:from-gray-900 dark:to-gray-800">
                {/* Navigation */}
                <nav className="flex items-center justify-between px-6 py-4 lg:px-8">
                    <div className="flex items-center space-x-2">
                        <div className="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <span className="text-white font-bold text-lg">⚗️</span>
                        </div>
                        <span className="text-xl font-bold text-gray-900 dark:text-white">ChemLab</span>
                    </div>
                    <div className="flex items-center space-x-4">
                        {auth.user ? (
                            <Link
                                href={route('dashboard')}
                                className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors"
                            >
                                Dashboard
                            </Link>
                        ) : (
                            <>
                                <Link
                                    href={route('login')}
                                    className="text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white px-4 py-2 font-medium"
                                >
                                    Login
                                </Link>
                                <Link
                                    href={route('register')}
                                    className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors"
                                >
                                    Student Registration
                                </Link>
                            </>
                        )}
                    </div>
                </nav>

                {/* Hero Section */}
                <div className="px-6 py-16 text-center lg:px-8">
                    <div className="mx-auto max-w-4xl">
                        <h1 className="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl">
                            🧪 <span className="text-blue-600">ChemLab</span> System
                        </h1>
                        <p className="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                            Integrated Laboratory Equipment Lending and Return System
                            <br />
                            <span className="text-sm text-gray-500">Chemical Engineering Department, University of Indonesia</span>
                        </p>
                        <div className="mt-10 flex items-center justify-center gap-x-6">
                            {!auth.user && (
                                <>
                                    <Link
                                        href={route('register')}
                                        className="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold text-lg shadow-lg transition-all hover:shadow-xl"
                                    >
                                        Get Started
                                    </Link>
                                    <Link
                                        href={route('login')}
                                        className="text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white font-semibold text-lg"
                                    >
                                        Sign In →
                                    </Link>
                                </>
                            )}
                        </div>
                    </div>
                </div>

                {/* Features Section */}
                <div className="mx-auto max-w-7xl px-6 py-16 lg:px-8">
                    <div className="mx-auto max-w-2xl text-center">
                        <h2 className="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                            🚀 Key Features
                        </h2>
                        <p className="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                            Modern, integrated solution for laboratory equipment management
                        </p>
                    </div>
                    <div className="mx-auto mt-16 grid max-w-5xl grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-3xl mb-4">📋</div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">Equipment Lending</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Streamlined borrowing process with approval workflows and real-time tracking
                            </p>
                        </div>
                        <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-3xl mb-4">🔍</div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">Inventory Management</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Comprehensive equipment catalog with detailed specifications and status tracking
                            </p>
                        </div>
                        <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-3xl mb-4">✅</div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">JSA Compliance</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Mandatory Job Safety Analysis verification and SOP compliance checking
                            </p>
                        </div>
                        <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-3xl mb-4">📊</div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">Reports & Analytics</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Comprehensive reporting with charts, trends, and exportable data
                            </p>
                        </div>
                        <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-3xl mb-4">🔔</div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">Real-time Notifications</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Instant alerts for approvals, due dates, and important updates
                            </p>
                        </div>
                        <div className="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                            <div className="text-3xl mb-4">👥</div>
                            <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">Role-based Access</h3>
                            <p className="text-gray-600 dark:text-gray-300">
                                Secure access control for Admin, Lab Head, Assistant, Lecturer, and Student roles
                            </p>
                        </div>
                    </div>
                </div>

                {/* User Roles Section */}
                <div className="bg-gray-50 dark:bg-gray-900 py-16">
                    <div className="mx-auto max-w-7xl px-6 lg:px-8">
                        <div className="mx-auto max-w-2xl text-center">
                            <h2 className="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                                👨‍🔬 User Roles
                            </h2>
                            <p className="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                                Tailored access and functionality for each role in the laboratory ecosystem
                            </p>
                        </div>
                        <div className="mx-auto mt-16 grid max-w-5xl grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">
                            <div className="text-center">
                                <div className="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-2xl">👑</span>
                                </div>
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">Admin</h3>
                                <p className="text-sm text-gray-600 dark:text-gray-300 mt-2">System oversight & user management</p>
                            </div>
                            <div className="text-center">
                                <div className="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-2xl">🏛️</span>
                                </div>
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">Kepala Lab</h3>
                                <p className="text-sm text-gray-600 dark:text-gray-300 mt-2">Laboratory management & oversight</p>
                            </div>
                            <div className="text-center">
                                <div className="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-2xl">🔧</span>
                                </div>
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">Laboran</h3>
                                <p className="text-sm text-gray-600 dark:text-gray-300 mt-2">Equipment handling & approvals</p>
                            </div>
                            <div className="text-center">
                                <div className="w-16 h-16 bg-orange-100 dark:bg-orange-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-2xl">👨‍🏫</span>
                                </div>
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">Dosen</h3>
                                <p className="text-sm text-gray-600 dark:text-gray-300 mt-2">Lecture supervision & approvals</p>
                            </div>
                            <div className="text-center">
                                <div className="w-16 h-16 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-2xl">🎓</span>
                                </div>
                                <h3 className="text-lg font-semibold text-gray-900 dark:text-white">Mahasiswa</h3>
                                <p className="text-sm text-gray-600 dark:text-gray-300 mt-2">Equipment borrowing & usage</p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* How to Use Section */}
                <div className="mx-auto max-w-7xl px-6 py-16 lg:px-8">
                    <div className="mx-auto max-w-2xl text-center">
                        <h2 className="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                            📝 How to Use
                        </h2>
                        <p className="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                            Simple steps to get started with equipment borrowing
                        </p>
                    </div>
                    <div className="mx-auto mt-16 max-w-4xl">
                        <div className="grid grid-cols-1 gap-8 md:grid-cols-3">
                            <div className="text-center">
                                <div className="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">Register & Verify</h3>
                                <p className="text-gray-600 dark:text-gray-300">Create your account with UI email and get verified by admin</p>
                            </div>
                            <div className="text-center">
                                <div className="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">Browse & Request</h3>
                                <p className="text-gray-600 dark:text-gray-300">Find equipment, upload JSA, and submit your borrowing request</p>
                            </div>
                            <div className="text-center">
                                <div className="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">Use & Return</h3>
                                <p className="text-gray-600 dark:text-gray-300">Get approval, collect equipment, and return on time</p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Footer */}
                <footer className="bg-gray-900 text-white py-12">
                    <div className="mx-auto max-w-7xl px-6 lg:px-8">
                        <div className="text-center">
                            <div className="flex items-center justify-center space-x-2 mb-4">
                                <div className="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <span className="text-white text-sm">⚗️</span>
                                </div>
                                <span className="text-xl font-bold">ChemLab</span>
                            </div>
                            <p className="text-gray-400 mb-4">
                                Chemical Engineering Department<br />
                                University of Indonesia
                            </p>
                            <div className="flex justify-center space-x-6 text-sm text-gray-400">
                                <a href="#" className="hover:text-white">FAQ</a>
                                <a href="#" className="hover:text-white">Contact</a>
                                <a href="#" className="hover:text-white">Support</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}