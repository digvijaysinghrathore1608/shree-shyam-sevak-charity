<?php

namespace App\Http\Livewire;

use App\Models\CallToAction;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CallToActionTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPageTable'];

    public string $primaryKey = 'call_to_action_id';

    protected string $pageName = 'call-to-action-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.call_to_actions.zip'), 'zip')
                ->sortable()->searchable(),
            Column::make(__('messages.common.created_on'), 'created_at')
                ->sortable(),
            Column::make(__('messages.common.status'), 'status')
                ->sortable(),
            Column::make(__('messages.common.action'))->addClass('w-125px'),
        ];
    }

    public function query(): Builder
    {
        return CallToAction::query()
            ->when(isset($this->statusFilter) && $this->statusFilter != CallToAction::ALL, function ($query) {
                return $query->where('status', $this->statusFilter);
            });
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.call_to_action_table';
    }

    /**
     * @param $param
     * @param $value
     */
    public function changeFilter($param, $value)
    {
        $this->statusFilter = $value;
        $this->customResetPage('call-to-action-table');
    }

    public function render()
    {
        $status = CallToAction::STATUS;

        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
                'statusComponent' => 'admin.call_to_actions.filter-button',
                'status' => $status,
            ]);
    }

    public function resetPageTable($pageName = 'call-to-action-table')
    {
        $this->customResetPage($pageName);
    }
}
