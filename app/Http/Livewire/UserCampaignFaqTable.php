<?php

namespace App\Http\Livewire;

use App\Models\CampaignFaq;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserCampaignFaqTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';

    protected $listeners = ['refresh' => '$refresh', 'resetPageTable'];

    public string $primaryKey = 'user_campaign_faqs_id';

    protected string $pageName = 'user-campaign-faq-table';

    public string $defaultSortColumn = 'created_at';

    public string $defaultSortDirection = 'desc';

    public $campaignId;

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.title'), 'title')
                ->sortable()->searchable(),
            Column::make(__('messages.common.created_at'), 'created_at')
                ->sortable()->searchable()->addClass('w-200px'),
            Column::make(__('messages.common.action'))->addClass('w-150px text-center'),
        ];
    }

    public function query(): Builder
    {
        return CampaignFaq::where('campaign_id', $this->campaignId);
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.user_campaign_faq_table';
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
                'componentName' => 'user.campaigns.campaign_faqs.add-button',
            ]);
    }

    public function resetPageTable($pageName = 'user-campaign-faq-table')
    {
        $this->customResetPage($pageName);
    }
}
