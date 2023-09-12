<?php

namespace App\Filament\App\Widgets;

use App\Enums\ReactionType;
use App\Infolists\Components\ThreadAuthorEntry;
use App\Infolists\Components\ThreadStatEntry;
use App\Models\Thread;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
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
                'threads' => $this->getTableRecords(),
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
                        ThreadAuthorEntry::make('user')
                            ->label('')
                            ->defaultImageUrl(fn (Thread $thread) => 'https://unavatar.io/' . $thread->user->email)
                            ->extraImgAttributes([
                                'alt' => 'user avatar',
                                'loading' => 'lazy',
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
                                    ->color('gray')
                                    ->url(fn (Thread $thread) => url('tags/' . $thread->tag?->id))
                                    ->label('')
                                    ->size(TextEntrySize::Small),
                            ]),
                        ThreadStatEntry::make('reactions')
                            ->label('')
                            ->registerActions([
                                Action::make('reply')
                                    ->color('gray'),
                            ])
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Thread::query()
                    ->withCount([
                        'reactions as upvote' => fn ($query) => $query->where('type', ReactionType::Upvote),
                        'reactions as downvote' => fn ($query) => $query->where('type', ReactionType::Downvote),
                        'comments',
                    ])
                    ->latest()
                    ->limit(10)
            );
    }
}
