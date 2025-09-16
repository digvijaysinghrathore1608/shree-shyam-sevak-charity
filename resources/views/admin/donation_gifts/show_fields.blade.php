<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('title', __('messages.common.title').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">{{$donationGift->title}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3n">
                {{ Form::label('amount', __('messages.donation_gifts.amount').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">{{ getCurrencySymbol($donationGift->currency).number_format($donationGift->amount, 2)}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('delivery_date', __('messages.donation_gifts.delivery_date').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">{{ \Carbon\Carbon::parse($donationGift->delivery_date)->isoFormat('Do MMM, YYYY')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('status', __('messages.common.status').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <div>
                    @if($donationGift->status  == 1)
                        <span class="badge bg-light-success">{{__('messages.donation_gifts.published')}}</span>
                    @else
                        <span class="badge bg-light-danger">{{__('messages.donation_gifts.draft')}}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('gifts', __('messages.donation_gifts.gifts').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                @foreach($donationGift->gifts as $giftsName)
                    @if($giftsName->name)
                        <div><span class="badge bg-light-primary mb-2">{{$giftsName->name}}</span></div>
                    @else
                        {{__('messages.common.n/a')}}
                    @endif
                @endforeach
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('image', __('messages.common.image').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <img src="{{ $donationGift->donation_gift_image}}" alt="Price Image"
                     class="show-image-detail" height="50px" width="50px">
            </div>
            <div class="col-sm-12 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('description', __('messages.common.description').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($donationGift->description)) ? $donationGift->description : __('messages.common.n/a')}}</span>
            </div>
        </div>
    </div>
</div>
