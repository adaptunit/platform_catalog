<div class="wrapper">
    <div class="{{$subClass}}_form-wrapper">
        {{ Form::open(array('url'=>'category')) }}

            <div class="field">
                <i class="fa fa-folder-open"></i>
                <label data-error="wrong" data-success="right" for="name">Category name</label>
                <input type="text" id="name" name="name" class="form-control validate">
            </div>

            <div id="message-error" class="alert alert-danger" style="display: none">
            </div>

        <div class="_footer d-flex justify-content-center">
            <button class="btn btn-sm btn-success" id="createCategoryBtn">Create</button>
        </div>
        {{ Form::close() }}
    </div>
</div>


