<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('name', __('messages.common.title').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">{{$news->title}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3n">
                {{ Form::label('name', __('messages.news.category').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">{{$news->newsCategory->name}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('created_at', __('messages.common.created_at').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"
                      title="">{{ \Carbon\Carbon::parse($news->created_at)->isoFormat('Do MMM, YYYY')}}
                                            </span>
            </div>
            <div class="col-sm-12 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('name', __('messages.common.description').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">
                                                {!! $news->description ?  $news->description : 'N/A' !!} 
                                            </span>
            </div>
        </div>
    </div>
</div>
<div class="mt-7 overflow-hidden">
    <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="myTab" role="tablist">
        <li class="nav-item position-relative me-7 mb-3" role="presentation">
            <button class="nav-link active p-0" id="registration-tab" data-bs-toggle="tab"
                    data-bs-target="#newsComments"
                    type="button" role="tab" aria-controls="overview" aria-selected="true">
                {{__('messages.news_comments.comments')}}
            </button>
        </li>
    </ul>
</div>
