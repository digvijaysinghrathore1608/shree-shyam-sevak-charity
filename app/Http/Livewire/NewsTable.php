<?php

namespace App\Http\Livewire;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class NewsTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'news_id';

    protected string $pageName = 'news-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.image')),
            Column::make(__('messages.common.title'), 'title')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.news.news_category'), 'newsCategory.name')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(NewsCategory::select('name')->whereColumn('id', 'news_category_id'),
                        $direction);
                })->searchable()->addClass('justify-content-center d-flex'),
            Column::make(__('messages.common.action'))->addClass('w-150px text-center'),
        ];
    }

    public function query(): Builder
    {
        return News::with(['newsCategory', 'newsTags', 'media'])->select('news.*');
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.news_table';
    }

    public function render()
    {
        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
                'componentName' => 'admin.news.add-button',
            ]);
    }

    public function resetPageTable($pageName = 'news-table')
    {
        $this->customResetPage($pageName);
    }
}
