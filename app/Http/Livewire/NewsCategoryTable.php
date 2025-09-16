<?php

namespace App\Http\Livewire;

use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class NewsCategoryTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'news_category_id';

    protected string $pageName = 'news-category-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'))->addClass('w-125px text-start'),
        ];
    }

    public function query(): Builder
    {
        return NewsCategory::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.news_category_table';
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
                'componentName' => 'admin.news_categories.add-button',
            ]);
    }

    public function resetPageTable($pageName = 'news-category-table')
    {
        $this->customResetPage($pageName);
    }
}
