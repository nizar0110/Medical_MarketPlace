@props([
    'title' => '',
    'value' => '',
    'iconVariant' => '', // e.g. icon-blue, icon-green, icon-yellow, icon-purple
    'iconSize' => 'default' // sm, default, lg, xl
])

<div class="dashboard-card border border-gray-200">
    <div class="dashboard-card-content">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="dashboard-icon {{ $iconSize !== 'default' ? 'dashboard-icon-' . $iconSize : '' }} {{ $iconVariant }}">
                    {{ $icon ?? '' }}
                </div>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="dashboard-label truncate">{{ $title }}</dt>
                    <dd class="text-xl md:text-2xl font-bold text-gray-900">{{ $value }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>

