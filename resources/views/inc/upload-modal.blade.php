    <div class="modal" id="uploadModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!!Form::open(['action' => 'FilesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::label('title', 'Title')}}
                        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('description', 'File Description')}}
                        {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'File Description', 'id' => 'article-ckeditor'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('private', 'Make file private')}}
                        {{ Form::hidden('private', 0) }}
                        {{ Form::checkbox('private', 1, true)}}
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            {{ Form::file('file', ['class' => 'custom-file-input', 'id' => 'inputGroupFile'])}}
                            <label class="custom-file-label" for="inputGroupFile">Choose file</label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    </div>
                    {!! Form::close() !!}
                <br/>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
