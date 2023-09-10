@props([
    'activeLocale' => null,
    'activeManager',
    'content' => null,
    'contentTabLabel' => null,
    'managers',
    'ownerRecord',
    'pageClass',
])

<div class="fi-resource-relation-managers flex flex-col gap-y-6">
    @php
        $normalizeRelationManagerClass = function (string | Filament\Resources\RelationManagers\RelationManagerConfiguration $manager): string {
            if ($manager instanceof \Filament\Resources\RelationManagers\RelationManagerConfiguration) {
                return $manager->relationManager;
            }

            return $manager;
        };
    @endphp

    @if ((count($managers) > 1) || $content)
        <x-filament::tabs>
            @php
                $tabs = $managers;

                if ($content) {
                    $tabs = array_replace([null => null], $tabs);
                }
            @endphp

            @foreach ($tabs as $tabKey => $manager)
                @php
                    $activeManager = strval($activeManager);
                    $tabKey = strval($tabKey);
                    $isGroup = $manager instanceof \Filament\Resources\RelationManagers\RelationGroup;

                    if ($isGroup) {
                        $manager->ownerRecord($ownerRecord);
                        $manager->pageClass($pageClass);
                    } elseif (filled($tabKey)) {
                        $manager = $normalizeRelationManagerClass($manager);
                    }
                @endphp

                <x-filament::tabs.item
                    :active="$activeManager === $tabKey"
                    :badge="filled($tabKey) ? ($isGroup ? $manager->getBadge() : $manager::getBadge($ownerRecord, $pageClass)) : null"
                    :icon="filled($tabKey) ? ($isGroup ? $manager->getIcon() : $manager::getIcon($ownerRecord, $pageClass)) : null"
                    :icon-position="filled($tabKey) ? ($isGroup ? $manager->getIconPosition() : $manager::getIconPosition($ownerRecord, $pageClass)) : null"
                    :wire:click="'$set(\'activeRelationManager\', ' . (filled($tabKey) ? ('\'' . $tabKey . '\'') : 'null') . ')'"
                >
                    @if (filled($tabKey))
                        {{ $isGroup ? $manager->getLabel() : $manager::getTitle($ownerRecord, $pageClass) }}
                    @elseif ($content)
                        {{ $contentTabLabel }}
                    @endif
                </x-filament::tabs.item>
            @endforeach
        </x-filament::tabs>
    @endif

    @if (filled($activeManager) && isset($managers[$activeManager]))
        <div
            @if (count($managers) > 1)
                id="relationManager{{ ucfirst($activeManager) }}"
                role="tabpanel"
                tabindex="0"
            @endif
            class="flex flex-col gap-y-4"
        >
            @php
                $managerLivewireProperties = ['lazy' => true, 'ownerRecord' => $ownerRecord, 'pageClass' => $pageClass];

                if (filled($activeLocale)) {
                    $managerLivewireProperties['activeLocale'] = $activeLocale;
                }
            @endphp

            @if ($managers[$activeManager] instanceof \Filament\Resources\RelationManagers\RelationGroup)
                @foreach ($managers[$activeManager]->ownerRecord($ownerRecord)->pageClass($pageClass)->getManagers() as $groupedManager)
                    @php
                        $normalizedGroupedManagerClass = $normalizeRelationManagerClass($groupedManager);
                    @endphp

                    @livewire(
                        $normalizedGroupedManagerClass,
                        [...$managerLivewireProperties, ...(($groupedManager instanceof \Filament\Resources\RelationManagers\RelationManagerConfiguration) ? $groupedManager->properties : [])],
                        key($normalizedGroupedManagerClass),
                    )
                @endforeach
            @else
                @php
                    $manager = $managers[$activeManager];
                    $normalizedManagerClass = $normalizeRelationManagerClass($manager);
                @endphp

                @livewire(
                    $normalizedManagerClass,
                    [...$managerLivewireProperties, ...(($manager instanceof \Filament\Resources\RelationManagers\RelationManagerConfiguration) ? $manager->properties : [])],
                    key($normalizedManagerClass),
                )
            @endif
        </div>
    @elseif ($content)
        {{ $content }}
    @endif
</div>
