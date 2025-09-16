<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPageTable'];

    public string $primaryKey = 'user_id';

    protected string $pageName = 'user-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public string $verified = '';

    public function columns(): array
    {
        return [
            Column::make(__('messages.user.full_name'), 'first_name')->sortable()->searchable(),
            Column::make(__('messages.role.role'),
                'roles.name')->searchable()->addClass('justify-content-center d-flex'),
            Column::make(__('messages.common.email_verified')),
            Column::make(__('messages.common.is_active')),
            Column::make(__('messages.common.action'))->addClass('w-100px'),
        ];
    }

    public function query(): Builder
    {
        return User::query()
            ->when(isset($this->statusFilter) && $this->statusFilter != User::ALL, function ($query) {
                return $query->where('is_active', $this->statusFilter);
            })
            ->when(isset($this->verified) && $this->verified != '', function ($query) {
                return $query->where('email_verified_at', '!=', null);
            });
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.user_table';
    }

    public function changeFilter($param, $value)
    {
        $this->statusFilter = $value;
        $this->customResetPage('user-table');
    }

    public function render()
    {
        $status = User::STATUS;

        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
                'componentName' => 'admin.users.add-button',
                'statusComponent' => 'admin.users.status-filter',
                'status' => $status,
            ]);
    }

    public function resetPageTable($pageName = 'user-table')
    {
        $this->customResetPage($pageName);
    }
}
