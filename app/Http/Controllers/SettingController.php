<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class SettingController extends AppBaseController
{
    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * SettingController constructor.
     *
     * @param  SettingRepository  $SettingRepository
     */
    public function __construct(SettingRepository $SettingRepository)
    {
        $this->settingRepository = $SettingRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $setting = Setting::pluck('value', 'key')->toArray();

        $sectionName = ($request->get('section') === null) ? 'generals' : strip_tags($request->get('section'));

        return view("admin.setting.$sectionName",
            compact('sectionName', 'setting'));
    }

    /**
     * @param  UpdateSettingRequest  $request
     * @return RedirectResponse
     */
    public function update(UpdateSettingRequest $request)
    {
        if (($request->get('donation_commission') < 0)) {
            Flash::error('Donation commission field required grater than 0 amount.');

            return Redirect::back();
        }

        if (($request->get('charges_type') == Setting::PERCENTAGE)
            && ($request->get('donation_commission') > 100)) {
            Flash::error('Donation commission percentage required between 0 to 100.');

            return Redirect::back();
        }

        $input = $request->all();

        if (isset($input['donation_commission'])) {
            $input['donation_commission'] = number_format($input['donation_commission'], 2);
        }

        $id = Auth::id();
        $this->settingRepository->update($input, $id);

        Flash::success('Settings updated successfully.');

        return Redirect::back();
    }

    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function settingCredential(Request $request)
    {
        $input = $request->all();

        $input['stripe_enable'] = (isset($input['stripe_enable'])) ? 1 : 0;

        $input['paypal_enable'] = (isset($input['paypal_enable'])) ? 1 : 0;

        $this->settingRepository->updateSettingCredential($input);

        Flash::success('Settings updated successfully.');

        return Redirect::back();
    }

    /**
     * @return Application|Factory|View
     */
    public function editTermCondition()
    {
        $settings = [];
        $settings['terms_conditions'] = Setting::where('key', 'terms_conditions')->first();
        $settings['privacy_policy'] = Setting::where('key', 'privacy_policy')->first();

        return view('admin.front-cms.terms-conditions.index',
            compact('settings'));
    }

    /**
     * @param  Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function updateTermCondition(Request $request)
    {
        $this->settingRepository->updateData($request->all());

        Flash::success('Terms conditions updated successfully.');

        return Redirect(route('terms-conditions.index'));
    }
}
