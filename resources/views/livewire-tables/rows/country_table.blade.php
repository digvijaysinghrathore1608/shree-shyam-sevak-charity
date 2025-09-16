<x-livewire-tables::bs5.table.cell>
    {{ $row->country_name }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="text-center">
        <a href="javascript:void(0)" data-bs-toggle="tooltip"
           title="{{ __('messages.common.edit') }}"
           class="btn px-1 text-primary fs-3 country-edit-btn" data-id="{{$row->id}}">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="javascript:void(0)" data-id="{{ $row->id }}" data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}"
           class="btn px-1 text-danger fs-3 country-delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
   
</x-livewire-tables::bs5.table.cell>

