<div class="row">
     <div class="col-lg-3 col-md-3 col-sm-2 d-flex flex-column">
         {{ Form::label('name', __('messages.common.title').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
         <span class="fs-5 text-gray-800">{{ $campaign->title }}</span>
     </div>
     <div class="col-lg-3 col-md-3 col-sm-2 d-flex flex-column mb-5">
         {{ Form::label('name', __('messages.campaign.campaign_category').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
         <span class="fs-5 text-gray-800">{{ $campaign->campaignCategory->name }}</span>
     </div>
     <div class="col-lg-3 col-md-3 col-sm-2 d-flex flex-column mb-5">
         {{ Form::label('created_at', __('messages.campaign.start_date').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
         <span class="fs-5 text-gray-800"
               title="">{{ \Carbon\Carbon::parse($campaign->start_date)->isoFormat('Do MMM, YYYY')}}
                                            </span>
     </div>
     <div class="col-lg-3 col-md-3 col-sm-2 d-flex flex-column mb-5">
         {{ Form::label('updated_at', __('messages.campaign.deadline').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
         <span class="fs-5 text-gray-800"
               title="">{{ \Carbon\Carbon::parse($campaign->deadline)->isoFormat('Do MMM, YYYY')}}
                                            </span>
     </div>
     <div class="col-lg-3 col-md-3 col-sm-2 d-flex flex-column mb-5">
         {{ Form::label('goal', __('messages.campaign.goal').(':'), ['class' => 'pb-2 fs-5 mt-5 text-gray-600']) }}
         <span class="fs-5 text-gray-800"
               title="">{{  getCurrencySymbol($campaign->currency).' '.number_format($campaign->goal, 2) }}
                                            </span>
     </div>
     <div class="col-lg-12 col-md-12 col-sm-4 d-flex flex-column">
         {{ Form::label('description', __('messages.common.description').(':'), ['class' => 'pb-2 fs-5 text-gray-600']) }}
         <span class="fs-5 text-gray-800">
                                                 {!! nl2br($campaign->description) !!}
                                            </span>
     </div>
 </div>
 
 


