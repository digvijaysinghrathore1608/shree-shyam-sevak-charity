<x-livewire-tables::bs5.table.cell>

    <div class="d-flex align-items-center">
        <a>
            <div class="image image-circle image-mini me-3">
                <img src="{{ $row->image }}" alt="user" class="user-img">
            </div>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ \Illuminate\Support\Str::limit($row->title, 30) }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <a data-bs-toggle="tooltip"
       title="{{ __('messages.common.edit') }}"
       href="{{ route('success-stories.edit',$row->id)}}"
       class="btn px-1 text-primary fs-3 ps-0 success-story-edit-btn" data-id="{{$row->id}}"
       data-turbolinks="false">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a data-bs-toggle="tooltip"
       title="{{ __('messages.common.delete') }}"
       href="javascript:void(0)" data-id="{{ $row->id }}"
       class="btn px-1 text-danger fs-3 pe-0 success-story-delete-btn " data-turbolinks="false">
        <i class="fa-solid fa-trash"></i>
    </a>
</x-livewire-tables::bs5.table.cell>
