<div class="row">
    <!-- Title Field -->
    <div class="col-lg-6 mb-5">
        {{--        <input type="hidden" name="added_by" value="{{ \Illuminate\Support\Facades\Auth::id() }}">--}}
        {{ Form::label('title',__('messages.common.title').':', ['class' => 'form-label']) }}<span
                class="text-danger">*</span>
        {{ Form::text('title',  isset($donationGift) ? $donationGift->title : null, ['class' => 'form-control', 'placeholder' =>  __('messages.common.title'), 'required', 'id'=>'donationGiftCreateTitle', 'maxLength'=>200]) }}
    </div>
    <div class="col-sm-6 mb-5">
        {{ Form::label('amount', __('messages.donation_gifts.donation_amount').':', ['class' => 'form-label  text-gray-700 required']) }}
        <div class="input-group ">
            {{ Form::number('amount', isset($donationGift) ? $donationGift->amount : null, ['class' => 'form-control required', 'placeholder' => __('messages.donation_gifts.donation_amount'), 'aria-describedby' => 'basic-addon2', 'min' => '0' , 'id' => 'commission', 'required','step' => '.01']) }}
        </div>
    </div>
    @if(!empty($donationGift))
        @foreach($donationGift->gifts as $gift)
            <div class="col-sm-12 me-4 px-5">
                <div class="gift-field-wrap row">
                    <div class="col-11 form-group mr-5">
                        <label for="name" class="required mb-1">{{__('messages.donation_gifts.gift').':'}} </label>
                        <input type="text" class="form-control" name="gifts[updateGift][{{ $gift->id }}]" placeholder="{{__('messages.donation_gifts.gift')}}"
                               value="{{$gift->name ?? null}}" required>
                    </div>
                    <div class="d-flex action-wrap align-items-center col-1 mt-5">
                        <a href="javascript:void(0)" class="add-gift me-1">
                            <i class="fa fa-plus-circle fs-1 text-primary"></i>
                        </a>
                        @if(!$loop->first)
                            <a href="javascript:void(0)" data-id="{{ $gift->id }}" data-bs-toggle="tooltip"
                               title="{{ __('messages.common.delete') }}"
                               class="btn px-1 text-danger fs-3 gift-delete-btn ">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-sm-12 me-4 px-5">
            <div class="gift-field-wrap row">
                <div class="col-11 form-group mr-5">
                    <label for="gift" class="required mb-1">{{__('messages.donation_gifts.gift').':'}} </label>
                    <input type="text" class="form-control" name="gifts[createGift][]" placeholder="{{__('messages.donation_gifts.gift')}}" required>
                </div>
                <div class="d-flex action-wrap align-items-center col-1 mt-5">
                    <a href="javascript:void(0)" class="add-gift me-2">
                        <i class="fa fa-plus-circle fs-1 text-primary"></i>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <div class="col-sm-12 donationWrap me-4 px-5">
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('status', __('messages.common.status').':', ['class' => 'form-label']) }}
        <span class="text-danger">*</span>
        {{ Form::select('status',\App\Models\DonationGift::STATUS,isset($donationGift) ? $donationGift->status : null, ['class' => 'form-select','data-control'=>'select2', 'required']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('delivery_date', __('messages.donation_gifts.delivery_date').':', ['class' => 'form-label required']) }}
        {{ Form::text('delivery_date', isset($donationGift) ? $donationGift->delivery_date : '',['class' => 'form-control bg-white', 'placeholder' => __('messages.donation_gifts.delivery_date'), 'id' => 'donationGiftDeliverytDate', 'required']) }}
    </div>
    <div class="col-lg-6 mb-5">
        {{ Form::label('description', __('messages.common.description').':', ['class' => 'form-label']) }}
        {{ Form::textarea('description', isset($donationGift) ? $donationGift->description : null, ['class' => 'form-control ', 'placeholder' => __('messages.common.description'), 'rows' => '5', 'maxLength'=>500]) }}
    </div>
    <!-- Image Field -->
    <div class="col-lg-6 mb-5">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label required">{{__('messages.common.image')}}:</label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage image-object-fit" id="exampleInputImage"
                         style="background-image: url('{{ !empty($donationGift->donation_gift_image) ? $donationGift->donation_gift_image : asset('front_landing/images/news-details-img.png') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="Change Image">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" name="image" id="Image" class="image-upload d-none" accept="image/*"/> 
                            <input type="hidden" name="avatar_remove">
                        </label> 
                    </span>
                </div>
            </div>
            <div class="form-text">{{__('messages.common.allowed_file_types')}}</div>
        </div>
    </div>
    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2', "id" => "donationGiftSaveBtn"]) }}
        <a href="{{ route('donation-gifts.index') }}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>


