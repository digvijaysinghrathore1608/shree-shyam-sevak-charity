<div class="tab-pane fade" id="campaignTransactions" role="tabpanel">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="campaignTransactions" role="tabpanel">
            <div>
                <div class="pt-0">
                    <livewire:user-campaign-transaction-table :campaign-id="$campaign->id"/>
                    @include('user.campaigns.campaign_transactions.show-modal')
                </div>
            </div>
        </div>
    </div>
</div>
