<x-livewire-tables::bs5.table.cell>
    {{ $row->display_name }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <?php
    $permissions = '';
    $colours = [
        'primary',
        'success',
        'info',
        'secondary',
        'danger',
        'warning',
    ];
    ?>

    @foreach($row->permissions as $permission => $per)
        <span class="badge bg-{{ $colours[$permission % 6] }} fs-7 m-1 ">{{ $per->display_name }}</span>
    @endforeach

</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @if($row->is_default === 0)
        <div class="d-flex justify-content-start">
            <a href="{{ route('roles.edit', $row->id) }}" data-bs-toggle="tooltip"
               title="{{ __('messages.common.edit') }}"
               class="btn px-1 text-primary fs-3 role-edit-btn" data-id="{{$row->id}}">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a href="javascript:void(0)" data-id="{{ $row->id }}" data-bs-toggle="tooltip"
               title="{{ __('messages.common.delete') }}"
               class="btn px-1 text-danger fs-3 role-delete-btn">
                <i class="fa-solid fa-trash"></i>
            </a>
        </div>
    @endif
   

</x-livewire-tables::bs5.table.cell>
<?php
//}
//?>
