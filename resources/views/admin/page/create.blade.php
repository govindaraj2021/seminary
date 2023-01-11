@extends('admin.layouts.main') @if(isset($updating) && $updating) @section('title', 'Update Page') @else
@section('title', 'Add Page') @endif @section('styles')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/cropperjs/cropper.css') }}">
<style>
    .hiden {
        display: none;
    }
</style> @endsection @section('content') <div id="admin-page" class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a class="mb-xs mt-xs mr-xs btn btn-primary" href="{{ route('admin.page.index') }}">List All</a>
                </div>
                <h2 class="panel-title">@if(isset($updating) && $updating) Update Page @else Add Page @endif </h2>
            </header> @if(isset($updating) && $updating) <form action="{{ route('admin.page.update', $page->id) }}"
                method="POST" enctype="multipart/form-data"> @method('PUT') @else <form
                    action="{{ route('admin.page.store') }}" method="post" enctype="multipart/form-data"> @endif
                    {{ csrf_field() }} <div class="panel-body">
                        <div class="form-group
                  @if($errors->has('position'))
                      has-error
                  @endif
              ">
                            <label class="col-md-3 control-label">Select Position <em>*</em></label>
                            <div class="col-md-9">
                                <select class="form-control" name="position">
                                    <option value="">Select </option> @if($position) @foreach($position as $value)
                                    <option value="{{$value['id']}}" @if( isset($page) && $page->position_id ==
                                        $value['id']) selected @endif
                                        {{ (old("position") == $value['id'] ? "selected":"") }} > {{$value['name']}}
                                    </option> @endforeach @endif
                                </select> @if($errors->has('position')) <label for="position"
                                    class="error">{{ $errors->first('position') }}</label> @endif </div>
                        </div>
                        <div class="form-group
                    @if($errors->has('parent_id'))
                        has-error
                    @endif
                ">
                                            <label class="col-md-3 control-label">Select Parent</label>
                            <div class="col-md-9">
                                <select class="form-control" name="parent_id">
                                    <option value="0">No Parent</option> @isset($pages) @foreach($pages as $value)
                                    <option value="{{ $value->id }}"@if( isset($page)) {{$value->id==$page->parent_id?'selected':''}}@endif>
                                        {{ title_case($value->name) }} </option> @endforeach @endisset
                                </select> @if($errors->has('parent_id')) <label for="parent"
                                    class="error">{{ $errors->first('parent_id') }}</label> @endif </div>
                        </div>
                        <div class="form-group
                    @if($errors->has('name'))
                        has-error
                    @endif
                ">
                            <label class="col-md-3 control-label" for="name">Name <em>*</em></label>
                            <div class="col-md-9">
                                <input type="text" id="name" maxlength="60" name="name" class="form-control"
                                    value=" {{ isset($page) ? $page->name : old('name') }}">
                                <small>No more than 60 charecters</small> @if($errors->has('name')) <label for="name"
                                    class="error">{{ $errors->first('name') }}</label> @endif </div>
                        </div>





                        <div class="form-group
                    @if($errors->has('page_title'))
                        has-error
                    @endif
                ">
                            <label class="col-md-3 control-label" for="page title">Page Title <em>*</em></label>
                            <div class="col-md-9">
                                <input type="text" id="page_title" maxlength="60" name="page_title" class="form-control"
                                    value="{{ isset($page) ? $page->page_title : old('name') }}">
                                <small>No more than 60 charecters</small> @if($errors->has('page_title')) <label
                                    for="page_title" class="error">{{ $errors->first('page_title') }}</label> @endif
                            </div>
                        </div>
                        <div class="form-group
                        @if($errors->has('url'))
                            has-error
                        @endif
                    ">
        <label class="col-md-3 control-label" for="url">URL <em>*</em></label>
        <div class="col-md-9">
            <input type="text" id="url" name="url" class="form-control"
                value="{{ isset($page) ? $page->url : old('url') }}"> @if($errors->has('url')) <label for="url"
                class="error">{{ $errors->first('url') }}</label> @endif </div>
    </div>
    <div class="form-group
                    @if($errors->has('description'))
                        has-error
                    @endif
                ">
        <label class="col-md-3 control-label" for="inputDefault">Description</label>
        <div class="col-md-9">
            <textarea name="description" id="ckeditor" class="form-control" rows="9"
                maxlength="1000">{{ $page->description ?? old('description') }}</textarea>
            <small>(Max. 1000 characters)</small> @if($errors->has('description')) <label for="description"
                class="error">{{ $errors->first('description') }}</label> @endif </div>
    </div>
    {{--
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="description">Description <em>*</em></label>
                                <div class="grid" style="padding-left: 2px;padding-right: 2px;">
                                    <textarea id="description" name="description" class="form-control">{{ isset($page) ? $page->description : old('description') }}</textarea>
</div>
<div class="error">{{ $errors->first('description') }} </div>
</div>
</div> --}} <div class="form-group
                    @if($errors->has('meta_title'))
                        has-error
                    @endif
                ">
    <label class="col-md-3 control-label" for="meta title">Meta Title</label>
    <div class="col-md-9">
        <input type="text" maxlength="60" id="meta_title" name="meta_title" class="form-control"
            value="{{ isset($page) ? $page->meta_title : old('meta_title') }}">
        <small>No more than 60 charecters</small>
    </div>
</div>



