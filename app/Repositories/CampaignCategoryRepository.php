<?php

namespace App\Repositories;

use App\Models\CampaignCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CampaignCategoryRepository
 */
class CampaignCategoryRepository extends BaseRepository
{
    public $fieldSearchable = [
        'name',
        'is_active',
    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        $campaignCategory = CampaignCategory::create($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $campaignCategory->addMedia($input['image'])->toMediaCollection(CampaignCategory::CAMPAIGN_CATEGORY_IMAGE, config('app.media_disc'));
        }

        return $campaignCategory;
    }

    /**
     * @param $input
     * @param $id
     * @return CampaignCategory|Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $campaignCategory = CampaignCategory::findOrFail($id);

        /** @var CampaignCategory $campaignCategory */
        $campaignCategory->update($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $campaignCategory->clearMediaCollection(CampaignCategory::CAMPAIGN_CATEGORY_IMAGE);
            $campaignCategory->addMedia($input['image'])->toMediaCollection(CampaignCategory::CAMPAIGN_CATEGORY_IMAGE, config('app.media_disc'));
        }

        return $campaignCategory;
    }
}
