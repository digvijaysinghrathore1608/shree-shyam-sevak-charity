<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="image image-circle image-mini me-3">
        <img src="{{$row->image}}" alt="user" class="user-img object-fit-cover">
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @php
        $useCampaign = count($row->campaigns);
        $checked = $row->is_active === 0 ? '' : 'checked';
        $disable = $useCampaign > 0 ? 'disabled' : '';
    @endphp

    <div class="form-check form-switch">
        <input class="form-check-input campaign-category-active" type="checkbox" role="switch" name="Is isActive"
               data-id="{{$row->id}}" {{$checked}} {{$row->is_active ? $disable : ''}}>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>

    <div class="d-flex justify-content-start">
        <a href="javascript:void(0)"
           data-bs-toggle="tooltip"
           title="{{__('messages.common.edit') }}"
           class="btn px-2 text-primary fs-3 ps-0 py-2 campaign-category-edit-btn" data-id="{{$row->id}}"
           data-turbolinks="false">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="javascript:void(0)" data-id="{{ $row->id }}"
           data-bs-toggle="tooltip"
           title="{{__('messages.common.delete') }}" data-bs-original-title="{{__('messages.common.delete') }}"
           class="btn px-1 text-danger fs-3 py-2 campaign-category-delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
    
</x-livewire-tables::bs5.table.cell>
