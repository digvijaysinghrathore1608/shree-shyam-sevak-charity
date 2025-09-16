<?php

namespace App\Http\Livewire;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CampaignTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPageTable'];

    public string $primaryKey = 'campaign_id';

    protected string $pageName = 'campaign-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.title'), 'title')
                ->sortable()->searchable()->addClass('250px'),
            Column::make(__('messages.campaign.goal'), 'goal')
                ->sortable()->searchable()->addClass('d-flex justify-content-center'),
            Column::make(__('messages.campaign.received_funds'), 'id'),
            Column::make(__('messages.common.status'), 'status')
                ->sortable()->searchable(),
            Column::make(__('messages.campaign.donors'), 'created_at'),
            Column::make(__('messages.common.action'))->addClass('text-center'),
        ];
    }

    public function query(): Builder
    {
        return Campaign::query()->with('campaignDonations')
            ->when(isset($this->statusFilter) && $this->statusFilter != Campaign::STATUS_All, function ($query) {
                return $query->where('status', $this->statusFilter);
            });
    }

    public function changeFilter($param, $value)
    {
        $this->statusFilter = $value;
        $this->customResetPage('campaign-table');
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.campaign_table';
    }

    public function render()
    {
        $status = Campaign::STATUS_ARRAY;

        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
                'componentName' => 'admin.campaigns.add-button',
                'statusComponent' => 'admin.campaigns.status-filter',
                'status' => $status,
            ]);
    }

    public function resetPageTable($pageName = 'campaign-table')
    {
        $this->customResetPage($pageName);
    }
}
