<?php

namespace App\Http\Livewire;

use App\Models\EventParticipant;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class EventParticipantTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'event_participant_id';

    protected string $pageName = 'event-participant-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public $eventId;

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.event.notes'), 'notes')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'))->addClass('w-150px text-center'),
        ];
    }

    public function mount($eventId)
    {
        $this->eventId = $eventId;
    }

    public function query(): Builder
    {
        return  EventParticipant::whereEventId($this->eventId);
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.event_participant_table';
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
                'componentName' => 'admin.events.event-participant-add-button',
            ]);
    }

    public function resetPageTable($pageName = 'event-participant-table')
    {
        $this->customResetPage($pageName);
    }
}
