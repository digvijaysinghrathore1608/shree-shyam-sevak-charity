<?php

namespace App\Http\Livewire;

use App\Models\FrontSliderThird;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class FrontSliderThirdTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'front_cms_third_slider_id';

    protected string $pageName = 'third-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.image'), 'image'),
            Column::make(__('messages.slider.title_1'), 'title_1')
                ->sortable()->searchable(),
            Column::make(__('messages.slider.title_2'), 'title_2')
                ->sortable()->searchable()->addClass('justify-content-center d-flex'),
            Column::make(__('messages.common.action'))->addClass('w-100px text-center'),
        ];
    }

    public function query(): Builder
    {
        return FrontSliderThird::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.front_slider_third_table';
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
                'componentName' => 'admin.front-cms3.sliders.add-button',
            ]);
    }

    public function resetPageTable($pageName = 'third-table')
    {
        $this->customResetPage($pageName);
    }
}
