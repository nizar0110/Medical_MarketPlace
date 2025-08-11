@props([
    'title' => 'Icon Demo',
    'showVariants' => true,
    'showSizes' => true,
    'showAnimations' => true
])

<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $title }}</h3>
    
    @if($showVariants)
    <div class="mb-6">
        <h4 class="text-md font-medium text-gray-700 mb-3">Icon Color Variants</h4>
        <div class="flex flex-wrap gap-4">
            <div class="dashboard-icon icon-blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <div class="dashboard-icon icon-green">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                </svg>
            </div>
            <div class="dashboard-icon icon-yellow">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <div class="dashboard-icon icon-purple">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
        </div>
    </div>
    @endif
    
    @if($showSizes)
    <div class="mb-6">
        <h4 class="text-md font-medium text-gray-700 mb-3">Icon Size Variants</h4>
        <div class="flex flex-wrap items-center gap-4">
            <div class="dashboard-icon dashboard-icon-sm bg-gray-100">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div class="dashboard-icon bg-gray-100">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div class="dashboard-icon dashboard-icon-lg bg-gray-100">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div class="dashboard-icon dashboard-icon-xl bg-gray-100">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
        </div>
        <div class="text-xs text-gray-500 mt-2">
            <span class="mr-4">Small (40px)</span>
            <span class="mr-4">Default (50px)</span>
            <span class="mr-4">Large (60px)</span>
            <span>Extra Large (80px)</span>
        </div>
    </div>
    @endif
    
    @if($showAnimations)
    <div class="mb-6">
        <h4 class="text-md font-medium text-gray-700 mb-3">Icon Animations</h4>
        <div class="flex flex-wrap gap-4">
            <div class="dashboard-icon bg-blue-100 icon-bounce">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </div>
            <div class="dashboard-icon bg-green-100 icon-pulse">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div class="dashboard-icon bg-yellow-100 icon-loading">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </div>
        </div>
        <div class="text-xs text-gray-500 mt-2">
            <span class="mr-4">Bounce</span>
            <span class="mr-4">Pulse</span>
            <span>Loading Spinner</span>
        </div>
    </div>
    @endif
    
    <div class="text-xs text-gray-500">
        <p class="mb-1">• Icons are responsive and scale automatically on mobile devices</p>
        <p class="mb-1">• Hover effects include subtle lift and shadow enhancement</p>
        <p class="mb-1">• All icons use consistent sizing and spacing</p>
        <p>• Icons are centered both vertically and horizontally in their containers</p>
    </div>
</div>
