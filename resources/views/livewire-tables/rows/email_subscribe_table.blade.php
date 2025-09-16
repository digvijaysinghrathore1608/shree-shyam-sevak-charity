<x-livewire-tables::bs5.table.cell>
    {{ $row->email }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>

    <div class="text-center">
        <a data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}" href="javascript:void(0)" data-id="{{ $row->id }}"
           class="btn px-2 text-danger fs-3 py-2 email-subscribe-delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>
