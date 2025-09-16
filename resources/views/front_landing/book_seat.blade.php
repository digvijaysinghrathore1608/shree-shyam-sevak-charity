<div class="modal fade" id="bookSeatModalShow" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg event-dialog-box">
        <div class="modal-content content-box event-book-modal">
            <div class="modal-header header-content">
                <h5 class="modal-title fw-6" id="exampleModalLabel">{{__('messages.front_landing.book_your_seat')}}</h5>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body body-content">
                <form id="bookSeatForm" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label
                                class="control-label  custom-label fw-5 fs-16 mb-2 required"
                                for="name">{{__('messages.common.name').(':')}}</label>
                        <div class="col-sm-12">
                            <input type="text"
                                   class="form-control custom-input" id="name"
                                   placeholder="{{__('messages.common.enter_name')}}" name="name"
                                   required="">
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="event_id" value="" id="eventId">
                    <div class="form-group mb-3">
                        <label
                                class="control-label  custom-label fw-5 fs-16 mb-2  required"
                                for="pwd">{{__('messages.common.email').(':')}}</label>
                        <div class="col-sm-12">
                            <input type="email"
                                   class="form-control custom-input"
                                   name="email" placeholder="{{__('messages.common.enter_email')}}"
                                   required="">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label
                                class="control-label  custom-label fw-5 fs-16 mb-2"
                                for="pwd">{{__('messages.event.notes').(':')}}</label>
                        <div class="col-sm-12">
                                                                        <textarea class="form-control custom-input"
                                                                                  name="notes"
                                                                                  placeholder="{{__('messages.common.enter_notes')}}"></textarea>
                        </div>
                    </div>
                    <div class="form-group mb-3 justify-content-end d-flex">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{__('messages.common.discard')}}
                        </button> &nbsp;&nbsp;
                        <button class="btn btn-primary custom-btn"
                                type="submit">{{__('messages.common.confirm')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
