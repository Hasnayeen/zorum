<?php

namespace App\Filament\App\Widgets;

use App\Models\Thread;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Grid as ComponentsGrid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestThreads extends BaseWidget implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;

    protected int | string | array $columnSpan = 'full';
    protected static string $view = 'filament.app.widgets.latest-threads';

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([
                'threads' => $this->getTableRecords()
            ])
            ->schema([
                RepeatableEntry::make('threads')
                    ->label('')
                    ->schema([
                        TextEntry::make('hub.name')
                            ->icon('icon-at-sign')
                            ->badge()
                            ->url(fn (Thread $thread) => url('hubs/' . $thread->hub->id))
                            ->label('')
                            ->size(TextEntrySize::ExtraSmall),
                        TextEntry::make('title')
                            ->url(fn (Thread $thread) => url('threads/' . $thread->id))
                            ->label('')
                            ->extraAttributes([
                                'class' => 'font-semibold zorum-heading',
                            ]),
                        TextEntry::make('body')
                            ->label('')
                            ->size(TextEntrySize::Small),
                        ComponentsGrid::make(12)
                            ->schema([
                                ImageEntry::make('user.avatar')
                                    ->columnSpan(1)
                                    ->label('')
                                    ->defaultImageUrl('https://unavatar.io/sindresorhus@gmail.com')
                                    ->size(48)
                                    ->circular()
                                    ->extraImgAttributes([
                                        'alt' => 'user avatar',
                                        'loading' => 'lazy',
                                    ]),
                                ComponentsGrid::make(1)
                                    ->columnStart(2)
                                    ->extraAttributes([
                                        'class' => 'zorum-in-grid',
                                    ])
                                    ->schema([
                                        TextEntry::make('user.name')
                                            ->label('')
                                            ->extraAttributes([
                                                'class' => 'font-semibold',
                                            ])
                                            ->url(fn (Thread $thread) => url('users/' . $thread->user->id)),
                                        TextEntry::make('created_at')
                                            ->label('')
                                            ->size(TextEntrySize::Small)
                                            ->getStateUsing(fn (Thread $thread) => $thread->created_at->diffForHumans()),
                                    ]),
                        ]),
                        RepeatableEntry::make('tags')
                            ->label('')
                            ->contained(false)
                            ->extraAttributes([
                                'class' => 'zorum-tags',
                            ])
                            ->schema([
                                TextEntry::make('name')
                                    ->columnSpan(1)
                                    ->badge()
                                    ->icon('icon-tag')
                                    ->color('info')
                                    ->url(fn (Thread $thread) => url('tags/' . $thread->tag?->id))
                                    ->label('')
                                    ->size(TextEntrySize::Small),
                            ]),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Thread::query()
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Grid::make(4)
                    ->schema([
                        Tables\Columns\TextColumn::make('title')
                            ->searchable()
                            ->sortable(),
                        Tables\Columns\TextColumn::make('user.name')
                            ->searchable()
                            ->sortable(),
                        Tables\Columns\TextColumn::make('created_at')
                            ->dateTime()
                            ->sortable(),
                    ])
            ]);
    }
}
