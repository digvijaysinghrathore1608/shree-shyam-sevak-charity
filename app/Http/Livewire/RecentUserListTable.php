<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RecentUserListTable extends LivewireTableComponent
{
    public bool $showSearch = false;

    public function columns(): array
    {
        return [
            Column::make(__('messages.user.full_name'), 'first_name'),
            Column::make(__('messages.common.email'), 'email'),
            Column::make(__('messages.user.contact_number'), 'contact'),
            Column::make(__('messages.dashboards.registration_on'), 'created_at')->addClass('w-25'),
        ];
    }

    public function query(): Builder
    {
        return User::query()->where('created_at', '>=', Carbon::now()->subDays(6));
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.recent_user_list_table';
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
            ]);
    }
}
