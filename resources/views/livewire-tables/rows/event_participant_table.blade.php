<x-livewire-tables::bs5.table.cell class="custom-line-height">
    <div class="d-inline-block align-top">
        <a class="text-primary-800 d-block text-decoration-none">{{$row->name}}</a>
        <span class="d-block">{{$row->email}}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->notes ? $row->notes : 'N/A' }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>

    <div class="justify-content-center d-flex">
        <a href="javascript:void(0)" data-id="{{ $row->id }}" data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}"
           class="btn px-1 text-danger fs-3 event-participant-delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
    
</x-livewire-tables::bs5.table.cell>
