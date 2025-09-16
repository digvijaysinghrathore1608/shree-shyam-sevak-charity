<?php

namespace App\Repositories;

use App\Models\DonationGift;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class NewsRepository
 *
 * @version February 12, 2022, 7:49 am UTC
 */
class DonationGiftRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
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
        return DonationGift::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        $donationGift = DonationGift::create($input);

        if (isset($input['gifts']['createGift'])) {
            foreach ($input['gifts']['createGift'] as $gift) {
                $donationGift->gifts()->create(['name' => $gift]);
            }
        }

        if (isset($input['image']) && ! empty($input['image'])) {
            $donationGift->addMedia($input['image'])->toMediaCollection(DonationGift::PATH, config('app.media_disc'));
        }

        return $donationGift;
    }

    public function update($input, $id)
    {
        try {
            DB::beginTransaction();

            $donationGift = DonationGift::findOrFail($id);
            $donationGift->update($input);
            if (isset($input['gifts']['updateGift'])) {
                foreach ($input['gifts']['updateGift'] as $key => $gift) {
                    $donationGift->gifts()->where('id', $key)->update(['name' => $gift]);
                }
            }

            if (isset($input['gifts']['createGift'])) {
                foreach ($input['gifts']['createGift'] as $gift) {
                    $donationGift->gifts()->create(['name' => $gift]);
                }
            }

            if (isset($input['image']) && ! empty($input['image'])) {
                $donationGift->clearMediaCollection(DonationGift::PATH);
                $donationGift->addMedia($input['image'])->toMediaCollection(DonationGift::PATH,
                    config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
