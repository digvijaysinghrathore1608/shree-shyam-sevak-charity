<div class="ms-auto fs-6" id="totalDonationAmount">
    {{__('messages.common.total_amount')}}
    <span class="text-gray-600">
        {{ getCurrencySymbol($campaign->currency).number_format($totalAmount, 2) }} 
    </span>
</div>
