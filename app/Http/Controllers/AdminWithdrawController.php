<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateWithdrawRequest;
use App\Models\Withdraw;
use App\Repositories\WithdrawRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminWithdrawController extends AppBaseController
{
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
        return view('admin.withdraw.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateWithdrawRequest $request, $id)
    {
        $withdrawRequest = Withdraw::with('campaign')->whereId($id)->first();

        if ($request->status && $withdrawRequest->is_approved == 0) {
            if ($withdrawRequest->status == Withdraw::REJECTED) {
                return $this->sendError('Withdrawal request already rejected.');
            }

            if (! isset($request->admin_notes)) {
                return $this->sendError('Please add the notes for reject reason.');
            }

            $input = $request->all();
            $this->withdrawRepository->update($input, $id);

            return $this->sendSuccess('Withdrawal request rejected successfully.');
        }

        if ($withdrawRequest->is_approved == 0) {
            $input = $request->all();
            $input['status'] = Withdraw::APPROVED;
            $this->withdrawRepository->update($input, $id);
            $data = $withdrawRequest;

            return $this->sendResponse($data, 'Withdrawal request approved successfully.');
        }

        return $this->sendError('Withdrawal request already approved.');
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

    /**
     * @param  Withdraw  $withdraw
     * @return mixed
     */
    public function showPaymentDetails(Withdraw $withdraw)
    {
        $paymentDetails = Withdraw::where('id', '=', $withdraw->id)->first();

        return $this->sendResponse($paymentDetails, 'Request details Retrieved Successfully.');
    }
}
