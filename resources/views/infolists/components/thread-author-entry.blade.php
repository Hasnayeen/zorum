@php
    $author = $getRecord()->user;
    $defaultImageUrl = $getDefaultImageUrl();
    $height = $getHeight() ?? '2.5rem';
    $width = $getWidth() ?? $height;
@endphp
<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div class="flex items-center space-x-4">
        <img
            src="{{ filled($author->avatar) ? $getImageUrl($avatar) : $defaultImageUrl }}"
            {{
                $getExtraImgAttributeBag()
                    ->class([
                        'max-w-none object-cover object-center rounded-full',
                    ])
                    ->style([
                        "height: {$height}" => $height,
                        "width: {$width}" => $width,
                    ])
            }}
        />

        <div class="flex flex-col space-y-1">
            <span class="text-sm font-semibold">
                {{ $author->name }}
            </span>
            <span class="text-xs">
                {{ $getRecord()->created_at->diffForHumans() }}
            </span>
        </div>
    </div>
</x-dynamic-component>
