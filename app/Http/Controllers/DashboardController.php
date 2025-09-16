<?php

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends AppBaseController
{
    /* @var DashboardRepository */
    private DashboardRepository $dashboardRepository;

    /**
     * DashboardController constructor.
     *
     * @param  DashboardRepository  $dashboardRepo
     */
    public function __construct(DashboardRepository $dashboardRepo)
    {
        $this->dashboardRepository = $dashboardRepo;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = $this->dashboardRepository->getDashboardData();

        return view('admin.dashboard.index', compact('data'));
    }

    /**
     * @return mixed
     */
    public function donationWithdrawChart()
    {
        $data = $this->dashboardRepository->getDashboardChartData();

        return $this->sendResponse($data, 'Chart data retrieved successfully.');
    }
}
