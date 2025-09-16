<x-livewire-tables::bs5.table.cell>
    <div class="d-flex align-items-center">
        <div class="d-inline-block align-top">
            <span class="text-primary" href="">{{$row->name}}</span>
        </div>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
   {{$row->zip}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <div class="badge bg-secondary">
        {{ \Carbon\Carbon::parse($row->created_at)->isoFormat('Do MMMM YYYY')}}
    </div>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    @if ($row->status)
        <div class="badge bg-success">Read</div>
    @else
        <div class="badge bg-danger">Unread</div>
    @endif
</x-livewire-tables::bs5.table.cell>


<x-livewire-tables::bs5.table.cell>
    <div class="d-flex align-items-start">
        <a data-bs-toggle="tooltip"
           title="{{__('messages.common.view') }}"
           class="btn px-1 text-primary fs-3 ps-0 call-to-action-show-btn action-btn"
           data-id="{{ $row->id }}">
            <i class="fa fa-eye"></i>
        </a>
        <a href="javascript:void(0)" data-bs-toggle="tooltip"
           title="{{__('messages.common.delete')}}"
           data-id="{{ $row->id }}"
           class="call-to-action-delete-btn btn px-1 text-danger fs-3 pe-0" wire:key="{{$row->id}}">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>
