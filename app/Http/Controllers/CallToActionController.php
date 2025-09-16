<?php

namespace App\Http\Controllers;

use App\Models\CallToAction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CallToActionController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.call_to_actions.index');
    }

    /**
     * @param  CallToAction  $callToAction
     * @return mixed
     */
    public function show(CallToAction $callToAction)
    {
        if ($callToAction->status == CallToAction::UNREAD) {
            $callToAction->update(['status' => 1]);
        }

        return $this->sendResponse($callToAction, 'Call To Action Retrieved Successfully.');
    }

    /**
     * @param  CallToAction  $callToAction
     * @return mixed
     */
    public function destroy(CallToAction $callToAction)
    {
        $callToAction->delete();

        return $this->sendSuccess('Call To Action deleted successfully.');
    }
}
