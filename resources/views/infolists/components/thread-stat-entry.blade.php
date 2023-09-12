@php
    $votes = $getRecord()->upvote - $getRecord()->downvote;
@endphp
<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry" class="border-t -mx-4">
    <div class="mx-4 pt-4 flex justify-between items-center">
        <div class="flex space-x-4">
            <div class="border rounded pl-1 pr-2 flex items-center font-semibold text-gray-600">
                <x-filament::icon icon="arrow-big-up" class="text-gray-500" />
                {{ $votes }}
            </div>
            <div class="border rounded pl-1 pr-2 flex items-center font-semibold text-gray-600">
                <x-filament::icon icon="message-circle" class="text-gray-500 h-5" />
                {{ $getRecord()->comments_count }}
            </div>
        </div>
        {{ $getAction('reply') }}
    </div>
</x-dynamic-component>
