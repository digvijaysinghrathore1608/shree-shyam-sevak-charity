<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PageTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPageTable'];

    public string $primaryKey = 'page_id';

    protected string $pageName = 'page-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.title'), 'title')
                ->sortable()->searchable(),
            Column::make(__('messages.page.page_name'), 'name')->searchable()
                ->sortable()->addClass('justify-content-center d-flex'),
            Column::make(__('messages.common.status'), 'is_active')
                ->sortable(),
            Column::make(__('messages.common.action'))->addClass('w-150px text-center'),
        ];
    }

    public function changeFilter($param, $value)
    {
        $this->statusFilter = $value;
        $this->customResetPage('page-table');
    }

    public function query(): Builder
    {
        return Page::query()
            ->when(isset($this->statusFilter) && $this->statusFilter != Page::ALL, function ($query) {
                return $query->where('is_active', $this->statusFilter);
            });
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.page_table';
    }

    public function render()
    {
        $status = Page::STATUS;

        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
                'componentName' => 'admin.pages.add-button',
                'statusComponent' => 'admin.pages.status-filter',
                'status' => $status,
            ]);
    }

    public function resetPageTable($pageName = 'page-table')
    {
        $this->customResetPage($pageName);
    }
}
