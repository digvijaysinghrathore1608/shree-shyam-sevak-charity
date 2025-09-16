<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TeamTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'team_id';

    protected string $pageName = 'team-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.teams.designation'), 'designation')
                ->sortable()->searchable()->addClass('justify-content-center d-flex'),
            Column::make(__('messages.common.created_on'), 'created_at')
                ->sortable(),
            Column::make(__('messages.common.action'))->addClass('w-125px'),
        ];
    }

    public function query(): Builder
    {
        return Team::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.team_table';
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
                'componentName' => 'admin.teams.add-button',
            ]);
    }

    public function resetPageTable($pageName = 'team-table')
    {
        $this->customResetPage($pageName);
    }
}
