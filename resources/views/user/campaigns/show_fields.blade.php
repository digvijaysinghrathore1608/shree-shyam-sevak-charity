<div class="d-flex flex-column flex-lg-row">
    <div class="flex-lg-row-fluid mb-lg-0">
        <div class="row">
            <div class="col-12">
                @include('flash::message')
            </div>
        </div>
        <div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="" role="tabpanel">
                    <div class="card mb-5 mb-xl-10">
                        <div>
                            <div class="card-body  border-top p-9">
                                <div class="row mb-7">
                                    <div class="col-lg-3 col-md-3 col-sm-2 d-flex flex-column">
                                        {{ Form::label('name', __('messages.common.title').(':'), ['class' => 'py-3']) }}
                                        <span>{{ $campaign->title }}</span>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-2 d-flex flex-column">
                                        {{ Form::label('name', __('messages.campaign.campaign_category').(':'), ['class' => 'py-3']) }}
                                        <span >{{ $campaign->campaignCategory->name }}</span>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-2 d-flex flex-column">
                                        {{ Form::label('created_at', __('messages.campaign.start_date').(':'), ['class' => 'py-3']) }}
                                        <span>{{ \Carbon\Carbon::parse($campaign->start_date)->isoFormat('Do MMM, YYYY')}}
                                            </span>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-2 d-flex flex-column">
                                        {{ Form::label('updated_at', __('messages.campaign.deadline').(':'), ['class' => 'py-3']) }}
                                        <span>{{ \Carbon\Carbon::parse($campaign->deadline)->isoFormat('Do MMM, YYYY')}}
                                            </span>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-2 d-flex flex-column">
                                        {{ Form::label('goal', __('messages.campaign.goal').(':'), ['class' => 'py-3']) }}
                                        <span>{{  getCurrencySymbol($campaign->currency).' '.number_format($campaign->goal, 2) }}
                                            </span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-2 d-flex flex-column">
                                        {{ Form::label('description', __('messages.common.description').(':'), ['class' => 'py-3']) }}
                                        <span>
                                                 {!! nl2br($campaign->description) !!}
                                            </span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
