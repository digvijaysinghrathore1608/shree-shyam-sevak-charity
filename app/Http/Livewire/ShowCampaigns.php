<?php

namespace App\Http\Livewire;

use App\Models\Campaign;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCampaigns extends Component
{
    use WithPagination;

    public $campaignCategoryId;

    protected $listeners = ['changeFilter', 'resetFilter'];

    protected $paginationTheme = 'bootstrap';

    /**
     * @param $param
     * @param $value
     */
    public function changeFilter($param, $value)
    {
        $this->reset();

        $this->$param = $value;
    }

    public function resetFilter()
    {
        $this->reset();
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $campaigns = $this->campaignCategoryWise();

        return view('livewire.show-campaigns', compact('campaigns'));
    }

    /**
     * @return mixed
     */
    public function campaignCategoryWise()
    {
        /** @var Campaign $query */
        $mainQuery = $query = Campaign::with('campaignCategory')->where('status', Campaign::STATUS_ACTIVE);

        $campaignIds = $query->pluck('id')->toArray();
        $finalIds = [];
        foreach ($campaignIds as $campaignId) {
            if (! campaignEnd($campaignId)) {
                $finalIds[] = $campaignId;
            }
        }

        $mainQuery->whereIn('id', $finalIds);
        if (! empty($this->campaignCategoryId)) {
            $mainQuery->when(! empty($this->campaignCategoryId), function (Builder $q) {
                $q->where('campaign_category_id', '=', $this->campaignCategoryId);
            });
        }

        return $mainQuery->paginate(9);
    }
}
