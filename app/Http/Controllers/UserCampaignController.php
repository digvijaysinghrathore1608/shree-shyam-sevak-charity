<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCampaignRequest;
use App\Http\Requests\UpdateCampaignFieldRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Models\Campaign;
use App\Models\CampaignCategory;
use App\Models\Country;
use App\Models\Withdraw;
use App\Repositories\CampaignRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UserCampaignController extends AppBaseController
{
    /**
     * @var CampaignRepository
     */
    public CampaignRepository $campaignRepo;

    /**
     * UserController constructor.
     *
     * @param  CampaignRepository  $campaignRepository
     */
    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepo = $campaignRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('user.campaigns.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $campaignCategory = CampaignCategory::whereIsActive(true)->pluck('name', 'id')->toArray();
        $status = Campaign::ADD_STATUS;

        return view('user.campaigns.create', compact('campaignCategory', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCampaignRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateCampaignRequest $request)
    {
        $input = $request->all();
        $input['slug'] = $input['slug'] ?? str_replace('_', ' ', strtolower($input['title']));
        $campaign = $this->campaignRepo->store($input);

        Flash::success('Campaign created successfully.');

        return redirect(route('user.campaigns.edit', $campaign->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Campaign  $campaign
     * @return Application|Factory|View
     */
    public function edit(Campaign $campaign)
    {
        $campaignCategory = CampaignCategory::whereIsActive(true)->pluck('name', 'id')->toArray();
        $country = Country::all()->pluck('country_name', 'id')->toArray();
        $status = Campaign::ADD_STATUS;
        $currencies = $this->getCurrencies();

        return view('user.campaigns.edit', compact('campaign', 'campaignCategory', 'country', 'status', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCampaignRequest  $request
     * @param  Campaign  $campaign
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $input = $request->all();

        $withdrawRequest = Withdraw::where('campaign_id', $campaign->id)
            ->whereNotIn('status', [Withdraw::APPROVED, Withdraw::REJECTED])
            ->where('is_approved', '!=', Withdraw::APPROVED)->first();

        if (! empty($withdrawRequest) && $campaign->status != $input['status']) {
            Flash::error('You can not change the campaign status, because you have send a withdraw request.');

            return redirect(route('user.campaigns.edit', $campaign->id));
        }

        $this->campaignRepo->update($input, $campaign->id);

        Flash::success('Campaign updated successfully.');

        return redirect(route('user.campaigns.edit', $campaign->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Campaign  $campaign
     * @return void
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return $this->sendSuccess('Campaign deleted successfully.');
    }

    /**
     * @param  Campaign  $campaign
     * @return Application|Factory|View
     */
    public function show(Campaign $campaign, Request $request)
    {
        $option = $request->get('option');
        if (empty($option)) {
            $option = 'default';
        } else {
            $option = 'donors';
        }

        return view('user.campaigns.show', compact('campaign', 'option'));
    }

    /**
     * @param  UpdateCampaignFieldRequest  $request
     * @param $id
     * @return mixed
     */
    public function updateField(UpdateCampaignFieldRequest $request, $id)
    {
        $input = $request->all();
        $this->campaignRepo->updateField($input, $id);

        return $this->sendSuccess('Campaign updated successfully.');
    }

    /**
     * @param  Request  $request
     * @param $id
     * @return mixed
     */
    public function campaignFileStore(Request $request, $id)
    {
        $input = $request->all();
        $this->campaignRepo->campaignFileStore($input, $id);

        return $this->sendSuccess('File uploaded successfully.');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCampaignFile($id)
    {
        $asset = Campaign::find($id);
        $mediaUrl = [];

        $medias = $asset->getMedia(Campaign::CAMPAIGN_DROP_IMAGE);

        foreach ($medias as $attachment) {
            $obj['id'] = $attachment->id;
            $obj['name'] = $attachment->file_name;
            $obj['size'] = $attachment->size;
            $obj['url'] = $attachment->getFullUrl();
            $mediaUrl[] = $obj;
        }

        return $this->sendResponse($mediaUrl, 'File retrieved successfully');
    }

    public function removeCampaignFile(Request $request)
    {
        try {
            DB::beginTransaction();
            $media = Media::where('file_name', $request->file)->first();

            if ($media) {
                $media->delete();
            }
            $asset = Campaign::find($request->id);
            $medias = $asset->getMedia(Campaign::CAMPAIGN_DROP_IMAGE);

            DB::commit();

            return $this->sendResponse($medias, 'File deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return array
     */
    public function getCurrencies(): array
    {
        $currencyPath = file_get_contents(resource_path().'/currencies/defaultCurrency.json');
        $currenciesData = json_decode($currencyPath, true);
        $currencies = [];

        foreach ($currenciesData['currencies'] as $currency) {
            $convertCode = strtolower($currency['code']);
            $currencies[$convertCode] = [
                'symbol' => $currency['symbol'],
                'name' => $currency['name'],
            ];
        }

        return $currencies;
    }
}
