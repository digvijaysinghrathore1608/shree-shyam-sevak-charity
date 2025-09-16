<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class EventTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPageTable'];

    public string $primaryKey = 'event_id';

    protected string $pageName = 'event-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.event.event_title'), 'title')
                ->sortable()->searchable(),
            Column::make(__('messages.event.event_category'), 'eventCategory.name')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(EventCategory::select('name')->whereColumn('id', 'category_id'), $direction);
                })->searchable()->addClass('justify-content-center d-flex'),
            Column::make(__('messages.common.status'), 'status')
                ->sortable(),
            Column::make(__('messages.event.registration'), 'registration')->addClass('text-center'),
            Column::make(__('messages.events.event_date'), 'event_date')
                ->sortable(),
            Column::make(__('messages.common.action'))->addClass('w-150px text-center'),
        ];
    }

    public function changeFilter($param, $value)
    {
        $this->statusFilter = $value;
        $this->customResetPage('event-table');
    }

    public function query(): Builder
    {
        $query = Event::with('eventCategory')->select('events.*');

        if (isset($this->statusFilter)) {
            $query->when(isset($this->statusFilter) && $this->statusFilter != Event::ALL, function ($query) {
                return $query->where('status', $this->statusFilter);
            });
        }

        return $query;
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.event_table';
    }

    public function render()
    {
        $status = Event::STATUS;

        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
                'componentName' => 'admin.events.add-button',
                'statusComponent' => 'admin.events.status-filter',
                'status' => $status,
            ]);
    }

    public function resetPageTable($pageName = 'event-table')
    {
        $this->customResetPage($pageName);
    }
}
