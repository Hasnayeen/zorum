@php
    $isLoaded = $this->isTableLoaded();
    $records = $isLoaded ? $this->getTableRecords() : null;
@endphp
<x-filament-widgets::widget class="">
    {{ $this->infolist }}

    @if ($records instanceof \Illuminate\Contracts\Pagination\Paginator && ((! ($records instanceof
        \Illuminate\Contracts\Pagination\LengthAwarePaginator)) || $records->total()))
        <x-filament::pagination :page-options="$this->table->getPaginationPageOptions()" :paginator="$records" class="py-6" />
    @endif
</x-filament-widgets::widget>
