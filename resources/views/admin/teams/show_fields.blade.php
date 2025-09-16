<!-- Name Field -->
<div class="form-group">
    {{ Form::label('name', __('models/teams.fields.name').':') }}
    <p>{{ $team->name }}</p>
</div>

<!-- Designation Field -->
<div class="form-group">
    {{ Form::label('designation', __('models/teams.fields.designation').':') }}
    <p>{{ $team->designation }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {{ Form::label('created_at', __('models/teams.fields.created_at').':') }}
    <p>{{ $team->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {{ Form::label('updated_at', __('models/teams.fields.updated_at').':') }}
    <p>{{ $team->updated_at }}</p>
</div>

