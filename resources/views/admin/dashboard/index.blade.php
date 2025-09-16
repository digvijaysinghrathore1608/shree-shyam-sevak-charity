@extends('admin.layouts.app')
@section('title')
    {{__('messages.dashboard')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')
    <div class="container-fluid">
    <div class="d-flex flex-column">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="row">
                    <div class="col-xxl-4 col-xl-4 col-sm-6 widget">
                        <a href="{{ route('users.index')}}" class="text-decoration-none">
                            <div
                                    class="bg-primary shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                <div
                                        class="bg-cyan-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-users fs-1-xl text-white"></i>
                                </div>
                                <div class="text-end text-white">
                                    <h2 class="fs-1-xxl fw-bolder text-white">{{ formatCurrency($data['totalUser']) }}</h2>
                                    <h3 class="mb-0 fs-4 fw-light">{{ __('messages.dashboards.total_users') }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-sm-6 widget">
                        <a href="{{ route('users.index').'/?verified=true' }}" class="text-decoration-none">
                            <div
                                    class="bg-success shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                <div
                                        class="bg-green-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-users fs-1-xl text-white"></i>
                                </div>
                                <div class="text-end text-white">
                                    <h2 class="fs-1-xxl fw-bolder text-white">{{ formatCurrency($data['totalVerifiedUsers']) }}</h2>
                                    <h3 class="mb-0 fs-4 fw-light">{{ __('messages.dashboards.total_verified_users') }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-sm-6 widget">
                        <a href="{{ route('campaigns.index') }}" class="text-decoration-none">
                            <div
                                    class="bg-warning shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                <div
                                        class="bg-yellow-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-globe fs-1-xl text-white"></i>
                                </div>
                                <div class="text-end text-white">
                                    <h2 class="fs-1-xxl fw-bolder text-white">{{ formatCurrency($data['totalCampaign']) }}</h2>
                                    <h3 class="mb-0 fs-4 fw-light">{{ __('messages.dashboards.total_campaigns') }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-sm-6 widget">
                        <div
                                class="bg-danger shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                            <div
                                    class="bg-red-200 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-money-bill fs-1-xl text-white"></i>
                            </div>
                            <div class="text-end text-white">
                                <h2 class="fs-1-xxl fw-bolder text-white">
                                    $ {{ formatCurrency($data['totalDonations']) }}</h2>
                                <h3 class="mb-0 fs-4 fw-light">{{ __('messages.dashboards.total_donations') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-sm-6 widget">
                        <div
                                class="bg-info shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                            <div
                                    class="bg-blue-200 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-user-alt fs-1-xl text-white"></i>
                            </div>
                            <div class="text-end text-white">
                                <h2 class="fs-1-xxl fw-bolder text-white">{{ formatCurrency($data['totalDonor']) }}</h2>
                                <h3 class="mb-0 fs-4 fw-light">{{ __('messages.dashboards.total_donor') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-sm-6 widget">
                        <div
                                class="bg-secondary shadow-md rounded-10 p-xxl-10 px-7 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                            <div
                                    class="bg-gray-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-money-check-alt fs-1-xl text-dark"></i>
                            </div>
                            <div class="text-end text-dark">
                                <h2 class="fs-1-xxl fw-bolder text-dark">
                                    $ {{ formatCurrency($data['totalWithdraw'])}}</h2>
                                <h3 class="mb-0 fs-4 fw-light">{{ __('messages.dashboards.total_withdraw') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-8 col-12 mb-7 mb-xxl-0">
                <div class="card">
                    <div class="card-title m-5 d-flex justify-content-between align-items-center">
                        <h3>{{ __('messages.dashboards.monthly_donation_withdraw_report') }}</h3>
                        <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary me-5" title="Switch Chart">
                                                <span class="svg-icon svg-icon-1 m-0 text-center"
                                                      id="changeDonationWithdrawChart">
                                                    <i class="fas fa-chart-bar fs-1 fw-boldest chart"></i>
                                                </span>
                        </a>
                    </div>
                    <div id="donationWithdrawChartContainer">
                        <div id="donationWithdrawChart"{{ $styleCss }}="height: 350px" class="card-rounded-bottom">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-12 col-sm-6 widget">
            <div class="bg-dark shadow-md rounded-10 p-xxl-16 px-7 py-10 d-flex align-items-center justify-content-between">
                <div
                        class="bg-gray-700 widget-icon rounded-10 d-flex align-items-center justify-content-center">
                    <i class="fa-solid  fa-money-check-alt fs-1-xl text-white m-6 "></i>
                </div>
                <div class="text-end text-white">
                    <h2 class="fs-1-xxl fw-bolder text-white">{{ formatCurrency($data['totalNoOfDonation']) }}</h2>
                    <h3 class="mb-0 fs-4 fw-light">{{ __('messages.dashboards.number_of_donation')}}</h3>
                </div>
            </div>


            <div class="bg-primary shadow-md rounded-10 p-xxl-17 px-7 py-10 d-flex align-items-center justify-content-between mt-5">
                <div
                        class="bg-cyan-300 widget-icon rounded-10 d-flex align-items-center justify-content-center">
                    <i class="fa-solid  fa-money-check-alt fs-1-xl text-white m-6 "></i>
                </div>
                <div class="text-end text-white">
                    <h2 class="fs-1-xxl fw-bolder text-white">
                        $ {{ formatCurrency($data['totalCommissionAmount']) }}</h2>
                    <h3 class="mb-0 fs-4 fw-light">{{__('messages.dashboards.total_commission_amount')}}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-7">
        <h3>{{ __('messages.dashboards.recent_users_list') }}</h3>
    </div>
    <livewire:recent-user-list-table/>
</div>
</div>
@include('admin.dashboard.templates.templates')
@endsection

