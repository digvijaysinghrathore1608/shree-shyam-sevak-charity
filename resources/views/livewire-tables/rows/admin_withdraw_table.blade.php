<x-livewire-tables::bs5.table.cell>

    <div class="d-flex align-items-center">
        <a href="{{route('campaigns.show',$row->campaign->id) }}">
            <div class="image image-circle image-mini me-3">
                <img src="{{ $row->campaign->image}}" alt="user" class="user-img">
            </div>
        </a>
        <div class="d-flex flex-column">
            <a href="{{ route('campaigns.show',$row->campaign->id) }}" class="mb-1 text-decoration-none fs-6">
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

<x-livewire-tables::bs5.table.cell>
    {{ !empty($row->deducate_amount)? getCurrencySymbol($row->campaign->currency).number_format($row->deducate_amount, 2):__('messages.common.n/a') }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
        {{ !empty($row->charge_amount) ? getCurrencySymbol($row->campaign->currency).number_format($row->charge_amount, 2):__('messages.common.n/a') }}
</x-livewire-tables::bs5.table.cell>

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
    @if($row->payment_type == \App\Models\Withdraw::PAYPAL)
        <span class="badge bg-warning">{{__('messages.payout_setting.paypal')}}</span>
    @elseif($row->payment_type == \App\Models\Withdraw::BANK)
        <span class="badge bg-danger">{{__('messages.campaign.bank')}}</span>
    @endif
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @php
        $disabledRejectBtn = isDisabledRejectBtn($row) ? 'disabled' : '';
    @endphp
    

    <div class="justify-content-center text-center">
	    @if(array_key_exists($row->status,\App\Models\Withdraw::STATUS))
        <a href="javascript:void(0)" data-bs-toggle="tooltip"
           title="{{ __('messages.common.view') }}"
           data-id="{{ $row->id }}"
           class="withdraw-request-show-btn btn px-1 text-primary fs-3 ps-0">
            <i class="fa-solid fa-eye"></i>
        </a>
       @endif

        @if($row->status == \App\Models\Withdraw::PENDING)
            <a class="btn btn-primary btn-sm admin-withdraw-request-btn" title="approve withdraw request"
               href="javascript:void(0)" role="button" data-id="{{$row->id}}"
               data-turbolinks="false">{{__('messages.campaign.approve')}}</a>
        @elseif($row->status == \App\Models\Withdraw::APPROVED)
            <a class="btn btn-success btn-sm disabled" href="javascript:void(0)"
               role="button">{{__('messages.campaign.approved')}}</a>
        @elseif($row->status == \App\Models\Withdraw::REJECTED)
            <a class=" btn-danger btn btn-sm admin-withdraw-request-btn {{ $disabledRejectBtn }}" title="approve withdraw request"
               href="javascript:void(0)" role="button" data-id="{{$row->id}}"
               data-turbolinks="false">{{__('messages.campaign.rejected')}}</a>
        @else
            <a class="btn btn-secondary btn-sm disabled" href="javascript:void(0)"
               role="button">{{__('messages.campaign.running')}}</a>
        @endif
    </div>
</x-livewire-tables::bs5.table.cell>
