@extends('layouts.app')

@section('title', __('app.title'))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white dark:from-gray-900 dark:to-gray-800">
    <!-- Navigation -->
    <nav class="flex items-center justify-between px-6 py-4 lg:px-8">
        <div class="flex items-center space-x-2" data-aos="fade-right">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-lg">⚗️</span>
            </div>
            <span class="text-xl font-bold text-gray-900 dark:text-white">{{ __('app.name') }}</span>
        </div>
        <div class="flex items-center space-x-4" data-aos="fade-left">
            <!-- Language Switcher -->
            <div x-data="{ languageOpen: false }" class="relative">
                <button @click="languageOpen = !languageOpen" 
                        class="flex items-center space-x-1 px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white rounded-lg transition-colors">
                    <span class="text-lg">{{ app()->getLocale() === 'id' ? '🇮🇩' : '🇺🇸' }}</span>
                    <span>{{ app()->getLocale() === 'id' ? 'ID' : 'EN' }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="languageOpen" @click.away="languageOpen = false" x-transition
                     class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1">
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

            <!-- Theme Toggle -->
            <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light')" 
                    class="p-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white rounded-lg transition-colors">
                <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
                <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </button>

            @guest
                <a href="{{ route('login') }}" 
                   class="text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white px-4 py-2 font-medium transition-colors">
                    {{ __('app.login') }}
                </a>
                <a href="{{ route('register') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-all transform hover:scale-105 shadow-lg hover:shadow-xl">
                    {{ __('app.student_registration') }}
                </a>
            @else
                <a href="{{ route('dashboard') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-all transform hover:scale-105 shadow-lg hover:shadow-xl">
                    {{ __('app.dashboard') }}
                </a>
            @endguest
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="px-6 py-16 text-center lg:px-8">
        <div class="mx-auto max-w-4xl">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl animate__animated animate__fadeInUp" data-aos="fade-up">
                🧪 <span class="text-blue-600">{{ __('app.hero_title') }}</span>
            </h1>
            <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300" data-aos="fade-up" data-aos-delay="200">
                {{ __('app.hero_subtitle') }}
                <br />
                <span class="text-sm text-gray-500">{{ __('app.department') }}</span>
            </p>
            
            @guest
            <div class="mt-10 flex items-center justify-center gap-x-6" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('register') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold text-lg shadow-lg transition-all hover:shadow-xl transform hover:scale-105">
                    {{ __('app.get_started') }}
                </a>
                <a href="{{ route('login') }}" 
                   class="text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white font-semibold text-lg transition-colors">
                    {{ __('app.sign_in') }}
                </a>
            </div>
            @endguest
        </div>
    </div>

    <!-- Features Section -->
    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="mx-auto max-w-2xl text-center" data-aos="fade-up">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                🚀 {{ __('app.key_features') }}
            </h2>
            <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                {{ __('app.key_features_desc') }}
            </p>
        </div>
        <div class="mx-auto mt-16 grid max-w-5xl grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="100">
                <div class="text-3xl mb-4 animate__animated animate__bounceIn">📋</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('app.equipment_lending') }}</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('app.equipment_lending_desc') }}
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="200">
                <div class="text-3xl mb-4 animate__animated animate__bounceIn">🔍</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('app.inventory_management') }}</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('app.inventory_management_desc') }}
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="300">
                <div class="text-3xl mb-4 animate__animated animate__bounceIn">✅</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('app.jsa_compliance') }}</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('app.jsa_compliance_desc') }}
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="400">
                <div class="text-3xl mb-4 animate__animated animate__bounceIn">📊</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('app.reports_analytics') }}</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('app.reports_analytics_desc') }}
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="500">
                <div class="text-3xl mb-4 animate__animated animate__bounceIn">🔔</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('app.notifications') }}</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('app.notifications_desc') }}
                </p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="600">
                <div class="text-3xl mb-4 animate__animated animate__bounceIn">👥</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('app.role_based_access') }}</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('app.role_based_access_desc') }}
                </p>
            </div>
        </div>
    </div>

    <!-- User Roles Section -->
    <div class="bg-gray-50 dark:bg-gray-900 py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center" data-aos="fade-up">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    👨‍🔬 {{ __('app.user_roles') }}
                </h2>
                <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                    {{ __('app.user_roles_desc') }}
                </p>
            </div>
            <div class="mx-auto mt-16 grid max-w-5xl grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">
                <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <span class="text-2xl">👑</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('app.admin') }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ __('app.admin_desc') }}</p>
                </div>
                <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <span class="text-2xl">🏛️</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('app.kepala_lab') }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ __('app.kepala_lab_desc') }}</p>
                </div>
                <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <span class="text-2xl">🔧</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('app.laboran') }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ __('app.laboran_desc') }}</p>
                </div>
                <div class="text-center group" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <span class="text-2xl">👨‍🏫</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('app.dosen') }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ __('app.dosen_desc') }}</p>
                </div>
                <div class="text-center group" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-16 h-16 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <span class="text-2xl">🎓</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('app.mahasiswa') }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ __('app.mahasiswa_desc') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- How to Use Section -->
    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
        <div class="mx-auto max-w-2xl text-center" data-aos="fade-up">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                📝 {{ __('app.how_to_use') }}
            </h2>
            <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                {{ __('app.how_to_use_desc') }}
            </p>
        </div>
        <div class="mx-auto mt-16 max-w-4xl">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold animate__animated animate__pulse animate__infinite">1</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('app.step_1_title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('app.step_1_desc') }}</p>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold animate__animated animate__pulse animate__infinite">2</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('app.step_2_title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('app.step_2_desc') }}</p>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold animate__animated animate__pulse animate__infinite">3</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('app.step_3_title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('app.step_3_desc') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Lottie Animation Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 py-16">
        <div class="mx-auto max-w-4xl px-6 text-center">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="lg:w-1/2 text-white" data-aos="fade-right">
                    <h2 class="text-3xl font-bold mb-4">{{ __('Ready to Get Started?') }}</h2>
                    <p class="text-lg mb-6 text-blue-100">{{ __('Join hundreds of students and staff using ChemLab system daily') }}</p>
                    @guest
                    <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-all transform hover:scale-105">
                        {{ __('app.get_started') }}
                    </a>
                    @endguest
                </div>
                <div class="lg:w-1/2 mt-8 lg:mt-0" data-aos="fade-left">
                    <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_v1yudlrx.json" 
                                   background="transparent" speed="1" style="width: 300px; height: 300px;" 
                                   loop autoplay>
                    </lottie-player>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-2 mb-4" data-aos="fade-up">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <span class="text-white text-sm">⚗️</span>
                    </div>
                    <span class="text-xl font-bold">{{ __('app.name') }}</span>
                </div>
                <p class="text-gray-400 mb-4" data-aos="fade-up" data-aos-delay="100">
                    {{ __('app.department') }}
                </p>
                <div class="flex justify-center space-x-6 text-sm text-gray-400" data-aos="fade-up" data-aos-delay="200">
                    <a href="#" class="hover:text-white transition-colors">{{ __('app.faq') }}</a>
                    <a href="#" class="hover:text-white transition-colors">{{ __('app.contact') }}</a>
                    <a href="#" class="hover:text-white transition-colors">{{ __('app.support') }}</a>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection