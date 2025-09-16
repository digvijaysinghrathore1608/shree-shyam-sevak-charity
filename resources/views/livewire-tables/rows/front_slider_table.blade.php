<x-livewire-tables::bs5.table.cell>

    <div class="d-flex align-items-center">
        <a>
            <div class="image image-circle image-mini me-3">
                <img src="{{ $row->slider_image }}" alt="user" class="user-img">
            </div>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->title_1 }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->title_2 }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <a data-bs-toggle="tooltip"
       title="{{ __('messages.common.edit') }}"
       href="{{ route('sliders.edit', $row->id) }}"
       class="btn px-1 text-primary fs-3 ps-0 first-slider-edit-btn" data-turbolinks="false">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{ $row->id }}"
       data-bs-toggle="tooltip"
       title="{{ __('messages.common.delete') }}"
       class="first-slider-delete-btn btn px-1 text-danger fs-3 pe-0" data-turbolinks="false">
        <i class="fa-solid fa-trash"></i>
    </a>
</x-livewire-tables::bs5.table.cell>
