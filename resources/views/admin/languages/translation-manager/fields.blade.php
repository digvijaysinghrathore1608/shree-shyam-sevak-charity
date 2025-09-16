<div class="row col-12  mb-5">
    <div class="col-sm-3">
        {{Form::select('file_name', $allFiles, $selectedFile, ['class' => 'form-select translate-language-files','placeholder' => __('messages.language.select_file'), 'id'=>'subFolderFiles','data-turbolinks'=>'false', 'data-control' => 'select2']) }}
    </div>
    <div class="col-sm-3 mb-5 d-flex justify-content-end offset-3 ms-auto">
        {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2','name' => 'save', 'id' => 'saveJob']) }}
    </div>
    <hr>
    <br>
    @foreach($languages as $key => $value)
        @if(!is_array($value))
            <div class="col-sm-4 mb-5">
                {{ Form::label('title', str_replace('_',' ',ucfirst($key)).':', ['class' => 'form-label']) }}
                {{ Form::text($key, $value, ['class' => 'form-control','required','placeholder' => str_replace('_',' ',ucfirst($key))]) }}
            </div>
        @else
            @foreach($value as $nestedKey => $nestedValue)
                @if(!is_array($nestedValue))
                    <div class="col-lg-4 col-md-3 mb-5">
                        {{ Form::label('title',  str_replace('_',' ',ucfirst($nestedKey)) .':', ['class' => 'form-label']) }}
                        <input type="text" class="form-control" name="{{$key}}[{{$nestedKey}}]"
                               value="{{ $nestedValue }}" placeholder="{{str_replace('_',' ',ucfirst($nestedKey))}}"/>
                    </div>
                @endif
            @endforeach
        @endif
    @endforeach
</div>

