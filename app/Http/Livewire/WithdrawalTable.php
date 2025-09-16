<?php

namespace App\Http\Livewire;

use App\Models\Withdrawal;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class WithdrawalTable extends LivewireTableComponent
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
            Column::make(__('messages.withdrawal.payment_type'), 'payment_type')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'))->addClass('w-125px'),
        ];
    }

    public function query(): Builder
    {
        return Withdrawal::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.withdrawal_table';
    }

    public function resetPageTable($pageName = 'team-table')
    {
        $this->customResetPage($pageName);
    }
}
