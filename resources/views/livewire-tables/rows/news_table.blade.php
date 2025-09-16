<x-livewire-tables::bs5.table.cell>
    <div class="d-flex align-items-center overflow-hidden">
        <a>
            <div class="image image-circle image-mini me-3">
                <img src="{{$row->news_image}}" alt="" class="user-img">
            </div>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->title  }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    {{  ($row->newsCategory) ? $row->newsCategory->name : 'N/A'}}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="justify-content-center d-flex">
        <a data-bs-toggle="tooltip"
           title="{{ __('messages.common.view') }}"
           href="{{ route('news.show',$row->id) }}" class="btn px-1 text-info fs-3"><i class="fas fa-eye"></i></a>
        <a href="{{ route('news.edit',$row->id) }}" data-bs-toggle="tooltip"
           title="{{ __('messages.common.edit') }}"
           class="btn px-1 text-primary fs-3 " data-id="{{$row->id}}">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="javascript:void(0)" data-id="{{ $row->id }}" data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}"
           class="btn px-1 text-danger fs-3 news-delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
</x-livewire-tables::bs5.table.cell>
