<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('name', __('messages.user.first_name').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">{{ $user->first_name }}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3n">
                {{ Form::label('email', __('messages.user.last_name').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">{{ (isset($user->last_name)) ? $user->last_name : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.common.email').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($user->email)) ? $user->email : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.user.gender').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (($user->gender == 1)) ? __('messages.user.female') : __('messages.user.male') }}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.user.contact_no').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($user->contact)) ? $user->contact : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.role.role').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($user->role_name)) ? $user->role_name : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.country.country').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ (isset($user->country->country_name)) ? $user->country->country_name : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('contact', __('messages.common.is_active').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"> {{ ($user->is_active == 1) ? 'Yes' : 'No'}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('created_at', __('messages.common.created_on').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"
                      title="{{ date('jS M, Y', strtotime($user->created_at)) }}">{{ $user->created_at->diffForHumans() }}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('updated_at', __('messages.common.updated_at').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800"
                      title="{{ date('jS M, Y', strtotime($user->updated_at)) }}">{{ $user->updated_at->diffForHumans() }}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('view_by', __('messages.setting.address').(':'), ['class' => 'pb-2 fs-4 text-gray-600']) }}
                <span class="fs-4 text-gray-800">{{ (isset($user->address)) ? $user->address : __('messages.common.n/a')}}</span>
            </div>
            <div class="col-sm-3 d-flex flex-column mb-md-10 mb-3">
                {{ Form::label('icon', __('messages.common.image').(':'), ['class' => 'pb-2 fs-4 text-gray-60']) }}
                <img src="{{ $user->profile_image}}" alt="Price Image"
                     class="show-image-detail" height="50px" width="50px">
            </div>
        </div>
    </div>
</div>
