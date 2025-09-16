<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCampaignFaqsRequest;
use App\Http\Requests\UpdateCampaignFaqsRequest;
use App\Models\CampaignFaq;
use App\Repositories\CampaignFaqsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CampaignFaqController extends AppBaseController
{
    /**
     * @var CampaignFaqsRepository
     */
    public $campaignFaqsRepo;

    /**
     * @param  CampaignFaqsRepository  $campaignFaqsRepository
     */
    public function __construct(CampaignFaqsRepository $campaignFaqsRepository)
    {
        $this->campaignFaqsRepo = $campaignFaqsRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('admin.campaigns.campaign_faqs.index');
    }

    /**
     * @param  CreateCampaignFaqsRequest  $request
     * @return mixed
     */
    public function store(CreateCampaignFaqsRequest $request)
    {
        $input = $request->all();

        $this->campaignFaqsRepo->store($input);

        return $this->sendSuccess('Campaign FAQ saved successfully.');
    }

    /**
     * @param  CampaignFaq  $campaignFaq
     * @return mixed
     */
    public function edit(CampaignFaq $campaignFaq)
    {
        return $this->sendResponse($campaignFaq, 'Campaign FAQs retrieved successfully.');
    }

    /**
     * @param  UpdateCampaignFaqsRequest  $request
     * @param  CampaignFaq  $campaignFaq
     * @return mixed
     */
    public function update(UpdateCampaignFaqsRequest $request, CampaignFaq $campaignFaq)
    {
        $input = $request->all();

        $this->campaignFaqsRepo->update($input, $campaignFaq->id);

        return $this->sendSuccess('Campaign FAQ updated successfully.');
    }

    /**
     * @param  CampaignFaq  $campaignFaq
     * @return mixed
     */
    public function show(CampaignFaq $campaignFaq)
    {
        return $this->sendResponse($campaignFaq, 'Campaign FAQ Retrieved Successfully.');
    }

    /**
     * @param  CampaignFaq  $campaignFaq
     * @return mixed
     */
    public function destroy(CampaignFaq $campaignFaq)
    {
        $campaignFaq->delete();

        return $this->sendSuccess('Campaign FAQs deleted successfully.');
    }
}
