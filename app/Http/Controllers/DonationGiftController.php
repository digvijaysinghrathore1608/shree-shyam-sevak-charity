<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDonationGiftRequest;
use App\Http\Requests\UpdateDonationGiftRequest;
use App\Models\DonationGift;
use App\Models\Gift;
use App\Repositories\DonationGiftRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class DonationGiftController extends AppBaseController
{
    /** @var DonationGiftRepository */
    private $donationGiftRepository;

    public function __construct(DonationGiftRepository $donationGiftRepo)
    {
        $this->donationGiftRepository = $donationGiftRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.donation_gifts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.donation_gifts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateDonationGiftRequest $request)
    {
        $input = $request->all();

        $donationGift = $this->donationGiftRepository->store($input);

        Flash::success('Donation gift saved successfully.');

        return redirect(route('donation-gifts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  DonationGift  $donationGift
     * @return Response
     */
    public function show(DonationGift $donationGift)
    {
        return view('admin.donation_gifts.show', compact('donationGift'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  DonationGift  $donationGift
     * @return Response
     */
    public function edit(DonationGift $donationGift)
    {
        $donationGift->load('gifts');

        return view('admin.donation_gifts.edit', compact('donationGift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  DonationGift  $donationGift
     * @return RedirectResponse|Redirector|Application
     */
    public function update(UpdateDonationGiftRequest $request, DonationGift $donationGift): Application|RedirectResponse|Redirector
    {
        $this->donationGiftRepository->update($request->all(), $donationGift->id);

        Flash::success('Donation gift updated successfully.');

        return redirect(route('donation-gifts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DonationGift  $donationGift
     * @return Response
     */
    public function destroy(DonationGift $donationGift)
    {
        $usedGift = DB::table('campaign_gift')->pluck('donation_gift_id')->toArray();
        $isDonationGiftUsed = in_array($donationGift['id'], $usedGift);

        if ($isDonationGiftUsed) {
            return $this->sendError('Donation gift used somewhere else.');
        }

        $donationGift->delete();

        return $this->sendSuccess('Donation gift deleted successfully.');
    }

    /**
     * @param  Gift  $deleteGiftId
     * @return mixed
     */
    public function giftDestroy(Gift $deleteGiftId)
    {
        $deleteGiftId->delete();
//        return $this->sendSuccess('Gift deleted successfully.');
    }
}
