<?php

namespace App\Http\Livewire;

use App\Models\CategoryThird;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CategoryThirdTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'third_category_id';

    protected string $pageName = 'third-category-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.image'), 'image'),
            Column::make(__('messages.common.title'), 'title')
                ->sortable()->searchable(),
            Column::make(__('messages.common.created_on'), 'created_at')
                ->sortable(),
            Column::make(__('messages.common.action'))->addClass('text-center'),
        ];
    }

    public function query(): Builder
    {
        return CategoryThird::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.category_third_table';
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
                'componentName' => 'admin.front-cms3.categories.add-button',
            ]);
    }

    public function resetPageTable($pageName = 'third-category-table')
    {
        $this->customResetPage($pageName);
    }
}
