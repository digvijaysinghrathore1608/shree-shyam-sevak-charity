<?php

namespace App\Http\Livewire;

use App\Models\Campaign;
use App\Models\Withdraw;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserWithdrawTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter'];

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    protected string $pageName = 'user-withdraw-table';
    
    public $statusFilter;

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.title'), 'campaign.title')
                ->searchable()
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(Campaign::select('title')->whereColumn('id', 'campaign_id'), $direction);
                })->addClass('250px'),
            Column::make(__('messages.campaign.goal'), 'campaign.goal')
                ->searchable()
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(Campaign::select('goal')->whereColumn('id', 'campaign_id'), $direction);
                }),
            Column::make(__('messages.campaign.amount')),
            //            Column::make(__('messages.campaign.deducted_amount'), 'id'),
            Column::make(__('messages.campaign.charge_amount'), 'id'),
            Column::make('Settlement Amount'),
            Column::make(__('messages.common.status')),
            Column::make(__('messages.common.action'))->addClass('w-70px text-center'),
        ];
    }

    public function query(): Builder
    {
        return Withdraw::query()->whereHas('campaign.user',function($q){
            return $q->whereId(getLogInUserId());
        })->when(isset($this->statusFilter) && $this->statusFilter != Withdraw::STATUS_All, function ($query) {
                return $query->where('status', $this->statusFilter);
            });
    }

    public function changeFilter($param, $value)
    {
        $this->statusFilter = $value;
        $this->customResetPage('user-withdraw-table');
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.user_withdraw_table';
    }

    public function render()
    {
        $status = Withdraw::STATUS;

        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
                'statusComponent' => 'user.withdraw.status-filter',
                'status' => $status,
            ]);
    }
}
