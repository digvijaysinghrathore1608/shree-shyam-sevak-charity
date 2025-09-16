<x-livewire-tables::bs5.table.cell>

    <div class="d-flex align-items-center">
        <a>
            <div class="image image-circle image-mini me-3">
                <img src="{{$row->image_url}}" alt="" class="user-img">
            </div>
        </a>
        <div class="d-inline-block align-top">
            <span class="mb-1 d-block">{{ $row->name }}</span>
        </div>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @php
        $useEvent = count($row->events);
        $checked = $row->is_active === 0 ? '' : 'checked';
        $disable = $useEvent > 0 ? 'disabled' : '';
    @endphp
    <div class="d-flex">
        <label class="form-check form-switch">
            <input type="checkbox" name="Is isActive" class="form-check-input active isActive cursor-pointer"
                   data-id="{{$row->id}}" {{$checked}} {{$disable}}>
            <span class="custom-switch-indicator"></span>
        </label>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="d-flex align-items-start">
        <a href="javascript:void(0)" data-bs-toggle="tooltip"
           title="{{__('messages.common.edit') }}"
           data-id="{{ $row->id }}"
           class="event-category-edit-btn btn px-1 text-primary fs-3 ps-0">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="javascript:void(0)" data-bs-toggle="tooltip"
           title="{{__('messages.common.delete')}}"
           data-id="{{ $row->id }}"
           class="event-category-delete-btn btn px-1 text-danger fs-3 pe-0" wire:key="{{$row->id}}">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>

    
</x-livewire-tables::bs5.table.cell>
