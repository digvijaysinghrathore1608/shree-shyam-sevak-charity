<x-livewire-tables::bs5.table.cell>
	{{ getCurrencySymbol($row->campaign->currency).' '.number_format($row->amount, 2) }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
	{{ !empty($row->deducate_amount)? getCurrencySymbol($row->campaign->currency).' '.number_format($row->deducate_amount, 2):__('messages.common.n/a') }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
	{{ !empty($row->charge_amount) ? getCurrencySymbol($row->campaign->currency).' '.number_format($row->charge_amount, 2):__('messages.common.n/a') }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
	@php
		$campaignStatusColorArr =  [
			'1' => 'success',
			'2' => 'danger',
			'3' => 'warning',
			'4' => 'secondary',
		];
	@endphp
	<span class="badge bg-{{ $campaignStatusColorArr[$row->status] }}">{{ \App\Models\Withdraw::STATUS[$row->status] }}</span>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
	@if($row->payment_type == \App\Models\Withdraw::PAYPAL)
		<span class="badge bg-warning">{{__('messages.payout_setting.paypal')}}</span>
	@elseif($row->payment_type == \App\Models\Withdraw::BANK)
		<span class="badge bg-danger">{{__('messages.campaign.bank')}}</span>
	@endif
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
	{{ \Carbon\Carbon::parse($row->updated_at)->isoFormat('Do MMM, YYYY') }}
</x-livewire-tables::bs5.table.cell>
