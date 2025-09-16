<x-livewire-tables::bs5.table.cell>
    <div class="d-flex align-items-center">
        <a>
            <div class="image image-circle image-mini me-3">
                <img src="{{$row->image_url}}" alt="" class="user-img">
            </div>
        </a>
        <div class="d-flex flex-column">
            <a href="{{route('events.show', $row->id)}}" class="mb-1 text-decoration-none fs-6">
                {{ \Illuminate\Support\Str::limit($row->title, 40) }}
            </a>
        </div>
    </div>
   
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    {{$row->eventCategory ? $row->eventCategory->name : 'N/A'}}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @if ($row->status == 1)
        <div class="badge bg-light-success">
            <div>Published</div>
        </div>
    @elseif ($row->status == 2)
        <div class="badge bg-light-danger">
            <div>Draft</div>
        </div>
    @endif
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    <div class="badge bg-light-primary align-content-center">
        <a href="{{route('events.participate.destroy', $row->id)}}"
           class="text-primary-800 mb-1 d-block text-decoration-none">{{$row->eventParticipants->count().' '.__('messages.event.out_of').' '.$row->available_tickets }}
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @if ($row->event_date === null) {
    return 'N/A'
    }
    @endif
    <div class="badge bg-secondary me-2">
        <div>{{ \Carbon\Carbon::parse($row->event_date)->isoFormat('Do MMM, YYYY')}}</div>
        <div>{{ \Carbon\Carbon::parse($row->start_time)->isoFormat('h:mm a')}}</div>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="justify-content-center d-flex">
        <a data-bs-toggle="tooltip"
           title="{{ __('messages.common.view') }}"
           href="{{route('events.participate.destroy', $row->id)}}" class="btn px-1 text-green-500 fs-3"><i
                    class="fas fa-registered"></i>
        </a>
        <a href="{{ route('events.edit',$row->id) }}" data-bs-toggle="tooltip"
           title="{{ __('messages.common.edit') }}"
           class="btn px-1 text-primary fs-3 user-edit-btn" data-id="{{$row->id}}">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="javascript:void(0)" data-id="{{ $row->id }}" data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}"
           class="btn px-1 text-danger fs-3 event-delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>

   
</x-livewire-tables::bs5.table.cell>
