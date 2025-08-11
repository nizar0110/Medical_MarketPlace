@props([
    'title' => '',
    'action' => null,
])

<div {{ $attributes->merge(['class' => 'dashboard-section border border-gray-200 h-fit']) }}>
    <div class="dashboard-section-header py-3 px-4">
        <h3 class="text-base md:text-lg font-semibold text-gray-900">{{ $title }}</h3>
        @if ($action)
            <div>
                {{ $action }}
            </div>
        @endif
    </div>
    <div class="p-4 md:p-5">
        {{ $slot }}
    </div>
</div>

