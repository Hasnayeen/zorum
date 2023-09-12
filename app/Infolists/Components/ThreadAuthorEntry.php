<?php

namespace App\Infolists\Components;

use Closure;
use Throwable;
use Illuminate\Support\Facades\Storage;
use Filament\Infolists\Components\Entry;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Flysystem\UnableToCheckFileExistence;

class ThreadAuthorEntry extends Entry
{
    protected string $view = 'infolists.components.thread-author-entry';

    protected string | Closure | null $defaultImageUrl = null;

    protected string | Closure | null $disk = null;

    protected int | string | Closure | null $height = null;

    protected int | string | Closure | null $width = null;

    /**
     * @var array<mixed> | Closure
     */
    protected array | Closure $extraImgAttributes = [];

    public function height(int | string | Closure | null $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getHeight(): ?string
    {
        $height = $this->evaluate($this->height);

        if ($height === null) {
            return null;
        }

        if (is_int($height)) {
            return "{$height}px";
        }

        return $height;
    }

    public function width(int | string | Closure | null $width): static
    {
        $this->width = $width;

        return $this;
    }

    public function getWidth(): ?string
    {
        $width = $this->evaluate($this->width);

        if ($width === null) {
            return null;
        }

        if (is_int($width)) {
            return "{$width}px";
        }

        return $width;
    }

    public function getDisk(): Filesystem
    {
        return Storage::disk($this->getDiskName());
    }

    public function getDiskName(): string
    {
        return $this->evaluate($this->disk) ?? config('filament.default_filesystem_disk');
    }

    public function defaultImageUrl(string | Closure | null $url): static
    {
        $this->defaultImageUrl = $url;

        return $this;
    }

    public function getImageUrl(?string $state = null): ?string
    {
        if (filter_var($state, FILTER_VALIDATE_URL) !== false) {
            return $state;
        }

        /** @var FilesystemAdapter $storage */
        $storage = $this->getDisk();

        try {
            if (! $storage->exists($state)) {
                return null;
            }
        } catch (UnableToCheckFileExistence $exception) {
            return null;
        }

        if ($this->getVisibility() === 'private') {
            try {
                return $storage->temporaryUrl(
                    $state,
                    now()->addMinutes(5),
                );
            } catch (Throwable $exception) {
                // This driver does not support creating temporary URLs.
            }
        }

        return $storage->url($state);
    }

    public function getDefaultImageUrl(): ?string
    {
        return $this->evaluate($this->defaultImageUrl);
    }

    /**
     * @param  array<mixed> | Closure  $attributes
     */
    public function extraImgAttributes(array | Closure $attributes): static
    {
        $this->extraImgAttributes = $attributes;

        return $this;
    }

    /**
     * @return array<mixed>
     */
    public function getExtraImgAttributes(): array
    {
        return $this->evaluate($this->extraImgAttributes);
    }

    public function getExtraImgAttributeBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getExtraImgAttributes());
    }
}
