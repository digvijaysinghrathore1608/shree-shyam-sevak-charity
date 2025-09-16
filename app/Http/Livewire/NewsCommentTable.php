<?php

namespace App\Http\Livewire;

use App\Models\NewsComment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class NewsCommentTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'news_comment_id';

    protected string $pageName = 'news-comment-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public $newsId;

    public function columns(): array
    {
        return [
            Column::make(__('messages.news_comments.comments'), 'comments')
                ->sortable()->searchable(),
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.common.created_at'), 'created_at')->sortable(),
            Column::make(__('messages.common.action'))->addClass('w-150px'),
        ];
    }

    public function query(): Builder
    {
        return  NewsComment::whereNewsId($this->newsId);
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.news_comment_table';
    }

    public function resetPageTable($pageName = 'news-comment-table')
    {
        $this->customResetPage($pageName);
    }
}
