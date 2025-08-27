import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head, Link, router } from '@inertiajs/react';

interface Category {
    id: number;
    name: string;
}

interface Lab {
    id: number;
    name: string;
}

interface Equipment {
    id: number;
    name: string;
    code: string;
    description: string;
    status: string;
    risk_level: string;
    brand: string;
    model: string;
    primary_image?: string;
    category: {
        name: string;
        icon: string;
        color_class: string;
    };
    lab: {
        name: string;
        code: string;
    };
}

interface PaginatedEquipment {
    data: Equipment[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

interface Filters {
    search?: string;
    category?: string;
    lab?: string;
    status?: string;
    risk_level?: string;
    sort_by?: string;
    sort_order?: string;
}

interface Props {
    equipment: PaginatedEquipment;
    categories: Category[];
    labs: Lab[];
    filters: Filters;
    [key: string]: unknown;
}

export default function EquipmentIndex({ equipment, categories, labs, filters }: Props) {
    const [searchTerm, setSearchTerm] = React.useState(filters.search || '');
    const [isSearching, setIsSearching] = React.useState(false);

    const handleSearch = (e: React.FormEvent) => {
        e.preventDefault();
        setIsSearching(true);
        
        router.get(route('equipment.index'), {
            ...filters,
            search: searchTerm,
            page: 1
        }, {
            preserveState: true,
            onFinish: () => setIsSearching(false)
        });
    };

    const handleFilterChange = (key: string, value: string) => {
        router.get(route('equipment.index'), {
            ...filters,
            [key]: value,
            page: 1
        }, {
            preserveState: true
        });
    };

    const getStatusBadge = (status: string) => {
        const badges = {
            available: 'bg-green-100 text-green-800',
            borrowed: 'bg-yellow-100 text-yellow-800',
            maintenance: 'bg-orange-100 text-orange-800',
            damaged: 'bg-red-100 text-red-800',
            retired: 'bg-gray-100 text-gray-800'
        };
        return badges[status as keyof typeof badges] || 'bg-gray-100 text-gray-800';
    };

    const getRiskBadge = (riskLevel: string) => {
        const badges = {
            low: 'bg-blue-100 text-blue-800',
            medium: 'bg-yellow-100 text-yellow-800',
            high: 'bg-red-100 text-red-800'
        };
        return badges[riskLevel as keyof typeof badges] || 'bg-gray-100 text-gray-800';
    };

    const getRiskIcon = (riskLevel: string) => {
        const icons = {
            low: '🟢',
            medium: '🟡',
            high: '🔴'
        };
        return icons[riskLevel as keyof typeof icons] || '⚪';
    };

    return (
        <AppShell>
            <Head title="Equipment Browse" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">
                            ⚙️ Equipment Catalog
                        </h1>
                        <p className="text-gray-600 dark:text-gray-300 mt-2">
                            Browse available laboratory equipment
                        </p>
                    </div>
                </div>

                {/* Search and Filters */}
                <div className="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <form onSubmit={handleSearch} className="mb-4">
                        <div className="flex gap-2">
                            <div className="flex-1">
                                <input
                                    type="text"
                                    placeholder="Search equipment by name, brand, model..."
                                    value={searchTerm}
                                    onChange={(e) => setSearchTerm(e.target.value)}
                                    className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                />
                            </div>
                            <button
                                type="submit"
                                disabled={isSearching}
                                className="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
                            >
                                {isSearching ? 'Searching...' : 'Search'}
                            </button>
                        </div>
                    </form>

                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <select
                            value={filters.category || ''}
                            onChange={(e) => handleFilterChange('category', e.target.value)}
                            className="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        >
                            <option value="">All Categories</option>
                            {categories.map(category => (
                                <option key={category.id} value={category.id}>
                                    {category.name}
                                </option>
                            ))}
                        </select>

                        <select
                            value={filters.lab || ''}
                            onChange={(e) => handleFilterChange('lab', e.target.value)}
                            className="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        >
                            <option value="">All Labs</option>
                            {labs.map(lab => (
                                <option key={lab.id} value={lab.id}>
                                    {lab.name}
                                </option>
                            ))}
                        </select>

                        <select
                            value={filters.status || ''}
                            onChange={(e) => handleFilterChange('status', e.target.value)}
                            className="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        >
                            <option value="">All Status</option>
                            <option value="available">Available</option>
                            <option value="borrowed">Borrowed</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="damaged">Damaged</option>
                        </select>

                        <select
                            value={filters.risk_level || ''}
                            onChange={(e) => handleFilterChange('risk_level', e.target.value)}
                            className="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        >
                            <option value="">All Risk Levels</option>
                            <option value="low">Low Risk</option>
                            <option value="medium">Medium Risk</option>
                            <option value="high">High Risk</option>
                        </select>

                        <select
                            value={`${filters.sort_by || 'name'}_${filters.sort_order || 'asc'}`}
                            onChange={(e) => {
                                const [sortBy, sortOrder] = e.target.value.split('_');
                                router.get(route('equipment.index'), {
                                    ...filters,
                                    sort_by: sortBy,
                                    sort_order: sortOrder,
                                    page: 1
                                }, { preserveState: true });
                            }}
                            className="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                        >
                            <option value="name_asc">Name A-Z</option>
                            <option value="name_desc">Name Z-A</option>
                            <option value="created_at_desc">Newest First</option>
                            <option value="created_at_asc">Oldest First</option>
                        </select>
                    </div>

                    {/* Active filters display */}
                    <div className="mt-4 flex flex-wrap gap-2">
                        {Object.entries(filters).map(([key, value]) => {
                            if (!value || key === 'sort_by' || key === 'sort_order') return null;
                            
                            let displayValue = value;
                            if (key === 'category') {
                                const category = categories.find(c => c.id.toString() === value);
                                displayValue = category?.name || value;
                            } else if (key === 'lab') {
                                const lab = labs.find(l => l.id.toString() === value);
                                displayValue = lab?.name || value;
                            }
                            
                            return (
                                <span
                                    key={key}
                                    className="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200"
                                >
                                    {key}: {displayValue}
                                    <button
                                        onClick={() => handleFilterChange(key, '')}
                                        className="ml-2 text-blue-600 hover:text-blue-800"
                                    >
                                        ×
                                    </button>
                                </span>
                            );
                        })}
                    </div>
                </div>

                {/* Results Summary */}
                <div className="text-sm text-gray-600 dark:text-gray-300">
                    Showing {equipment.data.length} of {equipment.total} equipment
                </div>

                {/* Equipment Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    {equipment.data.map((item) => (
                        <Link
                            key={item.id}
                            href={route('equipment.show', item.id)}
                            className="block bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden"
                        >
                            {/* Equipment Image */}
                            <div className="h-48 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 relative overflow-hidden">
                                {item.primary_image ? (
                                    <img 
                                        src={item.primary_image} 
                                        alt={item.name}
                                        className="w-full h-full object-cover"
                                    />
                                ) : (
                                    <div className="flex items-center justify-center h-full text-gray-400 dark:text-gray-500">
                                        <div className="text-center">
                                            <div className="text-4xl mb-2">{item.category.icon}</div>
                                            <div className="text-lg font-semibold">{item.code}</div>
                                        </div>
                                    </div>
                                )}
                                <div className="absolute top-2 left-2">
                                    <span className={`inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${getStatusBadge(item.status)}`}>
                                        {item.status}
                                    </span>
                                </div>
                                <div className="absolute top-2 right-2">
                                    <span className={`inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${getRiskBadge(item.risk_level)}`}>
                                        {getRiskIcon(item.risk_level)} {item.risk_level}
                                    </span>
                                </div>
                            </div>

                            {/* Equipment Details */}
                            <div className="p-4">
                                <div className="flex items-start justify-between mb-2">
                                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white line-clamp-2">
                                        {item.name}
                                    </h3>
                                </div>

                                <div className="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                    <div className="flex items-center">
                                        <span className={`inline-flex items-center px-2 py-1 rounded text-xs font-medium ${item.category.color_class} mr-2`}>
                                            {item.category.icon} {item.category.name}
                                        </span>
                                    </div>
                                    
                                    <div className="flex items-center">
                                        <span className="mr-2">🏢</span>
                                        <span>{item.lab.name} ({item.lab.code})</span>
                                    </div>
                                    
                                    {item.brand && (
                                        <div className="flex items-center">
                                            <span className="mr-2">🏭</span>
                                            <span>{item.brand}</span>
                                            {item.model && <span className="ml-1">- {item.model}</span>}
                                        </div>
                                    )}
                                </div>

                                {item.description && (
                                    <p className="text-sm text-gray-500 dark:text-gray-400 mt-3 line-clamp-2">
                                        {item.description}
                                    </p>
                                )}

                                <div className="mt-4 pt-3 border-t border-gray-200 dark:border-gray-700">
                                    <div className="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                        <span>Code: {item.code}</span>
                                        <span className={`px-2 py-1 rounded ${getStatusBadge(item.status)}`}>
                                            {item.status === 'available' ? '✅ Available' : 
                                             item.status === 'borrowed' ? '📤 Borrowed' :
                                             item.status === 'maintenance' ? '🔧 Maintenance' :
                                             '❌ Unavailable'}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    ))}
                </div>

