<?php

namespace App\Repositories;

use App\Models\Campaign;
use App\Models\CampaignDonation;
use App\Models\Withdraw;
use App\Models\Withdrawal;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class CampaignRepository
 */
class CampaignRepository extends BaseRepository
{
    public array $fieldSearchable = [
        'title',
        'campaign_category_id',
    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model(): string
    {
        return Campaign::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $userId = Auth::id();
            $campaign = Campaign::create($input);
            Campaign::where('id', $campaign->id)->update(['user_id' => $userId]);
            if (isset($input['image']) && ! empty($input['image'])) {
                $campaign->addMedia($input['image'])->toMediaCollection(Campaign::CAMPAIGN_IMAGE);
            }

            DB::commit();

            return $campaign;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  int  $id
     * @return void
     */
    public function update($input, $id)
    {
        try {
            DB::beginTransaction();
            $campaign = Campaign::find($id);

            $input['gift_status'] = isset($input['gift_status']) ? 1 : 0;

            $campaign->update($input);

            if (isset($input['gifts'])) {
                $campaign->campaignGifts()->sync($input['gifts']);
            }

            if (isset($input['image']) && ! empty($input['image'])) {
                $campaign->clearMediaCollection(Campaign::CAMPAIGN_IMAGE);
                $campaign->addMedia($input['image'])->toMediaCollection(Campaign::CAMPAIGN_IMAGE);
            }
            
            $allWithdrawals = Withdraw::where('campaign_id',$campaign->id)->get() ?->sum('amount');
            $campaignDonation = CampaignDonation::where('campaign_id',$campaign->id)->get() ?->sum('donated_amount');
            $remainingAmount = $campaignDonation - $allWithdrawals;
            if($campaign->status == Campaign::STATUS_FINISHED && $remainingAmount > 0) {
                Withdraw::create([
                    'amount'      => $remainingAmount,
                    'status'      => \App\Models\Withdraw::NEED_TO_WITHDRAW,
                    'is_approved' => \App\Models\Withdraw::NEED_TO_WITHDRAW,
                    'campaign_id' => $campaign->id,
                ]);
            }
            DB::commit();

            return $campaign;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $input
     * @param $id
     * @return mixed
     */
    public function updateField($input, $id)
    {
        try {
            DB::beginTransaction();
            $campaign = Campaign::find($id);
            $input['is_featured'] = isset($input['is_featured']);
            $input['is_emergency'] = isset($input['is_emergency']);
            $campaign->update($input);

            DB::commit();

            return $campaign;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $input
     * @param $id
     * @return mixed
     */
    public function campaignFileStore($input, $id)
    {
        try {
            DB::beginTransaction();
            $campaign = Campaign::find($id);

            if (isset($input['file']) && ! empty($input['file'])) {
                $campaign->addMedia($input['file'])->toMediaCollection(Campaign::CAMPAIGN_DROP_IMAGE);
            }

            DB::commit();

            return $campaign;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
