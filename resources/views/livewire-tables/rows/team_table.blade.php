<x-livewire-tables::bs5.table.cell>
    <div class="d-flex align-items-center">
        <a>
            <div class="image image-circle image-mini me-3">
                <img src="{{$row->image_url}}" alt="" class="user-img">
            </div>
        </a>
        <div class="d-flex flex-column">
            <span class="mb-1 d-block">{{ \Illuminate\Support\Str::limit($row->name, 30) }}</span>
        </div>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    {{ $row->designation }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="badge bg-secondary">
        {{ \Carbon\Carbon::parse($row->created_at)->isoFormat('Do MMM, YYYY')}}
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="d-flex align-items-start">
        <a href="javascript:void(0)" data-bs-toggle="tooltip"
           title="{{ __('messages.common.edit') }}"
           data-id="{{ $row->id }}"
           class="team-edit-btn btn px-1 text-primary fs-3 ps-0">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="javascript:void(0)" data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}"
           data-id="{{ $row->id }}"
           class="team-delete-btn btn px-1 text-danger fs-3 pe-0" wire:key="{{$row->id}}">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>

