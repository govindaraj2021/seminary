@extends('admin.layouts.main') @if (isset($updating) && $updating)
@section('title', 'Update Gallery')
@else
@section('title', 'Add Gallery')
@endif @section('styles')
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
                    <a class="mb-xs mt-xs mr-xs btn btn-primary" href="{{ route('admin.gallery.index') }}">List All</a>
                </div>
                <h2 class="panel-title">
                    @if (isset($updating) && $updating)
                    Update Gallery
                    @else
                    Add Gallery
                    @endif
                </h2>
            </header>
            @if (isset($updating) && $updating)
            <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST"
                enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @else
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @endif
                    {{ csrf_field() }} <div class="panel-body">
                        
                    
                
                        <div class="form-group
     @if ($errors->has('title')) has-error @endif
 ">
                            <label class="col-md-3 control-label" for="inputDefault">Title<em>*</em></label>
                            <div class="col-md-6">
                                <input type="text" name="title" maxlength="45" class="form-control"
                                    value="{{ isset($gallery->title) ? $gallery->title : old('title') }}">
                                @if ($errors->has('title'))
                                <label for="title" class="error">{{ $errors->first('title') }}</label>
                                @endif <small>No more than 45
                                    charecters</small>
                            </div>
                        </div>
           
                        
                        <div class="form-group 
                   @if ($errors->has('gallery_status')) has-error @endif
               ">
                            <label class="col-md-3 control-label" for="inputDefault">Video/Image <em>*</em></label>
                            <div class="col-md-6">
                                <input type="radio" name="gallery_status" class="radiobutton" value="1" id="is_video_yes" {{
                                    isset($gallery) && $gallery->gallery_status == 1 ? 'checked' : '' }}
                                {{ old('gallery_status') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_video_yes">
                                    Video
                                </label>
                                <input type="radio" name="gallery_status" class="radiobutton" value="0" id="is_video_no" {{
                                    isset($gallery) && $gallery->gallery_status == 0 ? 'checked' : '' }}
                                {{ old('gallery_status') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_video_no">
                                    Image
                                </label>
                                <br>
                                @if ($errors->has('gallery_status'))
                                <label for="title" class="error">{{ $errors->first('gallery_status') }}</label>
                                @endif
                            </div>
                        </div>


                        
                        <div class="form-group img
                            @if ($errors->has('original_file')) has-error @endif
                        ">
                            <label class="col-md-3 control-label" for="Gallery Image">Image <em>*</em></label>
                            <div class="col-md-6">
                                <input type="file" name="original_file" class="form-control checkgallery"
                                    id="upload-file">
                                <input for="image" type="hidden" name="thumbnail" class="form-control" id="thumbnail"
                                    value="" id="">
                                <small>file format should be .jpg/jpeg/png with < 1mb better dimensions is 1000X700
                                        px</small>
                                        @if ($errors->has('original_file'))
                                        <label for="image" class="error">{{ $errors->first('original_file') }}</label>
                                        @endif
                                        @if (isset($gallery->large_image))
                                        <div style="margin-top: 10px;">
                                            <img src="{{ asset('storage/app/public/Gallery/' . $gallery->large_image) }}"
                                                alt="" class="img" width="100">
                                        </div>
                                        @endif
                            </div>

                        </div>

                        <div class="form-group video
            @if ($errors->has('link')) has-error @endif
           ">
                            <label class="col-md-3 control-label" for="inputDefault">Video Link *</label>
                            <div class="col-md-6">
                                <input type="text" name="link" maxlength="60" class="form-control" id="Video"
                                    value="{{ isset($gallery->link) ? $gallery->link : old('video') }}">
                                @if ($errors->has('link'))
                                <label for="video" class="error">{{ $errors->first('link') }}</label>
                                @endif
                                <span style="color:#666;">Eg:- https://www.youtube.com/watch?v=<font color="red">
                                        ktYroQP5A1c</font><br>
                                    <label class="alert-warning">(Paste the last portion of youtube video URL as shown
                                        in the above example)</label></span>

                            </div>
                        </div>


                        <div class="form-group
                                        @if($errors->has('priority'))
                                            has-error
                                        @endif
                                    ">
                        <label class="col-md-3 control-label" for="priority">Priority *</label>
                        <div class="col-md-9">
                            <input type="number" min="0" id="priority" name="priority" class="form-control"
                                value="{{ isset($gallery) ? $gallery->priority : old('priority') }}">
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
</div> {{-- models --}}

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
  aria-hidden="true">
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
</div>

@endsection @section('scripts')
<script src="{{ asset('admin/assets/vendor/cropperjs/cropper.js') }}"></script>
<script>
  window.addEventListener('DOMContentLoaded', function() {
    var thumbnail = document.getElementById('thumbnail'); // hiiden file id
    var image = document.getElementById('image'); //model image id
    var upload_file = $('#upload-file'); //actual file upload id
    var $modal = $('#modal'); //model id
    var cropper;


    upload_file.on('change input', function(e) {
      var files = e.target.files;
      var fileInput = document.getElementById('upload-file');
      var filePath = fileInput.value;
      var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
      if (files[0].size / 1024 / 1024 > 1 && allowedExtensions.exec(filePath)) {
        alert("File size exceeded")
        $('#upload-file').val('');
        $('#thumbnail').val('');
      }
      if (!allowedExtensions.exec(filePath)) {
        alert('Please upload file having extensions .jpeg/.jpg/.png only.');
        $('#upload-file').val('');
        $('#thumbnail').val('');
      }
      var done = function(url) {
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
          reader.onload = function(e) {
            done(reader.result);
          };
          reader.readAsDataURL(file);
        }

      }
    });

    $modal.on('shown.bs.modal', function() {
      cropper = new Cropper(image, {
        aspectRatio: 1000 / 700,
        viewMode: 2,
      });
    }).on('hidden.bs.modal', function() { 
      cropper.destroy();
      cropper = null;
    });

    document.getElementById('crop').addEventListener('click', function() {
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
  $('.cancel').on('click', function(e) {
    e. preventDefault()
    $("#upload-file").val('');
    $("#thumbnail").val('');
    $('#modal').modal('hide')

  })

  function onVideocheck() {
    var status = ($('input[name=gallery_status]:checked').val());
    if (status == null) {
      $(".img").addClass("hide");
      $(".video").addClass("hide");
    }
    if (status == 1) {
      $(".video").removeClass("hide");
      $(".img").addClass("hide");
    } else if (status == 0) {
      
      $(".img").removeClass("hide");
      $( ".video").addClass("hide");
    }


  }
  onVideocheck()
  $('.radiobutton').change(onVideocheck);
</script>
@endsection