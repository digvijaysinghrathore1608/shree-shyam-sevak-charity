<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWithdrawRequest;
use App\Models\Campaign;
use App\Models\CampaignDonation;
use App\Models\UserSetting;
use App\Models\Withdraw;
use App\Models\Withdrawal;
use App\Repositories\WithdrawRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserWithdrawController extends AppBaseController
{
    private WithdrawRepository $withdrawRepository;

    /**
     * UserWithdrawController constructor.
     *
     * @param  WithdrawRepository  $withdrawRepository
     */
    public function __construct(WithdrawRepository $withdrawRepository)
    {
        $this->withdrawRepository = $withdrawRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $userSetting = UserSetting::where('user_id', getLogInUserId())->first();

        return view('user.withdraw.index', compact('userSetting'));
    }

    /**
     * @param  CreateWithdrawRequest  $request
     * @return JsonResponse
     */
    public function store(CreateWithdrawRequest $request): JsonResponse
    {
        $campaign = Campaign::whereId($request->get('campaign_id'))->where('user_id', getLogInUserId())->firstOrFail();
        if (! empty($campaign)) {
            $amount = getSettlementAmount($campaign);
        }

        if ($request->get('payment_type') == Withdraw::PAYPAL) {
            $withdrawalPaypalCharges = Withdrawal::wherePaymentType('PayPal')->first();
            if (($withdrawalPaypalCharges->discount > $amount) && ($withdrawalPaypalCharges->discount_type == Withdrawal::FIXED)) {
                return $this->sendError('Charges amount is more than Withdrawal amount.');
            }
        }

        if ($request->get('payment_type') == Withdraw::BANK) {
            $withdrawalBankCharges = Withdrawal::wherePaymentType('Bank')->first();
            if (($withdrawalBankCharges->discount > $amount) && ($withdrawalBankCharges->discount_type == Withdrawal::FIXED)) {
                return $this->sendError('Charges amount is more than Withdrawal amount.');
            }
        }

        $withdrawRequest = Withdraw::where('campaign_id', '=', $request->get('campaign_id'))->exists();
        $campaignId = $request->get('campaign_id');
        $amount = CampaignDonation::where('campaign_id', $campaignId)->sum('donated_amount');

        $withdrawRequestPending = Withdraw::where('campaign_id', '=', $request->get('campaign_id'))->where('status',
            Withdraw::PENDING)->exists();

        if ($withdrawRequestPending) {
            return $this->sendError('You have already send request for this campaign.');
        }

        if (! empty($campaign)) {
            $amount = getSettlementAmount($campaign);
        }
        if ($amount == 0) {
            return $this->sendError('More fund amount required.');
        }

        if (! $withdrawRequest || $amount > 0) {
            $input['id'] = $request->get('id');
            $requestAmount = Withdraw::whereId($input['id'])->firstOrFail();
            $input['amount'] = $requestAmount->amount;
            $input['payment_type'] = $request->get('payment_type');
            $input['user_notes'] = $request->get('user_notes');
            $input['campaign_id'] = $campaignId;

            if ($input['payment_type'] == Withdraw::PAYPAL) {
                $withdrawal = Withdrawal::wherePaymentType('PayPal')->first();
                if ($withdrawal->discount_type == Withdrawal::FIXED) {
                    $input['deducate_amount'] = $input['amount'] - $withdrawal->discount;
                    $input['charge_amount'] = $withdrawal->discount;
                    $input['discount_type'] = $withdrawal->discount_type;
                } else {
                    $input['deducate_amount'] = $input['amount'] - ($input['amount'] * $withdrawal->discount) / 100;
                    $input['charge_amount'] = ($input['amount'] * $withdrawal->discount) / 100;
                    $input['discount_type'] = $withdrawal->discount_type;
                }

                $input['email'] = $request->get('email');

                $this->withdrawRepository->store($input);

                return $this->sendSuccess('Withdrawal request sended successfully.');
            }

            if ($input['payment_type'] == Withdraw::BANK) {
                $input['account_number'] = $request->get('account_number');
                $input['isbn_number'] = $request->get('isbn_number');
                $input['branch_name'] = $request->get('branch_name');
                $input['account_holder_name'] = $request->get('account_holder_name');

                $withdrawal = Withdrawal::wherePaymentType('Bank')->first();
                if ($withdrawal->discount_type == Withdrawal::FIXED) {
                    $input['deducate_amount'] = $input['amount'] - $withdrawal->discount;
                    $input['charge_amount'] = $withdrawal->discount;
                    $input['discount_type'] = $withdrawal->discount_type;
                } else {
                    $input['deducate_amount'] = $input['amount'] - ($input['amount'] * $withdrawal->discount) / 100;
                    $input['charge_amount'] = ($input['amount'] * $withdrawal->discount) / 100;
                    $input['discount_type'] = $withdrawal->discount_type;
                }

                $this->withdrawRepository->storeBankDetail($input);

                return $this->sendSuccess('Withdrawal request sended successfully.');
            }
        }

        return $this->sendError('Withdrawal request already sended.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Withdraw  $withdraw
     * @return Response
     */
    public function show(Withdraw $withdraw)
    {
        return $this->sendResponse($withdraw, 'Withdraw data Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param  Request  $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCommission(Request $request)
    {
        $input = $request->all();
        $withdrawAmount = Withdraw::where('campaign_id',$input['campaignId'])->where('id',$input['withdrawId'])->firstOrFail();
        $remainingAmount = $withdrawAmount->amount;

        $withdraw = Withdrawal::findOrFail($input['paymentType']);

        if ($withdraw['discount_type'] == Withdrawal::FIXED) {
            $data['chargeAmount'] = $withdraw['discount'];
        } else {
            $data['chargeAmount'] = ($remainingAmount * $withdraw['discount']) / 100;
        }

        $data['campaignAmount'] = $remainingAmount;
        $data['totalWithdrawalAmount'] = $remainingAmount - $data['chargeAmount'];
        return response()->json(['data' => $data, 'success' => true]);
    }
}
