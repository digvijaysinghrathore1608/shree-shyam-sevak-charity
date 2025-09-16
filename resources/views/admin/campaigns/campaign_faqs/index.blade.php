<ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="myTab" role="tablist">
    <li class="nav-item position-relative me-7 mb-3" role="presentation">
        <button class="nav-link {{ $option == 'default' ? 'active' : ''}} p-0" id="campaign-tab" data-bs-toggle="tab" data-bs-target="#campaignFaqs"
                type="button" role="tab" aria-controls="campaignFaqs" aria-selected="true" >
            {{__('messages.campaign_faqs.campaign_faqs')}}
        </button>
    </li>
    <li class="nav-item position-relative me-7 mb-3" role="presentation">
        <button class="nav-link p-0" id="campaign-updates-tab" data-bs-toggle="tab" data-bs-target="#campaignUpdates"
                type="button" role="tab" aria-controls="campaignUpdates" aria-selected="false">
            {{__('messages.campaign_updates.campaign_updates')}}
        </button>
    </li>
    <li class="nav-item position-relative me-7 mb-3" role="presentation">
        <button class="nav-link p-0 {{ $option == 'donors' ? 'active' : ''}}" id="campaign-transactions-tab" data-bs-toggle="tab"
                data-bs-target="#campaignTransactions"
                type="button" role="tab" aria-controls="campaignTransactions" aria-selected="false">
            {{__('messages.campaign.donors')}}
        </button>
    </li>
    <li class="nav-item position-relative me-7 mb-3" role="presentation">
        <button class="nav-link p-0" id="campaign-gift-transactions-tab" data-bs-toggle="tab"
                data-bs-target="#campaignGiftTransactions"
                type="button" role="tab" aria-controls="campaignGiftTransactions" aria-selected="false">
            {{__('messages.campaign_transactions.donors_as_gift')}}
        </button>
    </li>
	<li class="nav-item position-relative me-7 mb-3" role="presentation">
		<button class="nav-link p-0" id="campaign-withdraw-request-tab" data-bs-toggle="tab"
		        data-bs-target="#campaignWithdrawRequest"
		        type="button" role="tab" aria-controls="campaignWithdrawRequest" aria-selected="false">
			{{__('messages.withdraw.withdraw_request')}}
		</button>
	</li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade {{ $option == 'default' ? 'show active' : ''}} " id="campaignFaqs" role="tabpanel" aria-labelledby="campaign-tab">
        <livewire:campaign-faq-table :campaign-id="$campaign->id"/>
        @include('admin.campaigns.campaign_faqs.create-modal')
        @include('admin.campaigns.campaign_faqs.edit-modal')
        @include('admin.campaigns.campaign_faqs.show_model')
    </div>
    <div class="tab-pane fade" id="campaignUpdates" role="tabpanel" aria-labelledby="campaign-updates-tab">
        <livewire:campaign-update-table :campaign-id="$campaign->id"/>
        @include('admin.campaigns.campaign_updates.create-modal')
        @include('admin.campaigns.campaign_updates.edit-modal')
        @include('admin.campaigns.campaign_updates.show_model')
    </div>
    <div class="tab-pane fade {{ $option == 'donors' ? 'show active' : ''}}" id="campaignTransactions" role="tabpanel" aria-labelledby="campaign-transactions-tab">
        <livewire:campaign-transaction-table :campaign-id="$campaign->id"/>
        @include('admin.campaigns.campaign_transactions.show-modal')            
    </div>
    <div class="tab-pane fade" id="campaignGiftTransactions" role="tabpanel" aria-labelledby="campaign-gift-transactions-tab">
        <livewire:campaign-transaction-as-gift-table :campaign-id="$campaign->id"/>
        @include('admin.campaigns.campaign_transactions.show-gift-modal')
    </div>
	<div class="tab-pane fade" id="campaignWithdrawRequest" role="tabpanel" aria-labelledby="campaign-withdraw-request-tab">
		<livewire:campaign-withdraw-request-table :campaign-id="$campaign->id"/>
	</div>
</div>

