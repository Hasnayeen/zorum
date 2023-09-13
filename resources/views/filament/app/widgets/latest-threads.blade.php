@php
    $isLoaded = $this->isTableLoaded();
    $records = $isLoaded ? $this->getTableRecords() : null;
@endphp
<x-filament-widgets::widget class="">
    <div class="flex justify-between items-center pb-4">
        <x-filament-actions::actions
            :actions="$this->getHeaderActions()"
            @class([
                'shrink-0',
            ])
        />
        <x-filament::input.wrapper>
            <x-filament::input.select wire:model.live="filter">
                <option value="default">All</option>
                <option value="trending">Trending</option>
                <option value="hot">Hot</option>
            </x-filament::input.select>
        </x-filament::input.wrapper>
    </div>

    {{ $this->infolist }}

    @if ($records instanceof \Illuminate\Contracts\Pagination\Paginator && ((! ($records instanceof
        \Illuminate\Contracts\Pagination\LengthAwarePaginator)) || $records->total()))
        <x-filament::pagination :page-options="$this->table->getPaginationPageOptions()" :paginator="$records" class="py-6" />
    @endif
</x-filament-widgets::widget>
