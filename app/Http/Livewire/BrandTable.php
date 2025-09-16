<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BrandTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'brand_id';

    protected string $pageName = 'brand-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')->sortable()->searchable(),
            Column::make(__('messages.common.action'))->addClass('w-125px'),
        ];
    }

    public function query(): Builder
    {
        return Brand::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.brand_table';
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
                'componentName' => 'admin.brands.add-button',
            ]);
    }

    public function resetPageTable($pageName = 'brand-table')
    {
        $this->customResetPage($pageName);
    }
}
