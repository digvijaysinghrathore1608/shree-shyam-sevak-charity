<?php

namespace App\Http\Livewire;

use App\Models\CampaignCategory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CampaignCategoryTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPageTable'];

    public string $primaryKey = 'campaign_categories_id';

    protected string $pageName = 'campaign-category-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')
                ->sortable()->searchable(),
            Column::make(__('messages.common.image')),
            Column::make(__('messages.common.is_active')),
            Column::make(__('messages.common.action'))->addClass('w-125px'),
        ];
    }

    public function changeFilter($param, $value)
    {
        $this->statusFilter = $value;
        $this->customResetPage('campaign-category-table');
    }

    public function query(): Builder
    {
        $query = CampaignCategory::query()->with('campaigns');

        if (isset($this->statusFilter)) {
            $query->when(isset($this->statusFilter) && $this->statusFilter != CampaignCategory::ALL, function ($query) {
                return $query->where('is_active', $this->statusFilter);
            });
        }

        return $query;
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.campaign_category_table';
    }

    public function render()
    {
        $status = CampaignCategory::STATUS;

        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
                'componentName' => 'admin.campaign-category.add-button',
                'statusComponent' => 'admin.campaign-category.status-filter',
                'status' => $status,
            ]);
    }

    public function resetPageTable($pageName = 'campaign-category-table')
    {
        $this->customResetPage($pageName);
    }
}
