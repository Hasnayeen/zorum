<?php

namespace App\Concerns;

use Filament\Navigation\MenuItem;
trait HasHub
{
    /**
     * @var array<MenuItem>
     */
    protected array $hubMenuItems = [];

    /**
     * @param  array<MenuItem>  $items
     */
    public function hubMenuItems(array $items): static
    {
        $this->hubMenuItems = [
            ...$this->hubMenuItems,
            ...$items,
        ];

        return $this;
    }

    /**
     * @return array<MenuItem>
     */
    public function getHubMenuItems(): array
    {
        return collect($this->hubMenuItems)
            ->filter(function (MenuItem $item): bool {
                return $item->isVisible();
            })
            ->sort(fn (MenuItem $item): int => $item->getSort())
            ->all();
    }
}
