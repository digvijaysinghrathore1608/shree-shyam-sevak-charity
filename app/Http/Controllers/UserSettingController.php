<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserSettingRequest;
use App\Models\UserSetting;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class UserSettingController extends AppBaseController
{
    public function index()
    {
        $setting = UserSetting::where('user_id', getLogInUserId())->first();

        return view('user.payout_setting.index', compact('setting'));
    }

    public function update(UpdateUserSettingRequest $request)
    {
        $input = $request->all();

        if (! empty($input['account_number']) || ! empty($input['isbn_number']) || ! empty($input['branch_name']) || ! empty($input['account_holder_name'])) {
            if (empty($input['account_number']) || empty($input['isbn_number']) || empty($input['branch_name']) || empty($input['account_holder_name'])) {
                Flash::error('Please fill all the bank details information. ');

                return Redirect::back()->withInput($request->all());
            }
        }

        $userSetting = UserSetting::where('user_id', getLogInUserId())->first();
        if (! empty($userSetting)) {
            $userSetting->update($input);
            Flash::success('Payout setting updated successfully.');

            return Redirect::back();
        }
        $input['user_id'] = getLogInUserId();
        UserSetting::create($input);
        Flash::success('Payout setting created successfully');

        return Redirect::back();
    }
}
