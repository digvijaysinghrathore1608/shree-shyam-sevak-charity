<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade {{ $option == 'default' ? 'show active' : ''}}" id="campaignFaqs" role="tabpanel">
        <livewire:user-campaign-faq-table :campaign-id="$campaign->id"/>
        @include('user.campaigns.campaign_faqs.create-modal')
        @include('user.campaigns.campaign_faqs.edit-modal')
        @include('user.campaigns.campaign_faqs.show_model')
    </div>
    <div class="tab-pane fade" id="campaignUpdates" role="tabpanel">
        <div class=" pt-0">
            <livewire:user-campaign-update-table :campaign-id="$campaign->id"/>
            @include('user.campaigns.campaign_updates.create-modal')
            @include('user.campaigns.campaign_updates.edit-modal')
            @include('user.campaigns.campaign_updates.show_model')
        </div>
    </div>
    <div class="tab-pane fade {{ $option == 'donors' ? 'show active' : ''}}" id="campaignTransactions" role="tabpanel">
            <div class="pt-0">
                <livewire:user-campaign-transaction-table :campaign-id="$campaign->id"/>
                @include('user.campaigns.campaign_transactions.show-modal')
            </div>
    </div>
    <div class="tab-pane fade" id="campaignGiftTransactions" role="tabpanel" aria-labelledby="campaign-gift-transactions-tab">
        <livewire:user-campaign-transaction-as-gift-table :campaign-id="$campaign->id"/>
        @include('user.campaigns.campaign_transactions.show-gift-modal')
    </div>
    {{--    @include('user.campaigns.campaign_updates.index')--}}
	{{--    @include('user.campaigns.campaign_transactions.index')--}}
        @include('user.campaigns.campaign_withdraw_request.index')
</div>
