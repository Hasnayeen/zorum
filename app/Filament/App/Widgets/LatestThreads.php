<?php

namespace App\Filament\App\Widgets;

use App\Enums\ReactionType;
use App\Infolists\Components\ThreadAuthorEntry;
use App\Infolists\Components\ThreadStatEntry;
use App\Models\Thread;
use Filament\Actions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class LatestThreads extends Widget implements HasForms, HasInfolists, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use InteractsWithInfolists;

    protected int | string | array $columnSpan = 'full';
    protected static string $view = 'filament.app.widgets.latest-threads';
    public $filter = 'default';
    protected $query;

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
                        ThreadAuthorEntry::make('user')
                            ->label('')
                            ->defaultImageUrl(fn (Thread $thread) => 'https://unavatar.io/' . $thread->user->email)
                            ->extraImgAttributes([
                                'alt' => 'user avatar',
                                'loading' => 'lazy',
                            ]),
                        TextEntry::make('title')
                            ->url(fn (Thread $thread) => url('threads/' . $thread->id))
                            ->label('')
                            ->extraAttributes([
                                'class' => 'font-semibold zorum-heading',
                            ]),
                        TextEntry::make('body')
                            ->label('')
                            ->size(TextEntrySize::Small),
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
            ->query($this->getFilterQuery());
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Thread'),
        ];
    }

    public function updated($property)
    {
        if ($property === 'filter') {
            $this->getTable()->query($this->getFilterQuery());
        }
    }

    public function getFilterQuery()
    {
        $query = Thread::query();

        return match ($this->filter) {
            'trending' => $query->select('threads.*')
                ->withCount('comments')
                ->leftJoin('reactions as upvotes', function ($join) {
                    $join->on('threads.id', '=', 'upvotes.reactable_id')
                        ->where('upvotes.reactable_type', '=', 'App\\Models\\Thread')
                        ->where('upvotes.type', '=', ReactionType::Upvote)
                        ->where('upvotes.created_at', '>=', now()->subHours(72));
                })
                ->leftJoin('reactions as downvotes', function ($join) {
                    $join->on('threads.id', '=', 'downvotes.reactable_id')
                        ->where('downvotes.reactable_type', '=', 'App\\Models\\Thread')
                        ->where('downvotes.type', '=', ReactionType::Downvote)
                        ->where('downvotes.created_at', '>=', now()->subHours(24));
                })
                ->groupBy('threads.id')
                ->orderBy(DB::raw('COUNT(upvotes.id) - COUNT(downvotes.id)'), 'desc')
                ->selectRaw('(COUNT(upvotes.id) - COUNT(downvotes.id)) as vote_difference'),
            'hot' => $query
                ->select('threads.*')
                ->withCount('comments')
                ->leftJoinSub(
                    function ($query) {
                        $query->select('reactable_id',
                                DB::raw('SUM(CASE WHEN type = \'upvote\' THEN 1 ELSE 0 END) AS upvote'),
                                DB::raw('SUM(CASE WHEN type = \'downvote\' THEN 1 ELSE 0 END) AS downvote'))
                            ->from('reactions')
                            ->where('reactable_type', 'App\\Models\\Thread')
                            ->groupBy('reactable_id');
                    },
                    'votes',
                    'threads.id',
                    '=',
                    'votes.reactable_id'
                )
                ->selectRaw('(COALESCE(votes.upvote, 0) - COALESCE(votes.downvote, 0)) as vote_difference, votes.upvote, votes.downvote')
                ->orderBy('comments_count', 'desc')
                ->limit(10),
            'default' => $query
                ->select('threads.*')
                ->withCount('comments')
                ->leftJoinSub(
                    function ($query) {
                        $query->select('reactable_id',
                                DB::raw('SUM(CASE WHEN type = \'upvote\' THEN 1 ELSE 0 END) AS upvote'),
                                DB::raw('SUM(CASE WHEN type = \'downvote\' THEN 1 ELSE 0 END) AS downvote'))
                            ->from('reactions')
                            ->where('reactable_type', 'App\\Models\\Thread')
                            ->groupBy('reactable_id');
                    },
                    'votes',
                    'threads.id',
                    '=',
                    'votes.reactable_id'
                )
                ->selectRaw('(COALESCE(votes.upvote, 0) - COALESCE(votes.downvote, 0)) as vote_difference, votes.upvote, votes.downvote')
                ->latest()
                ->limit(10),
        };
    }
}
