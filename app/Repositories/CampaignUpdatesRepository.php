<?php

namespace App\Repositories;

use App\Models\CampaignUpdate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CampaignUpdatesRepository
 */
class CampaignUpdatesRepository extends BaseRepository
{
    public $fieldSearchable = [
        'title',
        'description',
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return CampaignUpdate::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        $campaignUpdates = CampaignUpdate::create($input);

        return $campaignUpdates;
    }

    /**
     * @param  array  $input
     * @param  int  $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $campaignUpdates = CampaignUpdate::findOrFail($id);

        $campaignUpdates->update($input);

        return $campaignUpdates;
    }
}
