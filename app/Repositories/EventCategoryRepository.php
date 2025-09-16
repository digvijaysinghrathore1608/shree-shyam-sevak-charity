<?php

namespace App\Repositories;

use App\Models\CampaignCategory;
use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EventCategoryRepository
 */
class EventCategoryRepository extends BaseRepository
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
        return EventCategory::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        $eventCategory = EventCategory::create($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $eventCategory->addMedia($input['image'])->toMediaCollection(EventCategory::PATH, config('app.media_disc'));
        }

        return $eventCategory;
    }

    /**
     * @param $input
     * @param $id
     * @return CampaignCategory|Builder|Builder[]|Collection
     */
    public function update($input, $id)
    {
        $eventCategory = EventCategory::findOrFail($id);

        /** @var EventCategory $eventCategory */
        $eventCategory->update($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $eventCategory->clearMediaCollection(EventCategory::PATH);
            $eventCategory->addMedia($input['image'])->toMediaCollection(EventCategory::PATH,
                config('app.media_disc'));
        }

        return $eventCategory;
    }
}
