<fieldset class="sticky-wrapper">
    <h2 class="sticky-head">Images</h2>
    
    <div id="actions" class="row">

        <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <div class="btn btn-success fileinput-button" id="dropzone" data-url="{{ route('admin.images.store') }}">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Add files...</span>
            </div>
            <div type="reset" class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Cancel upload</span>
            </div>
        </div>

        <div class="col-lg-5">
            <!-- The global file processing state -->
            <div class="fileupload-process">
                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                    aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
            </div>
        </div>

    </div>

    <div class="table table-striped files" id="previews">
        @if (request()->old('images') != null)
        @foreach (request()->old('images') as $image)
        @if ($image != null)
        <div class="file-row template old-image">
            <!-- This is used as the file preview template -->
            <input type="text" name="images[]" value="{{ $image }}" />
            <div>
                <span class="preview"><img class="thumbnail" data-dz-thumbnail /></span>
            </div>
            <div>

                <div data-dz-remove class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </div>
            </div>
        </div>

        @endif

        @endforeach
        @endif
    </div>

    @include('admin.cruiseships.template')

</fieldset>