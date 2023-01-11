@extends('admin.layouts.main')
@if(isset($updating) && $updating)
@section('title', 'Update News')
@else
@section('title', 'Add News')
@endif
@section('styles')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/cropperjs/cropper.css') }}">
<style>
  .hiden {
    display: none;
  }
</style>
@endsection

@section('content')

<div id="admin-page" class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        <div class="panel-actions">
          <a class="mb-xs mt-xs mr-xs btn btn-primary" href="{{ route('admin.news.index') }}">List All</a>
        </div>
        <h2 class="panel-title">
          @if(isset($updating) && $updating) Update News @else Add News @endif
        </h2>
      </header>
      @if(isset($updating) && $updating)
      <form action="{{ route('admin.news.update', $news->id) }}" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @else
        <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
          @endif {{ csrf_field() }}
          <div class="panel-body">
            <?php /*?>
            <div class="form-group
                        @if($errors->has('flash_news'))
                            has-error
                        @endif
                        ">
              <label class="col-md-3 control-label" for="inputDefault">Flash News</label>
              <div class="col-md-6">
                <input type="checkbox" style="width: 20px;" name="flash_news" class="form-control" value="1" {{ isset($news)? $news->flash_news?
                                'checked' :'':'' }}> @if($errors->has('flash_news'))
                <label for="name" class="error">{{ $errors->first('flash_news') }}</label> @endif
              </div>
            </div>
            <?php */?>
             <div class="form-group
            @if($errors->has('date'))
                has-error
            @endif
        ">
              <label class="col-md-3 control-label" for="inputDefault">Date <em>*</em></label>
              <div class="col-md-9">
                  <input type="text" name="date" class="form-control" id="date" value="{{isset($news->date) ? $news->date->format('d/m/Y') : old('date') }}" readonly>
                @if($errors->has('date'))
                <label for="name" class="error">{{ $errors->first('date') }}</label>
                @endif
              </div>
            </div> 
            <div class="form-group
              @if($errors->has('title'))
                  has-error
              @endif
            ">
              @if(isset($updating) && $updating)
              <input type="hidden" id="demo" value="{{ $news?$news->id:'' }}"> @endif
              <label class="col-md-3 control-label" for="inputDefault">News Title <em>*</em></label>
              <div class="col-md-9">
                <input type="text" name="title" maxlength="70" class="form-control" id="Name"
                  value="{{$news->title ?? old('title') }}">
                @if($errors->has('title'))
                <label for="name" class="error">{{ $errors->first('title') }}</label>
                @endif
                <small>maximum 70 characters</small>
              </div>
            </div>
            <div class="form-group
                            @if($errors->has('original_file'))
                                has-error
                            @endif
                        ">
              <label class="col-md-3 control-label" for="inputDefault">Image </label>
              <div class="col-md-9">


                <input name='original_file' type='file' id='upload-file' class="form-control" value="{{isset($news->large_image) ?
                                            $news->large_image : old('large_image') }}">
                <input type="hidden" name="image_props" id="image_props"
                  value=" {{ isset($news->large_image) ? $news->large_image : old('large_image') }}">
                <small>file format should be .jpg/jpeg/png with < 1mb better dimensions is 800 X 500</small>
                    @if($errors->has('original_file'))
                    <label for="large_image" class="error">{{ $errors->first('original_file') }}</label> @endif
                    @isset($news)
                    <div style="margin-top: 10px;">
                      @if($news->large_image)
                      <img src="{{ asset('storage/app/public/news/'.$news->large_image) }}" alt="" class="img"
                        width="100">
                      @else
                      <img src="{{asset('assets/img/default-img/default-img.jpg')}}" alt="" width="200px">
                      @endif
                    </div>
                    @endisset
              </div>
            </div>


            <div class="form-group
                @if($errors->has('description'))
                    has-error
                @endif
            ">
              <label class="col-md-3 control-label" for="inputDefault">Description <em>*</em></label>
              <div class="col-md-9">
                <textarea name="description" id="ckeditor" maxlength=255 class="form-control" cols="30"
                  rows="3">{{ isset($news) ? $news->description : old('description') }}</textarea>
                @if($errors->has('description'))
                <label for="name" class="error">{{ $errors->first('description') }}</label> @endif
              </div>
            </div>
            <div class="form-group
              @if($errors->has('priority'))
                  has-error
              @endif
            ">
              @if(isset($updating) && $updating)
              <input type="hidden" id="demo" value="{{ $news?$news->id:'' }}"> @endif
              <label class="col-md-3 control-label" for="inputDefault">Priority<em>*</em></label>
              <div class="col-md-9">
                <input type="text" onkeypress="return isNumber(event)" name="priority" maxlength="5" class="form-control" id="priority"
                  value="{{$news->priority ?? old('priority') }}">
                @if($errors->has('priority'))
                <label for="priority" class="error">{{ $errors->first('priority') }}</label>
                @endif
                
              </div>
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


<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cancel" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
            class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Crop the image</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="crop">Crop</button>
      </div>
      <div class="modal-body">
        <div class="img-container">
          <img id="image" src="">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('admin/assets/vendor/ckeditor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('admin/assets/vendor/ckeditor/ckeditor/adapters/jquery.js')}}"></script>

<script src="{{ asset('admin/assets/vendor/cropperjs/cropper.js') }}"></script>


<script>
  window.addEventListener('DOMContentLoaded', function () {
    var thumbnail = document.getElementById('image_props'); // hiiden file id
    var image = document.getElementById('image'); //model image id 
    var upload_file = $('#upload-file'); //actual file upload id
    var $modal = $('#modal'); //model id
    var cropper;
    var cancel = $('.cancel');
    cancel.on('click', function () {
      upload_file.val('');
    })

    upload_file.on('change input', function (e) {
      var files = e.target.files;
      var fileInput = document.getElementById('upload-file');
      var filePath = fileInput.value;
      var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

      if (files[0].size /1024/1024>1 && allowedExtensions.exec(filePath)) {
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
        aspectRatio: 800 / 500,
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
      thumbnail.value = JSON.stringify(cropper.getData());
    });
  });




  $('.remove-file').on('click', removeFile);
</script>
<script>

function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
<script type="text/javascript">
  $(function () {
    $('#ckeditor').ckeditor({
      toolbar: 'Full',
      enterMode: CKEDITOR.ENTER_BR,
      shiftEnterMode: CKEDITOR.ENTER_P
    });
  });
  CKEDITOR.config.extraPlugins = 'colorbutton';
  $('#date').flatpickr({
  dateFormat: "d/m/Y",
})
$(".form-control[readonly]").css("background-color","white");

</script>
@endsection