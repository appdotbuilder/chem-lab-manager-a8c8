@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900" x-data="{ sidebarOpen: false }">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-lg transform transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
         :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
        
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between h-16 px-4 bg-blue-600 dark:bg-blue-700">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                    <span class="text-blue-600 font-bold text-lg">⚗️</span>
                </div>
                <span class="text-white font-bold text-lg">{{ __('app.name') }}</span>
            </div>
            <button @click="sidebarOpen = false" class="lg:hidden text-white hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="mt-4 px-4">
            <div class="space-y-2">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300' : '' }}">
                    <span class="text-xl">📊</span>
                    <span>{{ __('app.dashboard') }}</span>
                </a>

                @if(auth()->user()->role?->name === 'mahasiswa')
                <a href="{{ route('equipment.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('equipment.*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300' : '' }}">
                    <span class="text-xl">🔬</span>
                    <span>{{ __('app.browse_equipment') }}</span>
                </a>
                @endif

                <a href="{{ route('labs.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('labs.*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300' : '' }}">
                    <span class="text-xl">🏢</span>
                    <span>{{ __('app.view_labs') }}</span>
                </a>

                @if(auth()->user()->role && in_array(auth()->user()->role->name, ['admin', 'kepala_lab', 'laboran']))
                <div class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-600">
                    <p class="px-3 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                        {{ __('Management') }}
                    </p>
                    <div class="mt-2 space-y-2">
                        @if(auth()->user()->role?->name === 'admin')
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <span class="text-xl">👥</span>
                            <span>{{ __('app.manage_users') }}</span>
                        </a>
                        @endif
                        
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <span class="text-xl">⚙️</span>
                            <span>{{ __('app.manage_equipment') }}</span>
                        </a>
                        
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <span class="text-xl">✅</span>
                            <span>{{ __('app.approve_requests') }}</span>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Top Navigation -->
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between h-16 px-4">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Language Switcher -->
                    <div x-data="{ languageOpen: false }" class="relative">
                        <button @click="languageOpen = !languageOpen" 
                                class="flex items-center space-x-1 px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            <span class="text-lg">{{ app()->getLocale() === 'id' ? '🇮🇩' : '🇺🇸' }}</span>
                            <span>{{ app()->getLocale() === 'id' ? 'ID' : 'EN' }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="languageOpen" @click.away="languageOpen = false" x-transition
                             class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1">
                            <form method="POST" action="{{ route('language.change', 'id') }}" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="flex items-center space-x-2 px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                    <span>🇮🇩</span>
                                    <span>Bahasa Indonesia</span>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('language.change', 'en') }}" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="flex items-center space-x-2 px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left">
                                    <span>🇺🇸</span>
                                    <span>English</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Theme Switcher -->
                    <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light')" 
                            class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </button>

                    <!-- User Menu -->
                    <div x-data="{ userMenuOpen: false }" class="relative">
                        <button @click="userMenuOpen = !userMenuOpen" 
                                class="flex items-center space-x-3 px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <div class="hidden md:block text-left">
                                <div class="font-medium">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->role?->display_name ?? 'User' }}</div>
                            </div>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-transition
                             class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1">
                            <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                <div class="font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</div>
                            </div>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 text-left">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @yield('dashboard-content')
        </main>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>
</div>
@endsection