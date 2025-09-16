<x-livewire-tables::bs5.table.cell>
    <div class="text-nowrap d-flex align-items-center">
        <div class="d-inline-block align-top custom-space">
            <a href="{{route('users.show', $row->id)}}"
               class="text-primary-800 text-decoration-none">{{$row->full_name}}</a>
        </div>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->email }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ !empty($row->contact) ? $row->contact : 'N/A' }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ \Carbon\Carbon::parse($row->created_at)->format('d-M-Y H:i A') }}
</x-livewire-tables::bs5.table.cell>
