<x-livewire-tables::bs5.table.cell>
    {{ $row->comments }}
</x-livewire-tables::bs5.table.cell>


<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>


<x-livewire-tables::bs5.table.cell>
    <div class="badge bg-secondary">
        {{ \Carbon\Carbon::parse($row->created_at)->isoFormat('Do MMMM YYYY')}}
    </div>
</x-livewire-tables::bs5.table.cell>


<x-livewire-tables::bs5.table.cell>
    <div class="d-flex align-items-start">
        <a href="javascript:void(0)" data-bs-toggle="tooltip"
           title="{{__('messages.common.edit') }}"
           data-id="{{ $row->id }}"
           class="news-comment-edit-btn btn px-1 text-primary fs-3 ps-0">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="javascript:void(0)" data-bs-toggle="tooltip"
           title="{{__('messages.common.delete')}}"
           data-id="{{ $row->id }}"
           class="news-comment-delete-btn btn px-1 text-danger fs-3 pe-0" wire:key="{{$row->id}}">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>
