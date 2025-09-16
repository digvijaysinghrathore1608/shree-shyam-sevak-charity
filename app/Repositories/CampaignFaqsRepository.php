<?php

namespace App\Repositories;

use App\Models\CampaignFaq;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CampaignFaqsRepository
 */
class CampaignFaqsRepository extends BaseRepository
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
        return CampaignFaq::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        $campaignFaqs = CampaignFaq::create($input);

        return $campaignFaqs;
    }

    /**
     * @param  array  $input
     * @param  int  $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $campaignFaqs = CampaignFaq::findOrFail($id);

        $campaignFaqs->update($input);

        return $campaignFaqs;
    }
}