                {/* Empty State */}
                {equipment.data.length === 0 && (
                    <div className="text-center py-12">
                        <div className="text-6xl text-gray-300 dark:text-gray-600 mb-4">🔍</div>
                        <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-2">
                            No equipment found
                        </h3>
                        <p className="text-gray-500 dark:text-gray-400">
                            Try adjusting your search criteria or filters
                        </p>
                    </div>
                )}

                {/* Pagination */}
                {equipment.last_page > 1 && (
                    <div className="flex items-center justify-center space-x-2">
                        <nav className="flex items-center space-x-1">
                            {equipment.current_page > 1 && (
                                <Link
                                    href={route('equipment.index', { ...filters, page: equipment.current_page - 1 })}
                                    className="px-3 py-2 text-sm bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-md border border-gray-300 dark:border-gray-600"
                                >
                                    ← Previous
                                </Link>
                            )}
                            
                            {[...Array(Math.min(5, equipment.last_page))].map((_, index) => {
                                const page = equipment.current_page <= 3 
                                    ? index + 1 
                                    : equipment.current_page + index - 2;
                                
                                if (page > equipment.last_page) return null;
                                
                                const isActive = page === equipment.current_page;
                                
                                return (
                                    <Link
                                        key={page}
                                        href={route('equipment.index', { ...filters, page })}
                                        className={`px-3 py-2 text-sm rounded-md ${
                                            isActive
                                                ? 'bg-blue-600 text-white'
                                                : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-600'
                                        }`}
                                    >
                                        {page}
                                    </Link>
                                );
                            })}
                            
                            {equipment.current_page < equipment.last_page && (
                                <Link
                                    href={route('equipment.index', { ...filters, page: equipment.current_page + 1 })}
                                    className="px-3 py-2 text-sm bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-md border border-gray-300 dark:border-gray-600"
                                >
                                    Next →
                                </Link>
                            )}
                        </nav>
                    </div>
                )}
            </div>
        </AppShell>
    );
}