<x-livewire-tables::bs5.table.cell>
    {{ $row->payment_type }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="justify-content-start d-flex">
    <a data-bs-toggle="tooltip"
       title="{{ __('messages.common.edit') }}"
       href="{{ route('withdrawals.edit',$row->id)}}"
       class="btn px-1 text-primary fs-3 ps-0 success-story-edit-btn" data-id="{{$row->id}}"
       data-turbolinks="false">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    </div>
</x-livewire-tables::bs5.table.cell>

