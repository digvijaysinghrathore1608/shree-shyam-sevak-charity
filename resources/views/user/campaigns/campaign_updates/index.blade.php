<div class="tab-pane fade" id="campaignUpdates" role="tabpanel">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="campaignUpdates" role="tabpanel">
            <div class=" pt-0">
                <livewire:user-campaign-update-table :campaign-id="$campaign->id"/>
                @include('user.campaigns.campaign_updates.create-modal')
                @include('user.campaigns.campaign_updates.edit-modal')
                @include('user.campaigns.campaign_updates.show_model')
            </div>
        </div>
    </div>
</div>

