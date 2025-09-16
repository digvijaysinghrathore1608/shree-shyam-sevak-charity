@extends('user.layouts.app')
@section('title')
    {{__('messages.dashboard')}}
@endsection
@php $styleCss = 'style'; @endphp
@section('content')

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="row">
                        <div class="col-xxl-4 col-xl-4 col-sm-6 widget">
                            <div
                                    class="bg-primary shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                <div
                                        class="bg-cyan-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                    <i class='fas fa-bullhorn fs-1-xl text-white'></i>
                                </div>
                                <div class="text-end text-white">
                                    <h2 class="fs-1-xxl fw-bolder text-white">{{ number_format($data['totalCampaign']) }}</h2>
                                    <h3 class="mb-0 fs-4 fw-light">{{ __('messages.dashboards.total_campaigns') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-sm-6 widget">
                            <div
                                    class="bg-success shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                <div
                                        class="bg-green-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-money-bill fs-1-xl text-white"></i>
                                    
                                </div>  
                                <div class="text-end text-white">
                                    <h2 class="fs-1-xxl fw-bolder text-white">$ {{ number_format($data['totalDonations']) }}</h2>
                                    <h3 class="mb-0 fs-4 fw-light">{{ __('messages.dashboards.total_donations') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-sm-6 widget">
                            <div
                                    class="bg-warning shadow-md rounded-10 p-xxl-10 px-5 py-10 d-flex align-items-center justify-content-between my-sm-3 my-2">
                                <div
                                        class="bg-yellow-300 widget-icon rounded-10 me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-user-alt fs-1-xl text-white"></i>
                                </div>
                                <div class="text-end text-white">
                                    <h2 class="fs-1-xxl fw-bolder text-white">{{ number_format($data['totalDonor']) }}</h2>
                                    <h3 class="mb-0 fs-4 fw-light">{{ __('messages.dashboards.total_donor') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row chart-container">

                <div class="col-xl-12 pt-5">
                    <div class="card">
                        <div class="card-title m-5 d-flex justify-content-between align-items-center">
                            <h3>{{ __('messages.dashboards.monthly_donation_withdraw_report') }}</h3>
                            <a href="javascript:void(0)" class="btn btn-icon btn-outline-primary me-5" title="Switch Chart">
                                                <span class="svg-icon svg-icon-1 m-0 text-center"
                                                      id="userChangeDonationWithdrawChart">
                                                    <i class="fas fa-chart-bar fs-1 fw-boldest chart"></i>
                                                </span>
                            </a>
                        </div>
                        <div id="userDonationWithdrawChartContainer">
                            <div id="userDonationWithdrawChart" {{ $styleCss }}="height: 350px" class="
                            card-rounded-bottom"></div>
                    </div>
                </div>
            </div>

          
            </div>
            

    @include('user.dashboard.templates.templates')
@endsection

