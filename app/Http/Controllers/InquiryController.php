<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class InquiryController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.inquiries.index');
    }

    /**
     * @param  Inquiry  $inquiry
     * @return JsonResponse
     */
    public function show(Inquiry $inquiry)
    {
        if ($inquiry->status == Inquiry::UNREAD) {
            $inquiry->update(['status' => 1]);
        }

        return $this->sendResponse($inquiry, 'Inquiry Retrieved Successfully.');
    }

    /**
     * Remove the specified Inquiry from storage.
     *
     * @param  Inquiry  $inquiry
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return $this->sendSuccess('Inquiry deleted successfully.');
    }
}
