<fieldset class="sticky-wrapper">
  <div  class="sticky-head">
    <h2>Images</h2>

    <div id="actions" class="row">

      <div class="col-lg-7">
        <!-- The fileinput-button span is used to style the file input field as button -->
        <div class="btn btn-success fileinput-button" id="dropzone" data-url="{{ route('admin.images.store') }}" data-maxfiles="1">
          <i class="glyphicon glyphicon-plus"></i>
          <span>Add file...</span>
        </div>
        <div type="reset" class="btn btn-warning cancel">
          <i class="glyphicon glyphicon-ban-circle"></i>
          <span>Cancel upload</span>
        </div>
      </div>

    </div>

  </div>

  <ul class="table table-striped files" id="previews">
    @if (request()->old('images') != null)
    @foreach (request()->old('images') as $image)
    @if ($image != null)
    <li class="file-row template old-image row">
      <!-- This is used as the file preview template -->
      <input type="text" class="image" name="images" value="{{ $image }}" />
      <div class="col-2">
        <span class="preview"><img class="thumbnail" data-dz-thumbnail /></span>
      </div>
      <div class="col">

      </div>
      <div class="col-2">
        <div data-dz-remove class="btn btn-danger delete">
          <i class="glyphicon glyphicon-trash"></i>
          <span>Delete</span>
        </div>
      </div>
    </li>
    @endif
    @endforeach
    @endif

  </ul>

  @include('admin.homeslider.template')

</fieldset>