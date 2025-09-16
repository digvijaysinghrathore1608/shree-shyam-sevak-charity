<?php

namespace App\Http\Livewire;

use App\Models\EmailSubscribe;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class EmailSubscribeTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'email_subscribes_id';

    protected string $pageName = 'email_subscribe_table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.email'), 'email')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'))->addClass('text-center'),
        ];
    }

    public function query(): Builder
    {
        return EmailSubscribe::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.email_subscribe_table';
    }

    public function resetPageTable($pageName = 'email_subscribe_table')
    {
        $this->customResetPage($pageName);
    }
}
