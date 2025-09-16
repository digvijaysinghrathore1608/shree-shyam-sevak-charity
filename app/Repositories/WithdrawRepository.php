<?php

namespace App\Repositories;

use App\Models\BankAccountDetail;
use App\Models\Withdraw;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class TeamRepository
 *
 * @version February 25, 2022, 6:09 am UTC
 */
class WithdrawRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'amount',
        'admin_notes',
        'user_notes',
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
        return Withdraw::class;
    }

    public function store($input)
    {
        try {
            DB::beginTransaction();
            if ($input['id']){
                $withdraw = Withdraw::findOrFail($input['id']);
                $input['status'] = Withdraw::PENDING;
                $input['is_approved'] = 0;
                $withdrawRequest = $withdraw->update($input);
            } else {
                $withdrawRequest = Withdraw::create($input);
            }
            DB::commit();

            return $withdrawRequest;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function storeBankDetail($input)
    {
        try {
            DB::beginTransaction();
            if ($input['id']){
                $withdraw = Withdraw::findOrFail($input['id']);
                $input['status'] = Withdraw::PENDING;
                $input['is_approved'] = 0;
                $withdraw->update($input);
            } else {
                Withdraw::create($input);
            }

            $bankDetails = BankAccountDetail::create([
                'withdrawal_request_id' => $withdraw->id,
                'account_number' => $input['account_number'],
                'isbn_number' => $input['isbn_number'],
                'branch_name' => $input['branch_name'],
                'account_holder_name' => $input['account_holder_name'],

            ]);

            DB::commit();

            return $bankDetails;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input, $id)
    {
        try {
            $withdrawRequest = Withdraw::findOrFail($id);

            $withdrawRequest->update($input);
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
