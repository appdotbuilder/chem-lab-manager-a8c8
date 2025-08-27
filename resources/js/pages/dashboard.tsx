import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head } from '@inertiajs/react';

interface User {
    id: number;
    name: string;
    email: string;
    role: {
        name: string;
        display_name: string;
    };
}

interface Stats {
    [key: string]: number;
}

interface ChartData {
    equipmentByCategory: { [key: string]: number };
    monthlyLoans: { [key: string]: number };
}

interface ActivityItem {
    name?: string;
    borrower?: { name?: string };
    email?: string;
    status?: string;
}

interface RecentActivity {
    [key: string]: ActivityItem[];
}

interface Props {
    user: User;
    role: string;
    stats: Stats;
    chartData: ChartData;
    recentActivity: RecentActivity;
    [key: string]: unknown;
}

export default function Dashboard({ user, role, stats, chartData, recentActivity }: Props) {
    const getRoleIcon = (role: string) => {
        switch (role) {
            case 'admin': return '👑';
            case 'kepala_lab': return '🏛️';
            case 'laboran': return '🔧';
            case 'dosen': return '👨‍🏫';
            case 'mahasiswa': return '🎓';
            default: return '👤';
        }
    };

    const getStatCards = () => {
        const baseCards = Object.entries(stats).map(([key, value]) => {
            let title = '';
            let icon = '';
            let color = '';

            switch (key) {
                case 'totalUsers':
                    title = 'Total Users';
                    icon = '👥';
                    color = 'bg-blue-500';
                    break;
                case 'totalLabs':
                    title = 'Total Labs';
                    icon = '🏢';
                    color = 'bg-green-500';
                    break;
                case 'totalEquipment':
                    title = 'Total Equipment';
                    icon = '⚙️';
                    color = 'bg-purple-500';
                    break;
                case 'totalLoanRequests':
                    title = 'Total Loan Requests';
                    icon = '📋';
                    color = 'bg-indigo-500';
                    break;
                case 'pendingRegistrations':
                    title = 'Pending Registrations';
                    icon = '⏳';
                    color = 'bg-yellow-500';
                    break;
                case 'activeLoans':
                    title = 'Active Loans';
                    icon = '📤';
                    color = 'bg-green-500';
                    break;
                case 'overdueLoans':
                    title = 'Overdue Loans';
                    icon = '⚠️';
                    color = 'bg-red-500';
                    break;
                case 'availableEquipment':
                    title = 'Available Equipment';
                    icon = '✅';
                    color = 'bg-emerald-500';
                    break;
                case 'myLabs':
                    title = 'My Labs';
                    icon = '🏢';
                    color = 'bg-blue-500';
                    break;
                case 'labEquipment':
                    title = 'Lab Equipment';
                    icon = '🔬';
                    color = 'bg-purple-500';
                    break;
                case 'pendingApprovals':
                    title = 'Pending Approvals';
                    icon = '📋';
                    color = 'bg-yellow-500';
                    break;
                case 'maintenanceEquipment':
                    title = 'Maintenance Equipment';
                    icon = '🔧';
                    color = 'bg-orange-500';
                    break;
                case 'pendingSupervisions':
                    title = 'Pending Supervisions';
                    icon = '👨‍🏫';
                    color = 'bg-blue-500';
                    break;
                case 'activelySupervisedLoans':
                    title = 'Active Supervisions';
                    icon = '📚';
                    color = 'bg-green-500';
                    break;
                case 'totalSupervisions':
                    title = 'Total Supervisions';
                    icon = '📊';
                    color = 'bg-indigo-500';
                    break;
                case 'studentsSupervised':
                    title = 'Students Supervised';
                    icon = '👨‍🎓';
                    color = 'bg-purple-500';
                    break;
                case 'myLoanRequests':
                    title = 'My Loan Requests';
                    icon = '📋';
                    color = 'bg-blue-500';
                    break;
                case 'activeLoanRequests':
                    title = 'Active Loans';
                    icon = '📤';
                    color = 'bg-green-500';
                    break;
                case 'pendingLoanRequests':
                    title = 'Pending Requests';
                    icon = '⏳';
                    color = 'bg-yellow-500';
                    break;
                case 'completedLoanRequests':
                    title = 'Completed Requests';
                    icon = '✅';
                    color = 'bg-emerald-500';
                    break;
                case 'availableLabs':
                    title = 'Available Labs';
                    icon = '🏢';
                    color = 'bg-cyan-500';
                    break;
                default:
                    title = key.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase());
                    icon = '📊';
                    color = 'bg-gray-500';
            }

            return { key, title, icon, color, value };
        });

        return baseCards;
    };

    return (
        <AppShell>
            <Head title="Dashboard" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div className="flex items-center space-x-4">
                        <div className="text-4xl">{getRoleIcon(role)}</div>
                        <div>
                            <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                                Welcome back, {user.name}!
                            </h1>
                            <p className="text-gray-600 dark:text-gray-300">
                                {user.role.display_name} • ChemLab System
                            </p>
                        </div>
                    </div>
                </div>

                {/* Statistics Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {getStatCards().map((stat) => (
                        <div key={stat.key} className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                            <div className="flex items-center">
                                <div className={`${stat.color} rounded-lg p-3 text-white text-xl`}>
                                    {stat.icon}
                                </div>
                                <div className="ml-4">
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-300">
                                        {stat.title}
                                    </p>
                                    <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                        {stat.value}
                                    </p>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>

                {/* Charts Row */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Equipment by Category Chart */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                            📊 Equipment by Category
                        </h3>
                        <div className="space-y-3">
                            {Object.entries(chartData.equipmentByCategory).map(([category, count]) => (
                                <div key={category} className="flex items-center justify-between">
                                    <span className="text-sm text-gray-600 dark:text-gray-300">{category}</span>
                                    <div className="flex items-center space-x-2">
                                        <div className="w-24 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                            <div 
                                                className="bg-blue-600 h-2 rounded-full" 
                                                style={{ width: `${Math.min((count / Math.max(...Object.values(chartData.equipmentByCategory))) * 100, 100)}%` }}
                                            ></div>
                                        </div>
                                        <span className="text-sm font-medium text-gray-900 dark:text-white">{count}</span>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* Monthly Loans Chart */}
                    <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                            📈 Monthly Loan Requests
                        </h3>
                        <div className="space-y-3">
                            {Object.entries(chartData.monthlyLoans).map(([month, count]) => (
                                <div key={month} className="flex items-center justify-between">
                                    <span className="text-sm text-gray-600 dark:text-gray-300">{month}</span>
                                    <div className="flex items-center space-x-2">
                                        <div className="w-24 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                            <div 
                                                className="bg-green-600 h-2 rounded-full" 
                                                style={{ width: `${Math.min((count / Math.max(...Object.values(chartData.monthlyLoans), 1)) * 100, 100)}%` }}
                                            ></div>
                                        </div>
                                        <span className="text-sm font-medium text-gray-900 dark:text-white">{count}</span>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Recent Activity */}
                <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        🕒 Recent Activity
                    </h3>
                    
                    {Object.keys(recentActivity).length === 0 ? (
                        <p className="text-gray-500 dark:text-gray-400 text-center py-8">
                            No recent activity to display
                        </p>
                    ) : (
                        <div className="space-y-4">
                            {Object.entries(recentActivity).map(([key, items]) => (
                                <div key={key}>
                                    <h4 className="text-md font-medium text-gray-800 dark:text-gray-200 mb-2 capitalize">
                                        {key.replace(/([A-Z])/g, ' $1')}
                                    </h4>
                                    {items.length === 0 ? (
                                        <p className="text-sm text-gray-500 dark:text-gray-400 ml-4">No items</p>
                                    ) : (
                                        <div className="space-y-2 ml-4">
                                            {items.slice(0, 3).map((item, index) => (
                                                <div key={index} className="flex items-center space-x-3 text-sm">
                                                    <div className="w-2 h-2 bg-blue-500 rounded-full"></div>
                                                    <span className="text-gray-700 dark:text-gray-300">
                                                        {item.name || item.borrower?.name || 'Activity'}
                                                    </span>
                                                    <span className="text-gray-500 dark:text-gray-400">
                                                        {item.email || item.status || ''}
                                                    </span>
                                                </div>
                                            ))}
                                        </div>
                                    )}
                                </div>
                            ))}
                        </div>
                    )}
                </div>

                {/* Quick Actions */}
                <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        ⚡ Quick Actions
                    </h3>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                        {role === 'mahasiswa' && (
                            <>
                                <button className="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <span className="text-2xl mb-2">📋</span>
                                    <span className="text-sm font-medium text-gray-900 dark:text-white">New Request</span>
                                </button>
                                <button className="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <span className="text-2xl mb-2">🔍</span>
                                    <span className="text-sm font-medium text-gray-900 dark:text-white">Browse Equipment</span>
                                </button>
                            </>
                        )}
                        
                        {(role === 'laboran' || role === 'kepala_lab') && (
                            <>
                                <button className="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <span className="text-2xl mb-2">✅</span>
                                    <span className="text-sm font-medium text-gray-900 dark:text-white">Approve Requests</span>
                                </button>
                                <button className="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <span className="text-2xl mb-2">📦</span>
                                    <span className="text-sm font-medium text-gray-900 dark:text-white">Manage Equipment</span>
                                </button>
                            </>
                        )}
                        
                        {role === 'admin' && (
                            <>
                                <button className="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <span className="text-2xl mb-2">👥</span>
                                    <span className="text-sm font-medium text-gray-900 dark:text-white">Manage Users</span>
                                </button>
                                <button className="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <span className="text-2xl mb-2">📊</span>
                                    <span className="text-sm font-medium text-gray-900 dark:text-white">Generate Reports</span>
                                </button>
                            </>
                        )}

                        <button className="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <span className="text-2xl mb-2">🏢</span>
                            <span className="text-sm font-medium text-gray-900 dark:text-white">View Labs</span>
                        </button>
                        <button className="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <span className="text-2xl mb-2">📞</span>
                            <span className="text-sm font-medium text-gray-900 dark:text-white">Get Help</span>
                        </button>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}