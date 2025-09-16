<div class="ms-auto fw-bolder fs-6" id="totalDonationAmount">
    Total Amount :
    <span class="text-gray-600">
        {{ getCurrencySymbol($campaign->currency).number_format($totalAmount, 2) }} 
    </span>
</div>
