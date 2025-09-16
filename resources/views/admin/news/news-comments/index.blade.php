
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="#newsComments" role="tabpanel"
         aria-labelledby="registration-tab">
        <div class="fw-bold">
            <livewire:news-comment-table :news-id="$news->id"/>
            @include('admin.news.news-comments.edit-modal')
        </div>
    </div>
</div>
