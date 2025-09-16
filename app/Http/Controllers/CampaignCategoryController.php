<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCampaignCategoryRequest;
use App\Http\Requests\UpdateCampaignCategoryRequest;
use App\Models\Campaign;
use App\Models\CampaignCategory;
use App\Repositories\CampaignCategoryRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CampaignCategoryController extends AppBaseController
{
    /**
     * @var CampaignCategoryRepository
     */
    public $campaignCategoryRepo;

    /**
     * UserController constructor.
     *
     * @param  CampaignCategoryRepository  $campaignCategoryRepository
     */
    public function __construct(CampaignCategoryRepository $campaignCategoryRepository)
    {
        $this->campaignCategoryRepo = $campaignCategoryRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        return view('admin.campaign-category.index');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  CreateCampaignCategoryRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateCampaignCategoryRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->campaignCategoryRepo->store($input);

        return $this->sendSuccess('Campaign Category saved successfully.');
    }

    /**
     * @param  CampaignCategory  $campaignCategory
     * @return mixed
     */
    public function edit(CampaignCategory $campaignCategory)
    {
        $campaignCategory->load('campaigns');

        return $this->sendResponse($campaignCategory, 'Campaign Category retrieved successfully.');
    }

    /**
     * @param  UpdateCampaignCategoryRequest  $request
     * @param  CampaignCategory  $campaignCategory
     * @return mixed
     */
    public function update(UpdateCampaignCategoryRequest $request, CampaignCategory $campaignCategory)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->campaignCategoryRepo->update($input, $campaignCategory->id);

        return $this->sendSuccess('Campaign Category updated successfully.');
    }

    /**
     * @param  CampaignCategory  $campaignCategory
     * @return mixed
     */
    public function destroy(CampaignCategory $campaignCategory)
    {
        $campaign = Campaign::where('campaign_category_id', '=', $campaignCategory->id)->exists();

        if (! $campaign) {
            $campaignCategory->delete();

            return $this->sendSuccess('Campaign Category deleted successfully.');
        }

        return $this->sendError('Campaign Category cannot be deleted.');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function changeCategoryStatus(Request $request): JsonResponse
    {
        $campaignCategory = CampaignCategory::findOrFail($request->get('id'));
        $campaignCategory->is_active = ($campaignCategory->is_active == 0) ? '1' : '0';
        $campaignCategory->save();

        return $this->sendResponse($campaignCategory, 'Status updated successfully.');
    }
}
