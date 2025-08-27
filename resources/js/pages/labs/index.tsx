import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head, Link } from '@inertiajs/react';

interface Lab {
    id: number;
    name: string;
    code: string;
    location: string;
    capacity: number;
    opening_time: string;
    closing_time: string;
    description: string;
    image_path?: string;
    head_of_lab?: {
        name: string;
    };
    laboran?: {
        name: string;
    };
    equipment: Array<{
        id: number;
        status: string;
    }>;
}

interface PaginatedLabs {
    data: Lab[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

interface Props {
    labs: PaginatedLabs;
    [key: string]: unknown;
}

export default function LabsIndex({ labs }: Props) {
    const getEquipmentStats = (equipment: Lab['equipment']) => {
        const total = equipment.length;
        const available = equipment.filter(e => e.status === 'available').length;
        const borrowed = equipment.filter(e => e.status === 'borrowed').length;
        const maintenance = equipment.filter(e => e.status === 'maintenance').length;

        return { total, available, borrowed, maintenance };
    };

    const getStatusColor = (available: number, total: number) => {
        if (total === 0) return 'bg-gray-100 text-gray-800';
        const percentage = (available / total) * 100;
        if (percentage >= 70) return 'bg-green-100 text-green-800';
        if (percentage >= 40) return 'bg-yellow-100 text-yellow-800';
        return 'bg-red-100 text-red-800';
    };

    return (
        <AppShell>
            <Head title="Laboratories" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                            🏢 Laboratories
                        </h1>
                        <p className="text-gray-600 dark:text-gray-300 mt-2">
                            Browse and explore our laboratory facilities
                        </p>
                    </div>
                </div>

                {/* Statistics */}
                <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div className="text-center">
                            <div className="text-3xl font-bold text-blue-600 dark:text-blue-400">
                                {labs.total}
                            </div>
                            <div className="text-sm text-gray-600 dark:text-gray-300">Total Labs</div>
                        </div>
                        <div className="text-center">
                            <div className="text-3xl font-bold text-green-600 dark:text-green-400">
                                {labs.data.reduce((sum, lab) => sum + getEquipmentStats(lab.equipment).total, 0)}
                            </div>
                            <div className="text-sm text-gray-600 dark:text-gray-300">Total Equipment</div>
                        </div>
                        <div className="text-center">
                            <div className="text-3xl font-bold text-emerald-600 dark:text-emerald-400">
                                {labs.data.reduce((sum, lab) => sum + getEquipmentStats(lab.equipment).available, 0)}
                            </div>
                            <div className="text-sm text-gray-600 dark:text-gray-300">Available Equipment</div>
                        </div>
                        <div className="text-center">
                            <div className="text-3xl font-bold text-purple-600 dark:text-purple-400">
                                {labs.data.reduce((sum, lab) => sum + lab.capacity, 0)}
                            </div>
                            <div className="text-sm text-gray-600 dark:text-gray-300">Total Capacity</div>
                        </div>
                    </div>
                </div>

                {/* Labs Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {labs.data.map((lab) => {
                        const stats = getEquipmentStats(lab.equipment);
                        const statusColor = getStatusColor(stats.available, stats.total);
                        
                        return (
                            <Link
                                key={lab.id}
                                href={route('labs.show', lab.id)}
                                className="block bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden"
                            >
                                {/* Lab Image */}
                                <div className="h-48 bg-gradient-to-br from-blue-500 to-purple-600 relative overflow-hidden">
                                    {lab.image_path ? (
                                        <img 
                                            src={lab.image_path} 
                                            alt={lab.name}
                                            className="w-full h-full object-cover"
                                        />
                                    ) : (
                                        <div className="flex items-center justify-center h-full text-white">
                                            <div className="text-center">
                                                <div className="text-4xl mb-2">🏢</div>
                                                <div className="text-lg font-semibold">{lab.code}</div>
                                            </div>
                                        </div>
                                    )}
                                    <div className="absolute top-4 right-4">
                                        <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusColor}`}>
                                            {stats.available}/{stats.total} Available
                                        </span>
                                    </div>
                                </div>

                                {/* Lab Details */}
                                <div className="p-6">
                                    <div className="flex items-center justify-between mb-2">
                                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                            {lab.name}
                                        </h3>
                                        <span className="text-sm font-medium text-blue-600 dark:text-blue-400">
                                            {lab.code}
                                        </span>
                                    </div>

                                    <div className="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                        <div className="flex items-center">
                                            <span className="mr-2">📍</span>
                                            {lab.location}
                                        </div>
                                        <div className="flex items-center">
                                            <span className="mr-2">👥</span>
                                            Capacity: {lab.capacity}
                                        </div>
                                        <div className="flex items-center">
                                            <span className="mr-2">🕐</span>
                                            {lab.opening_time.slice(0, 5)} - {lab.closing_time.slice(0, 5)}
                                        </div>
                                    </div>

                                    {lab.description && (
                                        <p className="text-sm text-gray-500 dark:text-gray-400 mt-3 line-clamp-2">
                                            {lab.description}
                                        </p>
                                    )}

                                    {/* Staff Info */}
                                    <div className="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <div className="grid grid-cols-2 gap-4 text-xs text-gray-500 dark:text-gray-400">
                                            <div>
                                                <div className="font-medium">Head of Lab</div>
                                                <div>{lab.head_of_lab?.name || 'Not assigned'}</div>
                                            </div>
                                            <div>
                                                <div className="font-medium">Laboran</div>
                                                <div>{lab.laboran?.name || 'Not assigned'}</div>
                                            </div>
                                        </div>
                                    </div>

                                    {/* Equipment Summary */}
                                    <div className="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <div className="flex items-center justify-between text-xs">
                                            <span className="text-gray-500 dark:text-gray-400">Equipment Status</span>
                                        </div>
                                        <div className="flex items-center mt-2 space-x-4 text-xs">
                                            <div className="flex items-center">
                                                <div className="w-2 h-2 bg-green-500 rounded-full mr-1"></div>
                                                <span className="text-gray-600 dark:text-gray-300">
                                                    {stats.available} Available
                                                </span>
                                            </div>
                                            <div className="flex items-center">
                                                <div className="w-2 h-2 bg-yellow-500 rounded-full mr-1"></div>
                                                <span className="text-gray-600 dark:text-gray-300">
                                                    {stats.borrowed} Borrowed
                                                </span>
                                            </div>
                                            {stats.maintenance > 0 && (
                                                <div className="flex items-center">
                                                    <div className="w-2 h-2 bg-red-500 rounded-full mr-1"></div>
                                                    <span className="text-gray-600 dark:text-gray-300">
                                                        {stats.maintenance} Maintenance
                                                    </span>
                                                </div>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            </Link>
                        );
                    })}
                </div>

                {/* Pagination */}
                {labs.last_page > 1 && (
                    <div className="flex items-center justify-center space-x-2">
                        <nav className="flex items-center space-x-1">
                            {[...Array(labs.last_page)].map((_, index) => {
                                const page = index + 1;
                                const isActive = page === labs.current_page;
                                
                                return (
                                    <Link
                                        key={page}
                                        href={route('labs.index', { page })}
                                        className={`px-3 py-2 text-sm rounded-md ${
                                            isActive
                                                ? 'bg-blue-600 text-white'
                                                : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700'
                                        }`}
                                    >
                                        {page}
                                    </Link>
                                );
                            })}
                        </nav>
                    </div>
                )}
            </div>
        </AppShell>
    );
}