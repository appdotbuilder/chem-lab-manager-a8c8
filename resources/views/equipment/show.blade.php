@extends(auth()->check() ? 'layouts.dashboard' : 'layouts.app')

@section('title', $equipment->name . ' - Equipment Detail')

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
                    <a href="{{ route('equipment.index') }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400">← {{ __('Back to Equipment') }}</a>
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
                <a href="{{ route('equipment.index') }}" class="hover:text-gray-700 dark:hover:text-gray-200">{{ __('Equipment') }}</a>
                <span>›</span>
                <span class="text-gray-900 dark:text-white">{{ $equipment->name }}</span>
            </nav>
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        {{ $equipment->name }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300">{{ $equipment->description }}</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                    {{ $equipment->status === 'available' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                       ($equipment->status === 'in_use' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : 
                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300') }}">
                    {{ ucfirst(str_replace('_', ' ', $equipment->status)) }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Equipment Image and Basic Info -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden" data-aos="fade-up">
                    <div class="aspect-w-1 aspect-h-1 bg-gray-200 dark:bg-gray-700">
                        @if($equipment->image_path)
                            <img src="{{ Storage::url($equipment->image_path) }}" alt="{{ $equipment->name }}" 
                                 class="object-cover w-full h-64">
                        @else
                            <div class="flex items-center justify-center h-64">
                                <span class="text-8xl">⚙️</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Equipment Details') }}</h3>
                        <dl class="space-y-3">
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Code') }}</dt>
                                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $equipment->code }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Category') }}</dt>
                                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $equipment->category->name }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Laboratory') }}</dt>
                                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $equipment->lab->name }}</dd>
                            </div>
                            @if($equipment->brand)
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Brand') }}</dt>
                                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $equipment->brand }}</dd>
                            </div>
                            @endif
                            @if($equipment->model)
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Model') }}</dt>
                                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $equipment->model }}</dd>
                            </div>
                            @endif
                            @if($equipment->serial_number)
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Serial Number') }}</dt>
                                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $equipment->serial_number }}</dd>
                            </div>
                            @endif
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Risk Level') }}</dt>
                                <dd class="text-sm font-medium">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        {{ $equipment->risk_level === 'high' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' :
                                           ($equipment->risk_level === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' :
                                            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300') }}">
                                        {{ ucfirst($equipment->risk_level) }}
                                    </span>
                                </dd>
                            </div>
                        </dl>

                        @auth
                            @if($equipment->status === 'available' && auth()->user()->role->name === 'mahasiswa')
                                <button onclick="requestEquipment({{ $equipment->id }})" 
                                        class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                                    📋 {{ __('Request Equipment') }}
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Detailed Information and Availability -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Specifications -->
                @if($equipment->specifications)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">📋 {{ __('Specifications') }}</h3>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($equipment->specifications)) !!}
                    </div>
                </div>
                @endif

                <!-- Safety Requirements -->
                @if($equipment->safety_requirements)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">⚠️ {{ __('Safety Requirements') }}</h3>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($equipment->safety_requirements)) !!}
                    </div>
                </div>
                @endif

                <!-- Operating Procedures -->
                @if($equipment->operating_procedures)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">🔧 {{ __('Operating Procedures') }}</h3>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($equipment->operating_procedures)) !!}
                    </div>
                </div>
                @endif

                <!-- Availability Calendar -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">📅 {{ __('30-Day Availability') }}</h3>
                    <div class="grid grid-cols-7 gap-2">
                        @foreach($availability as $day)
                            <div class="text-center">
                                <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">{{ $day['day'] }}</div>
                                <div class="w-8 h-8 rounded-full mx-auto flex items-center justify-center text-xs font-medium
                                    {{ $day['available'] ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' :
                                       ($day['status'] === 'booked' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' :
                                        'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400') }}"
                                    title="{{ $day['date'] }} - {{ $day['available'] ? 'Available' : ucfirst($day['status']) }}">
                                    {{ substr($day['date'], -2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 flex items-center space-x-6 text-sm">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full bg-green-100 dark:bg-green-900"></div>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('Available') }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full bg-red-100 dark:bg-red-900"></div>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('Booked') }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 rounded-full bg-gray-100 dark:bg-gray-700"></div>
                            <span class="text-gray-600 dark:text-gray-300">{{ __('Unavailable') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Laboratory Information -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="500">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">🏢 {{ __('Laboratory Information') }}</h3>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">{{ $equipment->lab->name }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $equipment->lab->description }}</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Location') }}</dt>
                                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $equipment->lab->location }}</dd>
                            </div>
                            @if($equipment->lab->headOfLab)
                            <div>
                                <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Head of Lab') }}</dt>
                                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $equipment->lab->headOfLab->name }}</dd>
                            </div>
                            @endif
                            @if($equipment->lab->laboran)
                            <div>
                                <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Lab Assistant') }}</dt>
                                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $equipment->lab->laboran->name }}</dd>
                            </div>
                            @endif
                        </div>
                        <a href="{{ route('labs.show', $equipment->lab) }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-700 dark:text-blue-400 text-sm">
                            {{ __('View Lab Details') }} →
                        </a>
                    </div>
                </div>

                <!-- Recent Incidents (if any) -->
                @if($equipment->incidents->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">⚠️ {{ __('Recent Incidents') }}</h3>
                    <div class="space-y-3">
                        @foreach($equipment->incidents->take(3) as $incident)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-3">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">{{ $incident->title }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ $incident->created_at->format('M d, Y') }} • {{ $incident->reporter->name }}
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        {{ $incident->severity === 'high' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' :
                                           ($incident->severity === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' :
                                            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300') }}">
                                        {{ ucfirst($incident->severity) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ $incident->description }}</p>
                            </div>
                        @endforeach
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
    function requestEquipment(equipmentId) {
        @guest
            alert('{{ __("Please login to request equipment") }}');
            window.location.href = '{{ route("login") }}';
        @else
            alert('{{ __("Equipment request feature coming soon!") }}');
            // TODO: Implement equipment request functionality
        @endguest
    }
</script>
@endpush