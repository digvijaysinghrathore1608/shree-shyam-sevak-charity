<?php

namespace App\Repositories;

use App\Models\Campaign;
use App\Models\CampaignDonation;
use App\Models\Earnings;
use App\Models\User;
use App\Models\Withdraw;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

/**
 * Class CityRepository
 *
 * @version July 31, 2021, 7:41 am UTC
 */
class DashboardRepository
{
    public function getDashboardData(): array
    {
        $data = [];

        $data['totalUser'] = User::all()->count();
        $data['totalCampaign'] = Campaign::all()->count();
        $data['totalDonations'] = CampaignDonation::all()->sum('donated_amount');
        $data['totalVerifiedUsers'] = User::where('email_verified_at', '!=', null)->count();
        $data['totalDonor'] = CampaignDonation::select('email')->distinct()->count();
        $data['totalWithdraw'] = Withdraw::where('is_approved', Withdraw::APPROVED)->sum('amount');
        $data['totalNoOfDonation'] = CampaignDonation::all()->count();
        $data['totalCommissionAmount'] = Earnings::all()->sum('commission_amount');

        return $data;
    }

    /**
     * @return array
     */
    public function getDashboardChartData(): array
    {
        $donation = CampaignDonation::whereYear('created_at', Carbon::now()->year)->get()
            ->groupBy(function ($q) {
                return Carbon::parse($q->created_at)->format('M');
            });

        $withdraw = Withdraw::whereYear('created_at', Carbon::now()->year)->where('is_approved', Withdraw::APPROVED)->get()
            ->groupBy(function ($q) {
                return Carbon::parse($q->created_at)->format('M');
            });

        $data = [];
        $periods = CarbonPeriod::create(Carbon::now()->startOfYear(), '1 month', Carbon::now()->endOfYear());
        $labels = [];
        $donationDataset = [];
        foreach ($periods as $key => $period) {
            $month = $period->format('M');
            $labels[] = $month;
            if (isset($donation[$month])) {
                $amounts = $donation[$month]->pluck('donated_amount')->toArray();
                $donationDataset[] = array_sum($amounts);
            } else {
                $donationDataset[] = 0;
            }
        }

        $withdrawDataset = [];
        foreach ($periods as $key => $period) {
            $month = $period->format('M');
            if (isset($withdraw[$month])) {
                $amounts = $withdraw[$month]->pluck('amount')->toArray();
                $withdrawDataset[] = array_sum($amounts);
            } else {
                $withdrawDataset[] = 0;
            }
        }

        $data['labels'] = $labels;
        $data['donationData'] = [
            'label' => 'Total Donation',
            'dataset' => $donationDataset,
        ];

        $data['withdrawDataset'] = [
            'label' => 'Total Withdraw',
            'dataset' => $withdrawDataset,
        ];

        return $data;
    }

    public function getUserDashboardData(): array
    {
        $data = [];

        $campaignIdsArray = Campaign::where('user_id', getLogInUserId())->pluck('id');
        $data['totalCampaign'] = $campaignIdsArray->count();
        $data['totalDonations'] = CampaignDonation::whereIn('campaign_id', $campaignIdsArray)->sum('donated_amount');
        $data['totalDonor'] = CampaignDonation::whereIn('campaign_id', $campaignIdsArray)->select('email')->distinct()->count();

        return $data;
    }

    public function getUserDashboardChartData(): array
    {
        $campaignIdsArray = Campaign::where('user_id', getLogInUserId())->pluck('id');

        $donation = CampaignDonation::whereIn('campaign_id', $campaignIdsArray)
            ->whereYear('created_at', Carbon::now()->year)->get()
            ->groupBy(function ($q) {
                return Carbon::parse($q->created_at)->format('M');
            });

        $withdraw = Withdraw::whereIn('campaign_id', $campaignIdsArray)
            ->whereYear('created_at', Carbon::now()->year)->where('is_approved', Withdraw::APPROVED)->get()
            ->groupBy(function ($q) {
                return Carbon::parse($q->created_at)->format('M');
            });

        $data = [];
        $periods = CarbonPeriod::create(Carbon::now()->startOfYear(), '1 month', Carbon::now()->endOfYear());
        $labels = [];
        $donationDataset = [];
        foreach ($periods as $key => $period) {
            $month = $period->format('M');
            $labels[] = $month;
            if (isset($donation[$month])) {
                $amounts = $donation[$month]->pluck('donated_amount')->toArray();
                $donationDataset[] = array_sum($amounts);
            } else {
                $donationDataset[] = 0;
            }
        }

        $withdrawDataset = [];
        foreach ($periods as $key => $period) {
            $month = $period->format('M');
            if (isset($withdraw[$month])) {
                $amounts = $withdraw[$month]->pluck('amount')->toArray();
                $withdrawDataset[] = array_sum($amounts);
            } else {
                $withdrawDataset[] = 0;
            }
        }

        $data['labels'] = $labels;
        $data['donationData'] = [
            'label' => 'Total Donation',
            'dataset' => $donationDataset,
        ];

        $data['withdrawDataset'] = [
            'label' => 'Total Withdraw',
            'dataset' => $withdrawDataset,
        ];

        return $data;
    }
}
