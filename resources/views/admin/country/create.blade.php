<div class="modal fade" id="addCountryModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.country.add_country') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ Form::open(['id'=>'addCountryForm']) }}
                <div class="row">
                    <div>
                        {{ Form::label('name',__('messages.common.name').(':'), ['class' => 'form-label required']) }}
                        {{ Form::text('country_name', null, ['class' => 'form-control','required', 'placeholder' => __('messages.country.enter_country_name')]) }}
                    </div>
                </div>
                <div class="d-flex justify-content-end pt-5">
                    <div>
                        {{ Form::button(__('messages.common.save'), ['type'=>'submit','class' => 'btn btn-primary m-0','id'=>'countryBtn']) }}
                        <button type="button" class="btn btn-secondary my-0 ms-2 me-0"
                                data-bs-dismiss="modal">{{ __('messages.common.discard') }}</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
