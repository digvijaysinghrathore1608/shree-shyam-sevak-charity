<x-livewire-tables::bs5.table.cell>

    <div class="d-flex align-items-center">
        <a>
            <div class="image image-circle image-mini me-3">
                <img src="{{$row->slider_image}}" alt="" class="user-img">
            </div>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->title_1 }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    {{ $row->title_2 }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="text-center">
        <a href="{{ route('second-slider.edit', $row->id) }}" data-bs-toggle="tooltip"
           title="{{ __('messages.common.edit') }}"
           class="btn px-1 text-primary fs-3 second-slider-edit-btn" data-id="{{$row->id}}">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="javascript:void(0)" data-id="{{ $row->id }}" data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}"
           class="btn px-1 text-danger fs-3 second-slider-delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
   
</x-livewire-tables::bs5.table.cell>
