<x-livewire-tables::bs5.table.cell>
    <div class="d-flex align-items-center">
        <a>
            <div class="image image-circle image-mini me-3">
                <img src="{{$row->donation_gift_image}}" alt="" class="user-img">
            </div>
        </a>
        <div class="d-flex flex-column">
            <a href="{{route('donation-gifts.show', $row->id)}}" class="mb-1 text-decoration-none fs-6">
                {{ \Illuminate\Support\Str::limit($row->title, 40) }}
            </a>
        </div>
    </div>

</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ getCurrencySymbol($row->currency).number_format($row->amount, 2) }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="badge bg-secondary">
        {{ Carbon\Carbon::parse($row->delivery_date)->isoFormat('Do MMM, YYYY') }}
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @if ($row->status == 1)
        <div class="badge bg-light-success">
            <div>Published</div>
        </div>
    @elseif ($row->status == 2)
        <div class="badge bg-light-danger">
            <div>Draft</div>
        </div>
    @endif
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @foreach($row->gifts as $giftsName)
        <div class="badge bg-light-primary">
            @if($giftsName->name)
                <div>{{$giftsName->name}}</div>
            @else
                N/A
            @endif
        </div>
    @endforeach
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="justify-content-center d-flex">
        <a href="{{ route('donation-gifts.edit',$row->id) }}" data-bs-toggle="tooltip"
           title="{{ __('messages.common.edit') }}" data-turbo="false"
           class="btn px-1 text-primary fs-3 user-edit-btn" data-id="{{$row->id}}">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="javascript:void(0)" data-id="{{ $row->id }}" data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}"
           class="btn px-1 text-danger fs-3 donation-gift-delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>
