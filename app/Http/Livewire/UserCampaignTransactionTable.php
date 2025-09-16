<?php

namespace App\Http\Livewire;

use App\Models\Campaign;
use App\Models\CampaignDonation;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserCampaignTransactionTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPageTable'];

    public string $defaultSortColumn = 'created_at';

    protected string $pageName = 'user-campaign-transaction-table';

    public string $defaultSortDirection = 'desc';

    public $campaignId;

    public function columns(): array
    {
        return [
            Column::make(__('messages.user.full_name'), 'first_name')
                ->sortable()->searchable(),
            Column::make(__('messages.campaign_transactions.donated_amount'), 'donated_amount')
                ->sortable()->searchable()->addClass('w-200px transaction-amount-center'),
            Column::make(__('messages.campaign_transactions.charge_amount'), 'charge_amount')
                ->sortable()->searchable(),
            Column::make(__('messages.campaign_transactions.payment_method'),
                'donated_amount')->addClass('justify-content-center d-flex'),
            Column::make(__('messages.common.created_at'),
                'created_at')->addClass('text-center'),
            Column::make(__('messages.common.action'))->addClass('w-125px'),
        ];
    }

    public function query(): Builder
    {
        return CampaignDonation::with('campaign')->whereCampaignId($this->campaignId);
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.user_campaign_transaction_table';
    }

    public function render()
    {
        $totalAmount = CampaignDonation::whereCampaignId($this->campaignId)->sum('donated_amount');
        $campaign = Campaign::whereId($this->campaignId)->first();

        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
                'componentName' => 'user.campaigns.campaign_transactions.total-amount',
                'totalAmount' => $totalAmount,
                'campaign' => $campaign,
            ]);
    }

    public function resetPageTable($pageName = 'user-campaign-transaction-table')
    {
        $this->customResetPage($pageName);
    }
}
