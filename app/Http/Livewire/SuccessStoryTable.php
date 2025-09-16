<?php

namespace App\Http\Livewire;

use App\Models\SuccessStory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SuccessStoryTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'success_story_id';

    protected string $pageName = 'success-story-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.image')),
            Column::make(__('messages.common.title'), 'title')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'))->addClass('w-125px text-start'),
        ];
    }

    public function query(): Builder
    {
        return SuccessStory::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.success_story_table';
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
                'componentName' => 'admin.front-cms.success-story.add-button',
            ]);
    }

    public function resetPageTable($pageName = 'success-story-table')
    {
        $this->customResetPage($pageName);
    }
}
