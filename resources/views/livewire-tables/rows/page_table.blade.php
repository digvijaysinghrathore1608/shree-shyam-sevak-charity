<x-livewire-tables::bs5.table.cell>
    {!! nl2br( \Illuminate\Support\Str::limit($row->title) ) !!}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    @if($row->is_active==1)
    <a href="{{ route('landing.page.detail',$row->id)  }}"
       class="text-decoration-none mb-0 ps-2 lh-15"
       target="_blank">{!! nl2br( \Illuminate\Support\Str::limit($row->name) ) !!}</a>
    @else
        {!! nl2br( \Illuminate\Support\Str::limit($row->name) ) !!}
    @endif
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="d-flex">
        @php
            $checked = $row->is_active === 0 ? '' : 'checked';
        @endphp
        <label class="form-check form-switch form-check-custom form-check-solid form-switch-sm">
            <input type="checkbox" name="Is isActive" class="form-check-input page-active cursor-pointer"
                   data-id="{{$row->id}}" {{$checked}}>
            <span class="custom-switch-indicator"></span>
        </label>
    </div>
</x-livewire-tables::bs5.table.cell>


<x-livewire-tables::bs5.table.cell>
    <div class="justify-content-center d-flex">
        <a data-bs-toggle="tooltip"
           title="{{ __('messages.common.view') }}"
           class="btn px-1 text-info fs-3 page-show-btn action-btn"
           data-id="{{ $row->id }}">
            <i class="fa fa-eye"></i>
        </a>
        <a href="{{ route('pages.edit',$row->id) }}" data-bs-toggle="tooltip"
           title="{{ __('messages.common.edit') }}"
           class="btn px-1 text-primary fs-3 user-edit-btn" data-id="{{$row->id}}">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        <a href="javascript:void(0)" data-id="{{ $row->id }}" data-bs-toggle="tooltip"
           title="{{ __('messages.common.delete') }}"
           class="btn px-1 text-danger fs-3 delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
   
</x-livewire-tables::bs5.table.cell>
