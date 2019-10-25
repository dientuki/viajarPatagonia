<template class="template-dropzone">

    <div class="file-row template">
    <!-- This is used as the file preview template -->
    <input type="text" name="images[]" value="" />
    <div>
        <span class="preview"><img class="thumbnail" data-dz-thumbnail /></span>
    </div>
    <div>
        <p class="name" data-dz-name></p>
        <strong class="error text-danger" data-dz-errormessage></strong>
    </div>
    <div>
        <p class="size" data-dz-size></p>
        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
        </div>
    </div>
    <div>
        <div data-dz-remove class="btn btn-warning cancel">
            <i class="glyphicon glyphicon-ban-circle"></i>
            <span>Cancel</span>
        </div>
        <div data-dz-remove class="btn btn-danger delete">
        <i class="glyphicon glyphicon-trash"></i>
        <span>Delete</span>
        </div>
    </div>
    </div>

</template>