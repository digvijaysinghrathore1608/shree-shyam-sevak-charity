<x-livewire-tables::bs5.table.cell>

	<div class="d-flex align-items-center">
		<a href="{{route('user.campaigns.show',$row->campaign->id) }}">
			<div class="image image-circle image-mini me-3">
				<img src="{{ $row->campaign->image}}" alt="user" class="user-img">
			</div>
		</a>
		<div class="d-flex flex-column">
			<a href="{{ route('user.campaigns.show',$row->campaign->id) }}" class="mb-1 text-decoration-none fs-6">
				{!!  Str::limit($row->campaign->title , 40) !!}
			</a>
			<span class="fs-6">{{ $row->campaign->campaignCategory->name }}</span>
		</div>
	</div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
	{{ getCurrencySymbol($row->campaign->currency).number_format($row->campaign->goal, 2) }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
	{{ getCurrencySymbol($row->campaign->currency).number_format($row->amount, 2) }}
</x-livewire-tables::bs5.table.cell>

{{--<x-livewire-tables::bs5.table.cell>--}}
{{--        {{ !empty($row->withdrawalRequest[0]->deducate_amount)? getCurrencySymbol($row->currency).number_format($row->withdrawalRequest[0]->deducate_amount, 2):__('messages.common.n/a') }}--}}
{{--</x-livewire-tables::bs5.table.cell>--}}

<x-livewire-tables::bs5.table.cell>
	{{ !empty($row->charge_amount) ? getCurrencySymbol($row->campaign->currency).number_format($row->charge_amount, 2):__('messages.common.n/a') }}

    {{--    @if(!empty($row->withdrawalRequest[0]) && ($row->withdrawalRequest[0]->discount_type == 1) )--}}
    {{--        {{ !empty($row->withdrawalRequest[0]->charge_amount) ? getCurrencySymbol($row->currency).number_format($row->withdrawalRequest[0]->charge_amount, 2):__('messages.common.n/a') }}--}}
    {{--    @else--}}
    {{--        {{ !empty($row->withdrawalRequest[0]->charge_amount) ? $row->withdrawalRequest[0]->charge_amount.'%':__('messages.common.n/a') }}--}}
    {{--    @endif--}}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
	{{ !empty($row->deducate_amount)? getCurrencySymbol($row->campaign->currency).number_format($row->deducate_amount, 2):__('messages.common.n/a') }}
</x-livewire-tables::bs5.table.cell>

{{--<x-livewire-tables::bs5.table.cell class="text-center">--}}
{{--    {{ getCurrencySymbol($row->currency).number_format(getSettlementAmount($row), 2) }}--}}
{{--</x-livewire-tables::bs5.table.cell>--}}

<x-livewire-tables::bs5.table.cell>
	@php
		$campaignStatusColorArr =  [
			'1' => 'success',
			'2' => 'danger',
			'3' => 'warning',
			'4' => 'secondary',
		];
	@endphp
	<span class="badge bg-{{ $campaignStatusColorArr[$row->campaign->status] }}">{{ $row->campaign->status_name }}</span>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @php
        $disabled = 'disabled';
        $status = $row->status;
        if($row->amount > 0 && getSettlementAmount($row->campaign) > 0){
            $disabled = $status != \App\Models\Withdraw::APPROVED ? 'disabled' : '';
            $disabled = isUserDisabledApproveBtn($row) ? 'disabled' : '';
        }
        
    if($row->status == \App\Models\Withdraw::NEED_TO_WITHDRAW){
		$disabled = '';
    }
    @endphp
	
	@if($status == \App\Models\Withdraw::APPROVED)
		<a class="btn btn-success btn-sm disabled d-block mx-auto width-content" href="javascript:void(0)"
		   role="button">{{__('messages.campaign.approved')}}</a>
	@elseif(isset($status) && getSettlementAmount($row->campaign) == 0)
        @if($status == \App\Models\Withdraw::REJECTED)
            <div class="d-flex">
                <a data-bs-toggle="tooltip"
                   title="{{ __('messages.common.view') }}"
                   class="btn btn-danger btn-sm disabled"
                   href="javascript:void(0)" data-id="{{ $row->campaign->id }}">{{__('messages.campaign.rejected')}}</a>

                <a data-bs-toggle="tooltip"
                   title="{{ __('messages.common.view') }}"
                   class="btn btn-icon withdraw-show-btn btn-bg-light btn-active-color-primary btn-sm ms-3 action-btn"
                   data-id="{{ $row->id }}">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
        @endif
        @if($status == \App\Models\Withdraw::APPROVED)
            <a class="btn btn-success btn-sm disabled d-block mx-auto width-content" href="javascript:void(0)"
               role="button">{{__('messages.campaign.approved')}}</a>
        @endif
        @if($status == \App\Models\Withdraw::PENDING)
            <a class="btn btn-warning btn-sm disabled d-block mx-auto width-content" href="javascript:void(0)"
               role="button">{{__('messages.campaign.pending')}}</a>
        @endif
	@elseif($row->campaign->status == \App\Models\Campaign::STATUS_FINISHED)
        @if($row->campaign->status == \App\Models\Campaign::STATUS_FINISHED && !checkRequestIsPending($row->campaign))
                    <a class="btn btn-primary btn-sm user-withdraw-request-btn d-block mx-auto width-content {{$disabled}}"
                       title="send withdraw request" data-id="{{ $row->id }}"
                       href="javascript:void(0)" role="button" data-campaign-id="{{$row->campaign->id}}"
                       data-turbolinks="false">{{__('messages.campaign.withdraw')}}</a>
            @if($status == \App\Models\Withdraw::REJECTED)
                <a class="btn btn-danger btn-sm mt-2 d-block mx-auto width-content disabled"
                   title="send withdraw request"
                   href="javascript:void(0)" role="button" data-id="{{$row->campaign->id}}"
                   data-turbolinks="false">{{ __('messages.campaign.rejected') }}</a>
            @endif
        @else
            <a class="btn btn-warning btn-sm disabled d-block mx-auto width-content" href="javascript:void(0)"
               role="button">{{__('messages.campaign.pending')}}</a>
        @endif
    @else
        <a class="btn btn-secondary btn-sm disabled d-block mx-auto width-content" href="javascript:void(0)"
           role="button">{{__('messages.campaign.running')}}</a>
    @endif
</x-livewire-tables::bs5.table.cell>
