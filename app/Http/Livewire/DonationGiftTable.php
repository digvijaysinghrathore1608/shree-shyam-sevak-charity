<?php

namespace App\Http\Livewire;

use App\Models\DonationGift;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DonationGiftTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'donation_gift_id';

    protected string $pageName = 'donation-gifts-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.title'), 'title')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.donation_gifts.amount'), 'amount')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.donation_gifts.delivery_date'), 'delivery_date')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.status'), 'status')
                ->sortable(),
            Column::make(__('messages.donation_gifts.gifts'), 'id'),
            Column::make(__('messages.common.action'))->addClass('w-100px text-center'),
        ];
    }

    public function query(): Builder
    {
        $query = DonationGift::with('gifts')->select('donation_gifts.*');

        return $query;
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.donation_gift_table';
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
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
                'componentName' => 'admin.donation_gifts.add-button',
            ]);
    }

    public function resetPageTable($pageName = 'donation-gifts-table')
    {
        $this->customResetPage($pageName);
    }
}
