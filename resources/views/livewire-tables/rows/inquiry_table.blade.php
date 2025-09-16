<x-livewire-tables::bs5.table.cell>


        <div class="d-flex align-items-center">
            <div class="d-flex flex-column">
                <a href="javascript:void(0)" class="mb-1 text-decoration-none fs-6  inquiry-show-btn" data-id='{{ $row->id }}'>
                    {{ $row->name }}
                </a>
                <span class="fs-6">{{ $row->email }}</span>
            </div>
        </div>

</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->subject }}
</x-livewire-tables::bs5.table.cell><x-livewire-tables::bs5.table.cell>
    @if ($row->status) 
    <div class="badge bg-light-success">Read</div>
    @else 
     <div class="badge bg-light-danger">Unread</div>
    @endif
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="badge bg-secondary">
        {{ \Carbon\Carbon::parse($row->created_at)->isoFormat('Do MMMM YYYY')}}
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="d-flex justify-content-start">
        <a data-bs-toggle="tooltip"
           title="{{ __('messages.common.view') }}"
           class="inquiry-show-btn btn px-2 text-info fs-3 pe-0 py-2"
           data-id="{{ $row->id }}">
            <i class="fa-solid fa-eye"></i>
        </a>

        <a data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}"
           href="javascript:void(0)" data-id="{{ $row->id }}"
           class="inquiry-delete-btn btn px-2 text-danger fs-3 py-2 " data-turbolinks="false">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>

</x-livewire-tables::bs5.table.cell>
