@php
    $keyBindings = filament()->getGlobalSearchKeyBindings();
@endphp

<div
    x-id="['input']"
    {{ $attributes->class(['fi-global-search-field']) }}
>
    <label x-bind:for="$id('input')" class="sr-only">
        {{ __('filament-panels::global-search.field.label') }}
    </label>

    <x-filament::input.wrapper
        inline-prefix
        prefix-icon="heroicon-m-magnifying-glass"
        prefix-icon-alias="panels::global-search.field"
        wire:target="search"
    >
        <x-filament::input
            autocomplete="off"
            inline-prefix
            :placeholder="__('filament-panels::global-search.field.placeholder')"
            type="search"
            wire:model.live.debounce.500ms="search"
            x-bind:id="$id('input')"
            wire:key="global-search.field.input"
            x-data="{}"
            :attributes="
                \Filament\Support\prepare_inherited_attributes(
                    new \Illuminate\View\ComponentAttributeBag([
                        'x-mousetrap.global.' . collect($keyBindings)->map(fn (string $keyBinding): string => str_replace('+', '-', $keyBinding))->implode('.') => $keyBindings ? 'document.getElementById($id(\'input\')).focus()' : null,
                    ])
                )
            "
        />
    </x-filament::input.wrapper>
</div>
