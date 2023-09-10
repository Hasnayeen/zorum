@props([
    'navigation',
    'side' => 'left',
])

@php
    $openSidebarClasses = 'fi-sidebar-open max-w-none translate-x-0 shadow-xl ring-1 ring-gray-950/5 rtl:-translate-x-0 dark:ring-white/10';
    $isRtl = __('filament-panels::layout.direction') === 'rtl';
@endphp

<aside
    x-data="{}"
    x-cloak="-lg"
    x-bind:class="$store.sidebar.isOpen ? @js($openSidebarClasses) : '-translate-x-full rtl:translate-x-full'"
    @class([
        'fixed inset-y-0 z-30 grid h-screen w-[--sidebar-width] content-start bg-white transition-all dark:bg-gray-900 lg:z-0 lg:bg-white/50 lg:shadow-none lg:ring-1 lg:ring-gray-950/5 dark:lg:ring-white/10 dark:lg:bg-transparent',
        'start-0' => $side === 'left',
        'end-0' => $side === 'right',
    ])
>
    <header
        class="fi-sidebar-header flex h-16 items-center bg-white px-6 ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 lg:shadow-sm"
    >
        {{-- format-ignore-start --}}
        <div>
            @if ($homeUrl = filament()->getHomeUrl())
                <a href="{{ $homeUrl }}">
                    <x-filament-panels::logo />
                </a>
            @else
                <x-filament-panels::logo />
            @endif
        </div>
        {{-- format-ignore-end --}}

        @if (filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop())
            <x-filament::icon-button
                color="gray"
                :icon="$isRtl ? 'heroicon-o-chevron-right' : 'heroicon-o-chevron-left'"
                icon-alias="panels::sidebar.collapse-button"
                icon-size="lg"
                :label="__('filament-panels::layout.actions.sidebar.collapse.label')"
                x-cloak
                x-data="{}"
                x-on:click="$store.sidebar.close()"
                x-show="$store.sidebar.isOpen"
                class="-mx-1.5 ms-auto hidden lg:flex"
            />
        @endif
    </header>

    <nav
        class="fi-sidebar-nav flex flex-col gap-y-7 overflow-y-auto overflow-x-hidden px-6 py-8"
    >
        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::sidebar.nav.start') }}

        @if (filament()->hasTenancy())
            <div
                @class([
                    '-mx-2' => ! filament()->isSidebarCollapsibleOnDesktop(),
                ])
                @if (filament()->isSidebarCollapsibleOnDesktop())
                    x-bind:class="$store.sidebar.isOpen ? '-mx-2' : '-mx-4'"
                @endif
            >
                <x-filament-panels::tenant-menu />
            </div>
        @endif

        @if (filament()->hasNavigation())
            <ul class="-mx-2 flex flex-col gap-y-7">
                @foreach ($navigation as $group)
                    <x-sidebar.group
                        :collapsible="$group->isCollapsible()"
                        :icon="$group->getIcon()"
                        :items="$group->getItems()"
                        :label="$group->getLabel()"
                    />
                @endforeach
            </ul>

            @php
                $collapsedNavigationGroupLabels = collect($navigation)
                    ->filter(fn (\Filament\Navigation\NavigationGroup $group): bool => $group->isCollapsed())
                    ->map(fn (\Filament\Navigation\NavigationGroup $group): string => $group->getLabel())
                    ->values();
            @endphp

            <script>
                let sidebarCollapsedGroups = JSON.parse(
                    localStorage.getItem('sidebarCollapsedGroups'),
                )

                if (sidebarCollapsedGroups === null || sidebarCollapsedGroups === 'null') {
                    localStorage.setItem(
                        'sidebarCollapsedGroups',
                        JSON.stringify(@js($collapsedNavigationGroupLabels)),
                    )
                }

                sidebarCollapsedGroups = JSON.parse(
                    localStorage.getItem('sidebarCollapsedGroups'),
                )

                document
                    .querySelectorAll('.fi-sidebar-group')
                    .forEach((group) => {
                        if (
                            !sidebarCollapsedGroups.includes(group.dataset.groupLabel)
                        ) {
                            return
                        }

                        // Alpine.js loads too slow, so attempt to hide a
                        // collapsed sidebar group earlier.
                        group.querySelector(
                            '.fi-sidebar-group-items',
                        ).style.display = 'none'
                        group
                            .querySelector('.fi-sidebar-group-collapse-button')
                            .classList.add('rotate-180')
                    })
            </script>
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::sidebar.nav.end') }}
    </nav>

    {{ \Filament\Support\Facades\FilamentView::renderHook('panels::sidebar.footer') }}
</aside>
