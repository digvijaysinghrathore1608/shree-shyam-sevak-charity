<?php

namespace App\Http\Livewire;

use App\Models\FrontSlider;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class FrontSliderTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'front_slider_id';

    protected string $pageName = 'front-sliders-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.image')),
            Column::make(__('messages.slider.title_1'), 'title_1')->sortable()->searchable(),
            Column::make(__('messages.slider.title_2'), 'title_2')->sortable()->searchable(),
            Column::make(__('messages.common.action'))->addClass('w-150px'),
        ];
    }

    public function query(): Builder
    {
        return FrontSlider::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.front_slider_table';
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
                'componentName' => 'admin.front-cms.sliders.add-button',
            ]);
    }

    public function resetPageTable($pageName = 'front-sliders-table')
    {
        $this->customResetPage($pageName);
    }
}
