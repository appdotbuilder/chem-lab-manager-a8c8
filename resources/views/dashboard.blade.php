@extends('layouts.dashboard')

@section('title', __('app.dashboard'))

@section('dashboard-content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up">
        <div class="flex items-center space-x-4">
            <div class="text-4xl">
                @switch($role)
                    @case('admin')
                        👑
                        @break
                    @case('kepala_lab')
                        🏛️
                        @break
                    @case('laboran')
                        🔧
                        @break
                    @case('dosen')
                        👨‍🏫
                        @break
                    @case('mahasiswa')
                        🎓
                        @break
                    @default
                        👤
                @endswitch
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('app.welcome_back', ['name' => $user->name]) }}
                </h1>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ $user->role?->display_name ?? 'User' }} • {{ __('app.name') }} System
                </p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($stats as $key => $value)
            @php
                $statConfig = [
                    'totalUsers' => ['title' => __('app.total_users'), 'icon' => '👥', 'color' => 'bg-blue-500'],
                    'totalLabs' => ['title' => __('app.total_labs'), 'icon' => '🏢', 'color' => 'bg-green-500'],
                    'totalEquipment' => ['title' => __('app.total_equipment'), 'icon' => '⚙️', 'color' => 'bg-purple-500'],
                    'totalLoanRequests' => ['title' => 'Total Loan Requests', 'icon' => '📋', 'color' => 'bg-indigo-500'],
                    'pendingRegistrations' => ['title' => __('app.pending_registrations'), 'icon' => '⏳', 'color' => 'bg-yellow-500'],
                    'activeLoans' => ['title' => __('app.active_loans'), 'icon' => '📤', 'color' => 'bg-green-500'],
                    'overdueLoans' => ['title' => __('app.overdue_loans'), 'icon' => '⚠️', 'color' => 'bg-red-500'],
                    'availableEquipment' => ['title' => __('app.available_equipment'), 'icon' => '✅', 'color' => 'bg-emerald-500'],
                ];
                
                $config = $statConfig[$key] ?? [
                    'title' => ucfirst(preg_replace('/([A-Z])/', ' $1', $key)),
                    'icon' => '📊',
                    'color' => 'bg-gray-500'
                ];
            @endphp
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="flex items-center">
                    <div class="{{ $config['color'] }} rounded-lg p-3 text-white text-xl">
                        {{ $config['icon'] }}
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            {{ $config['title'] }}
                        </p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $value }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Equipment by Category Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                📊 Equipment by Category
            </h3>
            <div class="relative">
                <canvas id="equipmentChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Monthly Loans Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                📈 Monthly Loan Requests
            </h3>
            <div class="relative">
                <canvas id="monthlyChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="300">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
            🕒 {{ __('app.recent_activity') }}
        </h3>
        
        @if(empty($recentActivity))
            <p class="text-gray-500 dark:text-gray-400 text-center py-8">
                {{ __('app.no_recent_activity') }}
            </p>
        @else
            <div class="space-y-4">
                @foreach($recentActivity as $activityType => $items)
                    <div>
                        <h4 class="text-md font-medium text-gray-800 dark:text-gray-200 mb-2 capitalize">
                            {{ ucwords(preg_replace('/([A-Z])/', ' $1', $activityType)) }}
                        </h4>
                        @if(empty($items))
                            <p class="text-sm text-gray-500 dark:text-gray-400 ml-4">No items</p>
                        @else
                            <div class="space-y-2 ml-4">
                                @foreach(collect($items)->take(3) as $item)
                                    <div class="flex items-center space-x-3 text-sm">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <span class="text-gray-700 dark:text-gray-300">
                                            {{ $item['name'] ?? $item['borrower']['name'] ?? 'Activity' }}
                                        </span>
                                        <span class="text-gray-500 dark:text-gray-400">
                                            {{ $item['email'] ?? $item['status'] ?? '' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6" data-aos="fade-up" data-aos-delay="400">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
            ⚡ {{ __('app.quick_actions') }}
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @if($role === 'mahasiswa')
                <button onclick="alert('Feature coming soon!')" class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all transform hover:scale-105">
                    <span class="text-2xl mb-2">📋</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.new_request') }}</span>
                </button>
                <a href="{{ route('equipment.index') }}" class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all transform hover:scale-105">
                    <span class="text-2xl mb-2">🔍</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.browse_equipment') }}</span>
                </a>
            @endif
            
            @if(in_array($role, ['laboran', 'kepala_lab']))
                <button onclick="alert('Feature coming soon!')" class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all transform hover:scale-105">
                    <span class="text-2xl mb-2">✅</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.approve_requests') }}</span>
                </button>
                <button onclick="alert('Feature coming soon!')" class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all transform hover:scale-105">
                    <span class="text-2xl mb-2">📦</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.manage_equipment') }}</span>
                </button>
            @endif
            
            @if($role === 'admin')
                <button onclick="alert('Feature coming soon!')" class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all transform hover:scale-105">
                    <span class="text-2xl mb-2">👥</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.manage_users') }}</span>
                </button>
                <button onclick="alert('Feature coming soon!')" class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all transform hover:scale-105">
                    <span class="text-2xl mb-2">📊</span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.generate_reports') }}</span>
                </button>
            @endif

            <a href="{{ route('labs.index') }}" class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all transform hover:scale-105">
                <span class="text-2xl mb-2">🏢</span>
                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.view_labs') }}</span>
            </a>
            <button onclick="showHelpModal()" class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all transform hover:scale-105">
                <span class="text-2xl mb-2">📞</span>
                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.get_help') }}</span>
            </button>
        </div>
    </div>
</div>

<!-- Help Modal -->
<div id="helpModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 m-4 max-w-md w-full">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('app.get_help') }}</h3>
            <button onclick="hideHelpModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="space-y-4">
            <p class="text-gray-600 dark:text-gray-300">
                {{ __('Need help with the system? Contact us:') }}
            </p>
            <div class="space-y-2">
                <div class="flex items-center space-x-2">
                    <span class="text-lg">📧</span>
                    <span class="text-sm text-gray-700 dark:text-gray-300">chemlab@ui.ac.id</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-lg">📞</span>
                    <span class="text-sm text-gray-700 dark:text-gray-300">+62 21 7270032</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-lg">🕒</span>
                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ __('Mon-Fri, 08:00-16:00 WIB') }}</span>
                </div>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="hideHelpModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                {{ __('Close') }}
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Help Modal Functions
    function showHelpModal() {
        document.getElementById('helpModal').classList.remove('hidden');
        document.getElementById('helpModal').classList.add('flex');
    }
    
    function hideHelpModal() {
        document.getElementById('helpModal').classList.add('hidden');
        document.getElementById('helpModal').classList.remove('flex');
    }

    // Chart.js Configuration
    const chartData = @json($chartData);
    
    // Equipment by Category Chart
    const equipmentCtx = document.getElementById('equipmentChart').getContext('2d');
    new Chart(equipmentCtx, {
        type: 'doughnut',
        data: {
            labels: Object.keys(chartData.equipmentByCategory),
            datasets: [{
                data: Object.values(chartData.equipmentByCategory),
                backgroundColor: [
                    '#3B82F6', '#EF4444', '#10B981', '#F59E0B', '#8B5CF6', '#06B6D4'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: document.documentElement.classList.contains('dark') ? '#F9FAFB' : '#374151'
                    }
                }
            }
        }
    });

    // Monthly Loans Chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: Object.keys(chartData.monthlyLoans),
            datasets: [{
                label: 'Loan Requests',
                data: Object.values(chartData.monthlyLoans),
                backgroundColor: '#10B981',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: document.documentElement.classList.contains('dark') ? '#F9FAFB' : '#374151'
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: document.documentElement.classList.contains('dark') ? '#F9FAFB' : '#374151'
                    },
                    grid: {
                        color: document.documentElement.classList.contains('dark') ? '#4B5563' : '#E5E7EB'
                    }
                },
                y: {
                    ticks: {
                        color: document.documentElement.classList.contains('dark') ? '#F9FAFB' : '#374151'
                    },
                    grid: {
                        color: document.documentElement.classList.contains('dark') ? '#4B5563' : '#E5E7EB'
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection