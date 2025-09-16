<x-livewire-tables::bs5.table.cell>
    {{ $row->title }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="badge bg-secondary">
        <div>{{ Carbon\Carbon::parse($row->created_at)->isoFormat('Do MMM, YYYY') }}</div>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>

    <div class="justify-content-center d-flex">
        <a data-bs-toggle="tooltip"
           title="{{ __('messages.common.view') }}"
           href="javascript:void(0)" class="btn px-1 text-info fs-3 user-campaign-update-show-btn"
           data-id="{{ $row->id}}">
            <i class="fa-solid fa-eye"></i>
        </a>
        <a data-bs-toggle="tooltip"
           title="{{ __('messages.common.edit') }}" href="javascript:void(0)"
           class="btn px-1 text-primary fs-3 user-campaign-update-edit-btn" data-id="{{$row->id}}"
           data-turbolinks="false">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}"
           href="javascript:void(0)" data-id="{{ $row->id }}"
           class="btn px-1 text-danger fs-3 user-campaign-update-delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>
