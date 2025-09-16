<?php

namespace App\Http\Livewire;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class InquiryTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPageTable'];

    public string $primaryKey = 'inquiry_id';

    protected string $pageName = 'inquiry-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public $statusFilter = Inquiry::ALL;

    public function columns(): array
    {
        return [

            Column::make(__('messages.common.name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.inquiries.subject'), 'subject')
                ->searchable()->sortable(),
            Column::make(__('messages.common.status'), 'status'),
            Column::make(__('messages.common.created_on'), 'created_at')
                ->sortable(),
            Column::make(__('messages.common.action'))->addClass('w-125px text-start'),

        ];
    }

    public function query(): Builder
    {
        return Inquiry::query()
            ->when(isset($this->statusFilter) && $this->statusFilter != Inquiry::ALL, function ($query) {
                return $query->where('status', $this->statusFilter);
            });
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.inquiry_table';
    }

    /**
     * @param $param
     * @param $value
     */
    public function changeFilter($param, $value)
    {
        $this->statusFilter = $value;
        $this->customResetPage('inquiry-table');
    }

    public function render()
    {
        $status = Inquiry::STATUS;

        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
                'statusComponent' => 'admin.inquiries.filter-button',
                'status' => $status,
            ]);
    }

    public function resetPageTable($pageName = 'inquiry-table')
    {
        $this->customResetPage($pageName);
    }
}
