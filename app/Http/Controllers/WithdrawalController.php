<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class WithdrawalController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discountType = Withdrawal::TYPE;

        return view('admin.withdrawal.index', compact('discountType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdrawal $withdrawal)
    {
        return view('admin.withdrawal.edit', compact('withdrawal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Withdrawal  $withdrawal
     * @return RedirectResponse
     */
    public function update(Request $request, Withdrawal $withdrawal)
    {
        if (($request->get('discount') < 0)) {
            Flash::error('Commission field required grater than 0 amount.');

            return Redirect::back();
        }

        if (($request->get('discount_type') == Withdrawal::PERCENTAGE)
            && ($request->get('discount') > 100)) {
            Flash::error('Commission percentage required between 0 to 100.');

            return Redirect::back();
        }

        $input = $request->all();

        $withdrawal->update($input);

        Flash::success('Withdrawal charges updated successfully.');

        return redirect()->route('withdrawals.index');
    }
}
