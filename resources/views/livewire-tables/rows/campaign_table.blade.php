<x-livewire-tables::bs5.table.cell>

    <div class="d-flex align-items-center">
        <a href="{{route('campaigns.show',$row->id) }}">
            <div class="image image-circle image-mini me-3">
                <img src="{{$row->image}}" alt="user" class="user-img">
            </div>
        </a>
        <div class="d-flex flex-column">
            <a href="{{ route('campaigns.show',$row->id) }}" class="mb-1 text-decoration-none fs-6">
                {!!  Str::limit($row->title , 50) !!}
            </a>
            <span class="fs-6">{{ $row->campaignCategory->name }}</span>
        </div>
    </div>


</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @php
        $goal = getRaisedAmountPercentage($row->campaignDonations->sum('donated_amount'),$row->goal);
        $style = 'style';    
    @endphp

    <div data-progress="{{$goal}}" style="--progress:{{$goal.'%'}};" class="progress m-auto"></div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="badge bg-light-primary">
        {{  getCurrencySymbol($row->currency).' '.number_format($row->campaignDonations->sum('donated_amount'), 2) }}
    </div>
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
    <span class="badge bg-{{ $campaignStatusColorArr[$row->status] }}">{{ $row->status_name }}<br>
        {{ Carbon\Carbon::parse($row->created_at)->isoFormat('Do MMM, YYYY') }}
    </span>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <a data-turbo="false" title="Donors" class="btn btn-sm btn-primary me-5" href="{{  url('admin/campaigns/'.$row->id.'?option=donors') }}">
        {{ __('messages.campaign.donors') }}
    </a>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>



    <div class="d-flex align-items-center justify-content-center">
        <a data-bs-toggle="tooltip"
           title="{{ __('messages.common.view') }}"
           href="{{ route('campaigns.show', $row->id) }}" class="btn px-1 text-info fs-3"
           data-id="{{ $row->id}}">
            <i class="fa-solid fa-eye"></i>
        </a>
        <a data-bs-toggle="tooltip"
           title="{{ __('messages.common.edit') }}"
           href="{{  route('campaigns.edit', $row->id)}}"
           class="btn px-1 text-primary fs-3 campaign-edit-btn" data-id="{{$row->id}}"
           data-turbolinks="false">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}"
           href="javascript:void(0)" data-id="{{ $row->id }}"
           class="btn px-1 text-danger fs-3 campaign-delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>

</x-livewire-tables::bs5.table.cell>

