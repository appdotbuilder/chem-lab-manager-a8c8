@props(['type' => 'info', 'message'])

@php
$classes = [
    'info' => 'bg-blue-50 border-blue-200 text-blue-700 dark:bg-blue-900 dark:border-blue-700 dark:text-blue-300',
    'success' => 'bg-green-50 border-green-200 text-green-700 dark:bg-green-900 dark:border-green-700 dark:text-green-300',
    'warning' => 'bg-yellow-50 border-yellow-200 text-yellow-700 dark:bg-yellow-900 dark:border-yellow-700 dark:text-yellow-300',
    'error' => 'bg-red-50 border-red-200 text-red-700 dark:bg-red-900 dark:border-red-700 dark:text-red-300',
];

$icons = [
    'info' => 'ℹ️',
    'success' => '✅',
    'warning' => '⚠️',
    'error' => '❌',
];
@endphp

<div {{ $attributes->merge(['class' => 'border rounded-lg p-4 ' . $classes[$type]]) }}>
    <div class="flex items-center">
        <span class="text-lg mr-3">{{ $icons[$type] }}</span>
        <div>{{ $message ?? $slot }}</div>
    </div>
</div>