<x-livewire-tables::bs5.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->iso_code }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <a class="text-decoration-none" href="{{ route('languages.translation',$row->id) }}">{{ __('messages.language.edit_translation') }} </a>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    <a href="javascript:void(0)" data-id="{{$row['id']}}"
       data-bs-toggle="tooltip"
       title="{{ __('messages.common.edit') }}"
       class="btn px-1 text-primary fs-3 ps-0 edit-language-btn">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{$row['id']}}"
       data-bs-toggle="tooltip"
       title="{{ __('messages.common.delete') }}"
       class="language-delete-btn btn px-1 text-danger fs-3 pe-0">
        <i class="fa-solid fa-trash"></i>
    </a>
</x-livewire-tables::bs5.table.cell>

