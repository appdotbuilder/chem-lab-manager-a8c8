@extends(auth()->check() ? 'layouts.dashboard' : 'layouts.app')

@section('title', $lab->name . ' - Laboratory Detail')

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
                    <a href="{{ route('labs.index') }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400">← {{ __('Back to Labs') }}</a>
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
            <nav class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-4">
                <a href="{{ route('labs.index') }}" class="hover:text-gray-700 dark:hover:text-gray-200">{{ __('Laboratories') }}</a>
                <span>›</span>
                <span class="text-gray-900 dark:text-white">{{ $lab->name }}</span>
            </nav>
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        🏢 {{ $lab->name }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">{{ $lab->description }}</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                    {{ $lab->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                    {{ $lab->is_active ? __('Active') : __('Inactive') }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Lab Information -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Laboratory Information') }}</h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Code') }}</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $lab->code }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Location') }}</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">
                                <div class="flex items-center space-x-2">
                                    <span>📍</span>
                                    <span>{{ $lab->location }}</span>
                                </div>
                            </dd>
                        </div>
                        @if($lab->capacity)
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Capacity') }}</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">
                                <div class="flex items-center space-x-2">
                                    <span>👥</span>
                                    <span>{{ $lab->capacity }} {{ __('persons') }}</span>
                                </div>
                            </dd>
                        </div>
                        @endif
                        @if($lab->area)
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Area') }}</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $lab->area }} m²</dd>
                        </div>
                        @endif
                        @if($lab->headOfLab)
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Head of Laboratory') }}</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">
                                <div class="flex items-center space-x-2">
                                    <span>👨‍🏫</span>
                                    <span>{{ $lab->headOfLab->name }}</span>
                                </div>
                            </dd>
                        </div>
                        @endif
                        @if($lab->laboran)
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Laboratory Assistant') }}</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">
                                <div class="flex items-center space-x-2">
                                    <span>🔧</span>
                                    <span>{{ $lab->laboran->name }}</span>
                                </div>
                            </dd>
                        </div>
                        @endif
                    </dl>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('equipment.index', ['lab' => $lab->id]) }}" 
                           class="w-full inline-flex justify-center items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                            🔍 {{ __('View Lab Equipment') }}
                        </a>
                    </div>
                </div>

                <!-- Equipment Statistics -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mt-6" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">📊 {{ __('Equipment Statistics') }}</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                <span class="text-sm text-gray-600 dark:text-gray-300">{{ __('Total Equipment') }}</span>
                            </div>
                            <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $equipmentStats['total'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                <span class="text-sm text-gray-600 dark:text-gray-300">{{ __('Available') }}</span>
                            </div>
                            <span class="text-lg font-bold text-green-600">{{ $equipmentStats['available'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="w-3 h-3 bg-yellow-500 rounded-full"></span>
                                <span class="text-sm text-gray-600 dark:text-gray-300">{{ __('In Use') }}</span>
                            </div>
                            <span class="text-lg font-bold text-yellow-600">{{ $equipmentStats['borrowed'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="w-3 h-3 bg-orange-500 rounded-full"></span>
                                <span class="text-sm text-gray-600 dark:text-gray-300">{{ __('Maintenance') }}</span>
                            </div>
                            <span class="text-lg font-bold text-orange-600">{{ $equipmentStats['maintenance'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                <span class="text-sm text-gray-600 dark:text-gray-300">{{ __('Damaged') }}</span>
                            </div>
                            <span class="text-lg font-bold text-red-600">{{ $equipmentStats['damaged'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Equipment by Category -->
            <div class="lg:col-span-2 space-y-6">
                @forelse($equipmentByCategory as $categoryName => $equipment)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 200 }}">
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            📂 {{ $categoryName }} ({{ $equipment->count() }} {{ __('items') }})
                        </h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($equipment as $item)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between mb-2">
                                        <h4 class="font-medium text-gray-900 dark:text-white text-sm">{{ $item->name }}</h4>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                            {{ $item->status === 'available' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                               ($item->status === 'in_use' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : 
                                                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300') }}">
                                            {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">{{ $item->code }}</p>
                                    @if($item->description)
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-3 line-clamp-2">{{ $item->description }}</p>
                                    @endif
                                    <div class="flex items-center justify-between">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            {{ $item->risk_level === 'high' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' :
                                               ($item->risk_level === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' :
                                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300') }}">
                                            {{ ucfirst($item->risk_level) }} Risk
                                        </span>
                                        <a href="{{ route('equipment.show', $item) }}" 
                                           class="text-blue-600 hover:text-blue-700 dark:text-blue-400 text-xs font-medium">
                                            {{ __('View Details') }} →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-12 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-6xl mb-4">📦</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('No Equipment Available') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('This laboratory does not have any equipment registered yet.') }}</p>
                </div>
                @endforelse

                <!-- Documents Section -->
                @if($lab->documents->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">📄 {{ __('Laboratory Documents') }}</h3>
                    <div class="space-y-3">
                        @foreach($lab->documents as $document)
                            <div class="flex items-center justify-between border border-gray-200 dark:border-gray-700 rounded-lg p-3">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        @switch($document->type)
                                            @case('sop')
                                                <span class="text-xl">📋</span>
                                                @break
                                            @case('manual')
                                                <span class="text-xl">📖</span>
                                                @break
                                            @case('safety')
                                                <span class="text-xl">⚠️</span>
                                                @break
                                            @default
                                                <span class="text-xl">📄</span>
                                        @endswitch
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">{{ $document->name }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ ucfirst($document->type) }} • {{ $document->updated_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($document->file_path) }}" target="_blank" 
                                   class="text-blue-600 hover:text-blue-700 dark:text-blue-400 text-sm">
                                    {{ __('Download') }} ↓
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Safety Information -->
                @if($lab->safety_information)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">⚠️ {{ __('Safety Information') }}</h3>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($lab->safety_information)) !!}
                    </div>
                </div>
                @endif

                <!-- Operating Hours -->
                @if($lab->operating_hours)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="800">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">🕒 {{ __('Operating Hours') }}</h3>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($lab->operating_hours)) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>

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
    // Initialize equipment charts if needed
    document.addEventListener('DOMContentLoaded', function() {
        // Add any interactive functionality here
        console.log('Lab detail page loaded for: {{ $lab->name }}');
    });
</script>
@endpush