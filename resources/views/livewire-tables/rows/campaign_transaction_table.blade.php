<x-livewire-tables::bs5.table.cell>
    <div class="d-inline-block align-top custom-space">
        <a class="mb-1 text-decoration-none fs-6" data-id="{{ $row->id }}">{{ $row->full_name }}</a>
        <span class="d-block">{{ $row->email ? $row->email : 'N/A' }}</span>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{  getCurrencySymbol($row->campaign->currency).' '.number_format($row->donated_amount, 2) }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{  getCurrencySymbol($row->campaign->currency).' '.number_format($row->charge_amount, 2) }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    <div class="badge bg-light-success">
        <div>{{$row->CampaignDonationTransaction->payment_type}}</div>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell class="text-center">
    <div class="badge bg-secondary">
        <div>{{ \Carbon\Carbon::parse($row->created_at)->format('d-M-Y H:i A') }}</div>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <a data-bs-toggle="tooltip"
       title="{{ __('messages.common.view') }}"
       href="javascript:void(0)" class="btn px-2 text-info fs-3 pe-0 py-2 transaction-show-btn" data-id="{{ $row->id}}">
        <i class="fa-solid fa-eye"></i>
    </a>
</x-livewire-tables::bs5.table.cell>
