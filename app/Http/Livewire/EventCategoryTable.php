<?php

namespace App\Http\Livewire;

use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class EventCategoryTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPageTable'];

    public string $primaryKey = 'event_category_id';

    protected string $pageName = 'event-category-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.event_category.event_category'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.common.is_active'), 'is_active')
                ->sortable()->addClass('w-150px'),
            Column::make(__('messages.common.action'))->addClass('w-125px text-start'),
        ];
    }

    public function changeFilter($param, $value)
    {
        $this->statusFilter = $value;
        $this->customResetPage('event-category-table');
    }

    public function query(): Builder
    {
        $query = EventCategory::with('events')->select('event_categories.*');

        if (isset($this->statusFilter)) {
            $query->when(isset($this->statusFilter) && $this->statusFilter != EventCategory::ALL, function ($query) {
                return $query->where('is_active', $this->statusFilter);
            });
        }

        return $query;
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.event_category_table';
    }

    public function render()
    {
        $status = EventCategory::STATUS;

        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
                'componentName' => 'admin.event-category.add-button',
                'statusComponent' => 'admin.event-category.status-filter',
                'status' => $status,
            ]);
    }

    public function resetPageTable($pageName = 'event-category-table')
    {
        $this->customResetPage($pageName);
    }
}