<div class="form-group
                    @if($errors->has('meta_keyword'))
                        has-error
                    @endif
                ">
    <label class="col-md-3 control-label" for="meta keyword">Meta keyword</label>
    <div class="col-md-9">
        <input type="text" id="meta_keyword" maxlength="60" name="meta_keyword" class="form-control"
            value="{{ isset($page) ? $page->meta_keyword : old('meta_keyword') }}">
        <small>No more than 60 charecters</small>
    </div>
</div>



<div class="form-group
                    @if($errors->has('meta_description'))
                        has-error
                    @endif
                ">
    <label class="col-md-3 control-label" for="meta_description">Meta Description</label>
    <div class="col-md-9">
        <input type="text" id="meta_description" maxlength="120" name="meta_description" class="form-control"
            value="{{ isset($page) ? $page->meta_description : old('meta_description') }}">
        <small>No more than 120 charecters</small>
    </div>
</div>


<div class="form-group
                    @if($errors->has('meta_description'))
                        has-error
                    @endif
                ">
    <label class="col-md-3 control-label" for="priority">Priority</label>
    <div class="col-md-9">
        <input type="number" min="0" id="priority" name="priority" class="form-control"
            value="{{ isset($page) ? $page->priority : old('priority') }}">
    </div>
</div>



<div class="form-group
                        @if($errors->has('original_file'))
                            has-error
                        @endif
                    ">
    <label class="col-md-3 control-label" for="Gallery Image">Page Banner</label>
    <div class="col-md-6">
        <input type="file" name="original_file" class="form-control checkgallery" id="upload-file">
        <input for="image" type="hidden" name="thumbnail" class="form-control" id="thumbnail" value="" id="">
        <small>file format should be .jpg/jpeg/png with < 1mb better dimensions is 1600 x 300 px</small> @if($errors->
                has('original_file')) <label for="image" class="error">{{ $errors->first('original_file') }}</label>
                @endif @if(isset($page->large_image)) <div style="margin-top: 10px;">
                    <img src="{{ asset('storage/app/public/page/'. $page->large_image ) }}" alt="" class="img"
                        width="100">
                </div> @endif </div>
</div>


</div>
<footer class="panel-footer">
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</footer>
</form>
</section>
</div>
</div>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Choose Thumbnail</h5>
                <button type="button" class="close cancel" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="image" src="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop">Save</button>
            </div>
        </div>
    </div>
</div> @endsection @section('scripts') <script src="{{asset('admin/assets/vendor/ckeditor/ckeditor/ckeditor.js')}}">
</script>
<script src="{{asset('admin/assets/vendor/ckeditor/ckeditor/adapters/jquery.js')}}"></script>
<script>
    $(function () {
    $('#ckeditor').ckeditor({
      toolbar: 'Full',
      enterMode: CKEDITOR.ENTER_BR,
      shiftEnterMode: CKEDITOR.ENTER_P,
      image: {
            toolbar: [ 'toggleImageCaption', 'imageTextAlternative' ]
        }
    });
    CKEDITOR.dtd.a.div = 1;
  });

</script>
<script src="{{ asset('admin/assets/vendor/cropperjs/cropper.js') }}"></script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        var thumbnail = document.getElementById('thumbnail'); // hiiden file id
        var image = document.getElementById('image'); //model image id
        var upload_file = $('#upload-file'); //actual file upload id
        var $modal = $('#modal'); //model id
        var cropper;
  
  
        upload_file.on('change input', function (e) {
          var files = e.target.files;
          var fileInput = document.getElementById('upload-file');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
          if(files[0].size /1024/1024>1 && allowedExtensions.exec(filePath)){
            alert("File size exceeded")
                  $('#upload-file').val('');
                  $('#thumbnail').val('');
          }
  
               if (!allowedExtensions.exec(filePath)) {
          alert('Please upload file having extensions .jpeg/.jpg/.png only.');
          $('#upload-file').val('');
          $('#thumbnail').val('');
        }
   var done = function (url) {
            upload_file.value = '';
            image.src = url;
            $modal.modal('show');
          };
  
  
          var reader;
          var file;
          var url;
  
          if (files && files.length > 0) {
            file = files[0];
  
            if (URL) {
              done(URL.createObjectURL(file));
            } else if (FileReader) {
              reader = new FileReader();
              reader.onload = function (e) {
                done(reader.result);
              };
              reader.readAsDataURL(file);
            }
  
          }
        });
  
        $modal.on('shown.bs.modal', function () {
          cropper = new Cropper(image, {
            aspectRatio: 1600 / 300,
            viewMode: 2,
          });
        }).on('hidden.bs.modal', function () {
          cropper.destroy();
          cropper = null;
        });
  
        document.getElementById('crop').addEventListener('click', function () {
          var initialAvatarURL;
          var canvas;
  
          $modal.modal('hide');
  
          // if (cropper) {
          //   canvas = cropper.getCroppedCanvas({
          //     height: 600,
          //     width: 800,
          //   });
          thumbnail.value = JSON.stringify(cropper.getData());
  
  
  
            // thumbnail.value = canvas.toDataURL();
          // }
        });
  
  
  
  
      });
  
  </script>
      <script>
              $('.cancel').on('click',function(e){
                  e.preventDefault()
                  $("#upload-file").val('');
                  $("#thumbnail").val('');
                  $('#modal').modal('hide')
                     
                })
                  </script>
 @endsection