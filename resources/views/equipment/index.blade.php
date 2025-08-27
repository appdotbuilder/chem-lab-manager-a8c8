@extends(auth()->check() ? 'layouts.dashboard' : 'layouts.app')

@section('title', 'Equipment - ' . __('app.name'))

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
                    <a href="{{ route('labs.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">{{ __('Labs') }}</a>
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
                🔬 {{ __('Equipment Catalog') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-300">
                {{ __('Browse available laboratory equipment') }}
            </p>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6" data-aos="fade-up" data-aos-delay="100">
            <form method="GET" action="{{ route('equipment.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Search') }}</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" 
                           placeholder="{{ __('Equipment name...') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Category') }}</label>
                    <select id="category" name="category" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">{{ __('All Categories') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="lab" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Laboratory') }}</label>
                    <select id="lab" name="lab" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">{{ __('All Labs') }}</option>
                        @foreach($labs as $lab)
                            <option value="{{ $lab->id }}" {{ request('lab') == $lab->id ? 'selected' : '' }}>
                                {{ $lab->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        🔍 {{ __('Search') }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Equipment Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($equipment as $item)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow" 
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200 dark:bg-gray-700">
                        @if($item->image_path)
                            <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->name }}" 
                                 class="object-cover w-full h-48">
                        @else
                            <div class="flex items-center justify-center h-48">
                                <span class="text-6xl">⚙️</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $item->name }}</h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $item->status === 'available' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                   ($item->status === 'in_use' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : 
                                    'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300') }}">
                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                            </span>
                        </div>
                        
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">{{ $item->description }}</p>
                        
                        <div class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center space-x-2">
                                <span>🏢</span>
                                <span>{{ $item->lab->name }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span>📂</span>
                                <span>{{ $item->category->name }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span>🏷️</span>
                                <span>{{ $item->code }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <a href="{{ route('equipment.show', $item) }}" 
                                   class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                    {{ __('View Details') }} →
                                </a>
                                @auth
                                    @if($item->status === 'available' && auth()->user()->role->name === 'mahasiswa')
                                        <button onclick="requestEquipment({{ $item->id }})" 
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                            📋 {{ __('Request') }}
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-12 text-center">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('No Equipment Found') }}</h3>
                        <p class="text-gray-600 dark:text-gray-300">{{ __('Try adjusting your search filters') }}</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($equipment->hasPages())
            <div class="mt-8" data-aos="fade-up">
                {{ $equipment->links() }}
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
    // Equipment request functionality
    function requestEquipment(equipmentId) {
        @guest
            alert('{{ __("Please login to request equipment") }}');
            window.location.href = '{{ route("login") }}';
        @else
            alert('{{ __("Equipment request feature coming soon!") }}');
            // TODO: Implement equipment request functionality
        @endguest
    }

    // Initialize Select2 for better dropdowns
    $(document).ready(function() {
        $('#category, #lab').select2({
            theme: 'default',
            width: '100%'
        });
    });
</script>
@endpush