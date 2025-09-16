<div class="tab-content pt-50 mb-lg-4" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
         aria-labelledby="pills-home-tab">
        <div class="row">
            @foreach($events as $event)
                @if($event->status == App\Models\Event::PUBLISHED)
                    <div class="col-lg-6 event-card mb-20">
                        <div class="card h-100">
                            <div class="positon-relative">
                                <div class="card-img">
                                    <a href="{{ route('landing.event.detail',$event->slug) }}">
                                        <img src="{{ !empty($event->image_url) ? $event->image_url : asset('front_landing/images/events-1.png') }}"
                                             class="card-img-top object-fit-cover" alt="card">
                                    </a>
                                </div>
                                <div class="small-btn d-flex flex-column justify-content-center align-items-center">
                                    <span class="fs-26 fw-6 ">{{ Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                                    <span class="fs-14 fw-5 "> {{ Carbon\Carbon::parse($event->event_date)->format('M') }}
                                        {{ Carbon\Carbon::parse($event->event_date)->format('Y') }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-title mb-2 d-flex flex-wrap justify-content-between align-items-center ">
                                    <div class="pe-sm-0">
                                        <h4 class="fs-20 fw-6 text-dark"><a class="text-dark"
                                                                            href="{{ route('landing.event.detail',$event->slug) }}">{{ $event->title }}</a>
                                        </h4>
                                        <div class="mb-2">
                                            <i class="fa-solid fa-location-dot text-primary me-2"></i>
                                            <span class="fs-16 fw-5 text-primary">{{ $event->venue }}</span>
                                        </div>
                                    </div>
                                   
                                    @if($event->event_date >= \Carbon\Carbon::now()->format('Y-m-d'))
                                        <div class="button">
                                            <a type="button" class="btn btn-gray bookSeatBtn" data-bs-toggle="modal"
                                               data-bs-target="#bookSeatModalShow"
                                               data-bs-whatever="@mdo"
                                               data-id="{{ $event->id }}">{{__('messages.front_landing.book_your_seat')}}</a>
                                        </div>
                                    @else
                                        <p class="text-danger">Event already expired.</p>
                                    @endif
                                    @include('front_landing.book_seat')

                                </div>
                                <p class="text-dark fs-16 fw-5">
                                    {{ strlen( $event->description ) > 100 ? substr($event->description,0, 200).'.....': $event->description }}
                                </p>
                              
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="row justify-content-center align-items-center mt-3">
        <div class="col-md-6 text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center mb-0  flex-wrap">
                    <span class="page-item">{{ $events->links() }}</span>
                </ul>
            </nav>
        </div>
    </div>
</div>


