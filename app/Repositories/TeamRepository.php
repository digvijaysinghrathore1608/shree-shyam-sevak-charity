<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamRepository
 *
 * @version February 25, 2022, 6:09 am UTC
 */
class TeamRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'designation',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Team::class;
    }

    public function store($input)
    {
        $team = Team::create($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $team->addMedia($input['image'])->toMediaCollection(Team::PATH, config('app.media_disc'));
        }

        return $team;
    }

    /**
     * @param  array  $input
     * @param  int  $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $team = Team::findOrFail($id);

        /** @var Brand $brand */
        $team->update($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $team->clearMediaCollection(Team::PATH);
            $team->addMedia($input['image'])->toMediaCollection(Team::PATH,
                config('app.media_disc'));
        }

        return $team;
    }
}
