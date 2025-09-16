<?php

namespace App\Http\Livewire;

use App\Models\Campaign;
use App\Models\Withdraw;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CampaignWithdrawRequestTable extends LivewireTableComponent
{
    public $campaignId;

    public bool $showSearch = false;

    public function columns(): array
    {
        return [
            Column::make(__('messages.campaign.amount'), 'amount')->searchable()->sortable(),
            Column::make(__('messages.campaign.withdraw_amount'), 'deducate_amount')->searchable()->sortable(),
            Column::make(__('messages.campaign.charge_amount'), 'charge_amount')->searchable()->sortable(),
            Column::make(__('messages.common.status')),
            Column::make(__('messages.campaign.payment_type')),
            Column::make(__('messages.common.updated_at')),
        ];
    }

    public function mount($campaignId){
        $this->campaignId = $campaignId;
    }
    
    public function query(): Builder
    {
        return Withdraw::query()->whereCampaignId($this->campaignId)->where('status','!=',Withdraw::NEED_TO_WITHDRAW);
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.campaign_withdraw_request';
    }
}
