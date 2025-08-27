@extends(auth()->check() ? 'layouts.dashboard' : 'layouts.app')

@section('title', 'Laboratories - ' . __('app.name'))

@if(auth()->check())
@section('dashboard-content')
@else
@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">⚗️</span>
                        </div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">{{ __('app.name') }}</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">{{ __('Home') }}</a>
                    <a href="{{ route('equipment.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">{{ __('Equipment') }}</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">{{ __('app.login') }}</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">{{ __('app.register') }}</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">{{ __('app.dashboard') }}</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
@endif

        <!-- Header -->
        <div class="mb-6" data-aos="fade-up">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                🏢 {{ __('Laboratory Directory') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-300">
                {{ __('Explore our laboratory facilities') }}
            </p>
        </div>

        <!-- Search -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6" data-aos="fade-up" data-aos-delay="100">
            <form method="GET" action="{{ route('labs.index') }}" class="flex gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="{{ __('Search laboratories...') }}"
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                    🔍 {{ __('Search') }}
                </button>
            </form>
        </div>

        <!-- Labs Table with Enhanced Features -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden" data-aos="fade-up" data-aos-delay="200">
            <div class="overflow-x-auto">
                <table class="data-table min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Laboratory') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Location') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Equipment') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Capacity') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Status') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($labs as $lab)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                                <span class="text-blue-600 dark:text-blue-400 text-lg">🏢</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $lab->name }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $lab->code }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    <div class="flex items-center">
                                        <span class="mr-2">📍</span>
                                        {{ $lab->location }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    <div class="flex items-center">
                                        <span class="mr-2">⚙️</span>
                                        {{ $lab->equipment_count ?? 0 }} {{ __('items') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    <div class="flex items-center">
                                        <span class="mr-2">👥</span>
                                        {{ $lab->capacity ?? 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $lab->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                           'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                        {{ $lab->status === 'active' ? __('Active') : __('Inactive') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('labs.show', $lab) }}" 
                                           class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                            {{ __('View') }}
                                        </a>
                                        <a href="{{ route('equipment.index', ['lab' => $lab->id]) }}" 
                                           class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 transition-colors">
                                            {{ __('Equipment') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-6xl mb-4">🔍</div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ __('No Laboratories Found') }}</h3>
                                    <p class="text-gray-600 dark:text-gray-300">{{ __('Try adjusting your search criteria') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center">
                    <div class="bg-blue-500 rounded-lg p-3 text-white text-xl">
                        🏢
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Total Labs') }}</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $labs->total() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-center">
                    <div class="bg-green-500 rounded-lg p-3 text-white text-xl">
                        ✅
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Active Labs') }}</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $labs->where('status', 'active')->count() }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="500">
                <div class="flex items-center">
                    <div class="bg-purple-500 rounded-lg p-3 text-white text-xl">
                        ⚙️
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Total Equipment') }}</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $labs->sum('equipment_count') ?? 0 }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if($labs->hasPages())
            <div class="mt-8" data-aos="fade-up">
                {{ $labs->links() }}
            </div>
        @endif

@if(!auth()->check())
    </div>
</div>
@endif

@if(auth()->check())
@endsection
@else
@endsection
@endif

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize enhanced DataTable
        if ($('.data-table').length && !$.fn.DataTable.isDataTable('.data-table')) {
            $('.data-table').DataTable({
                responsive: true,
                pageLength: 10,
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, targets: [5] } // Actions column not sortable
                ],
                language: @if(app()->getLocale() === 'id')
                {
                    "decimal": "",
                    "emptyTable": "Tidak ada data yang tersedia",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_ total entri)",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "loadingRecords": "Memuat...",
                    "processing": "Memproses...",
                    "search": "Cari:",
                    "zeroRecords": "Tidak ditemukan data yang sesuai",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
                @else
                {
                    "decimal": "",
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "infoFiltered": "(filtered from _MAX_ total entries)",
                    "lengthMenu": "Show _MENU_ entries",
                    "loadingRecords": "Loading...",
                    "processing": "Processing...",
                    "search": "Search:",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
                @endif
            });
        }
    });
</script>
@endpush