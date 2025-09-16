<div class="row">
    @if($newsies->count() > 0)
        @foreach($newsies as $news)
        <div class="col-12 news-card mb-20">
            <div class="card">
                <div class="positon-relative">
                    <div class="card-img rounded-10">
                        <a href="{{ route('landing.news-details',$news->slug) }}">
                            <img src="{{ !empty($news->news_image) ? $news->news_image : url(asset('front_landing/images/news-post1.png')) }}"
                                 class="w-100 h-100 card-img-top object-fit-cover rounded-10 news-card-image"
                                 alt="card">
                        </a>
                    </div>
                    <span class="badge small-btn">{{isset($news->newsCategory) ? $news->newsCategory->name : ''}}</span>
                </div>
                <div class="card-body pt-0">
                    <h4 class="card-title text-dark fw-6 fs-20 pb-1">
                        <a class="text-dark"
                           href="{{ route('landing.news-details',$news->slug) }}">{{ \Illuminate\Support\Str::limit($news->title, 90) }}</a>
                    </h4>
                    <p class="fs-14 mb-2">
                        {!! !empty(strip_tags($news->description)) ? Str::limit(strip_tags($news->description),400,'...') :__('messages.common.n/a') !!}
                    </p>
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="d-flex">
                        <div class="admin-post me-2">
                            <img src="{{ !empty($news->users) ? $news->users[0]->profile_image : url(asset('front_landing/images/admin.png')) }}"
                                 class="w-100 h-100 object-fit-cover rounded-20">
                        </div>
                        <span class="fs-14 fw-5 text-dark my-auto">@foreach($news->users as $user){{$user->first_name.' '.$user->last_name}}@endforeach</span>
                        </div>
                        <div class="d-flex ml-auto">
                            <div class="mx-2 my-2 ps-1">
                                <i class="fa-solid fa-message text-primary"></i>
                                <span
                                    class="fs-14 fw-5 text-primary">{{ $news->news_comments_count }} {{__('messages.news_comments.comments')}}</span>
                            </div>
                            <div class="my-2">
                                <i class="fa-solid fa-calendar text-primary"></i>
                                <span
                                    class="fs-14 fw-5 text-primary">{{ \Carbon\Carbon::parse($news->created_at)->isoFormat('Do MMMM YYYY')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
        @if($this->searchByNewsNameDesc != '')
            <h3 align="center">{{__('messages.no_news_found')}}</h3>
        @endif
    @endif
    <div class="row justify-content-center align-items-center mt-xl-3 pt-xl-1">
        <div class="col-md-6 text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mb-5  flex-wrap">
                    <span class="page-item">{{$newsies->links()}}</span>
                </ul>
            </nav>
        </div>
    </div>
</div>



