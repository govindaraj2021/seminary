@extends('admin.layouts.main') @if(isset($updating) && $updating)
@section('title', 'Update Testimonial') @else
@section('title',
'Add Testimonial') @endif
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
                    <a class="mb-xs mt-xs mr-xs btn btn-primary" href="{{ route('admin.testimonial.index') }}">List
                        All</a>
                </div>
                <h2 class="panel-title">
                    @if(isset($updating) && $updating) Update Testimonial @else Add Testimonial @endif
                </h2>
            </header>
            @if(isset($updating) && $updating)
            <form action="{{ route('admin.testimonial.update', $testimonial->id) }}" method="post"
                enctype="multipart/form-data">
                {{ method_field('PUT') }} @else
                <form action="{{ route('admin.testimonial.store') }}" method="post" enctype="multipart/form-data">
                    @endif {{ csrf_field() }}
                    <div class="panel-body">

                        <div class="form-group
                            @if($errors->has('name'))
                                has-error
                            @endif
                        ">
                            @if(isset($updating) && $updating)
                            <input type="hidden" id="demo" value="{{ $testimonial?$testimonial->id:'' }}"> @endif
                            <label class="col-md-3 control-label" for="inputDefault"> Name <em>*</em></label>
                            <div class="col-md-6">
                                <input type="text" name="name" maxlength="30" class="form-control" id="Name"
                                    value="{{$testimonial->name ?? old('name') }}"> @if($errors->has('name'))
                                <label for="name" class="error">{{ $errors->first('name') }}</label> @endif
                                <small>maximum 30 characters</small>

                            </div>
                        </div>




                        <div class="form-group 
                   @if ($errors->has('is_video')) has-error @endif
               ">
                            <label class="col-md-3 control-label" for="inputDefault">Video<em>*</em></label>
                            <div class="col-md-6">
                                <input type="radio" name="is_video" class="radiobutton" value="1" id="is_video_yes" {{
                                    isset($testimonial) && $testimonial->is_video == 1 ? 'checked' : '' }}
                                {{ old('is_video') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_video_yes">
                                    Video
                                </label>
                                <input type="radio" name="is_video" class="radiobutton" value="0" id="is_video_no" {{
                                    isset($testimonial) && $testimonial->is_video == 0 ? 'checked' : '' }}
                                {{ old('is_video') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_video_no">
                                    Testimonial
                                </label>
                                <br>
                                @if ($errors->has('is_video'))
                                <label for="title" class="error">{{ $errors->first('is_video') }}</label>
                                @endif
                            </div>
                        </div>

                        





                        <div class="form-group
                        @if($errors->has('testimonial'))
                            has-error
                        @endif
                        testmo ">
                            <label class="col-md-3 control-label" for="inputDefault">Testimonial <em>*</em></label>
                            <div class="col-md-6">
                                <textarea name="testimonial" id="ckeditor" maxlength=250 class="form-control" cols="30"
                                    rows="3">{{ isset($testimonial) ? $testimonial->testimonial : old('testimonial') }}</textarea>
                                <small>maximum 250 characters</small>
                                @if($errors->has('testimonial'))
                                <label for="testimonial" class="error">{{ $errors->first('testimonial') }}</label>
                                @endif
                            </div>
                        </div>



                        <div class="form-group video
            @if ($errors->has('link')) has-error @endif
           ">
                            <label class="col-md-3 control-label" for="inputDefault">Video Link </label>
                            <div class="col-md-6">
                                <input type="text" name="link" maxlength="60" class="form-control" id="Video"
                                    value="{{ isset($testimonial->link) ? $testimonial->link : old('link') }}">
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
                        @if($errors->has('original_file'))
                            has-error
                        @endif
                    ">
                            <label class="col-md-3 control-label" for="Testimonial Image"> Image </label>
                            <div class="col-md-6">
                                <input type="file" name="original_file" class="form-control" id="upload-file">
                                <input type="hidden" class="form-control" id="rem-file" name="remove">
                                <input type="hidden" name="thumbnail" class="form-control" id="image_props" value="">
                                {{-- <div class="error">{{ $errors->first('thumbnail') }}
                                    {{ $errors->first('original_file') }}
                                </div> --}}
                                <small>file format should be .jpg/jpeg/png with < 1mb better dimensions is 142×175
                                        px</small> @if($errors->has('original_file'))
                                        <label for="name" class="error">{{ $errors->first('original_file') }}</label>
                                        @endif
                                        @if(isset($testimonial->photo))
                                        <div style="margin-top: 10px;" id="rem">
                                            @if($testimonial->photo)
                                            <button type="button" class="col-md-12 close remove-file"
                                                aria-label="Close">
                                                <i class="far fa-window-close fa-2x"></i>
                                            </button>

                                            @endif
                                            <img src="{{ asset('storage/app/public/testimonial/'. $testimonial->photo ) }}"
                                                alt="" class="img" width="100">

                                        </div>
                                        @endif
                            </div>
                        </div>
                        @if(isset($testimonial)) @if($testimonial->file!='') {{--
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4"> --}} {{-- </div>
                        </div> --}} @endif @endif
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
                <button type="button" class="close cancel" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
{{--
<script src="{{asset('admin/assets/vendor/ckeditor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('admin/assets/vendor/ckeditor/ckeditor/adapters/jquery.js')}}"></script> --}}

<script src="{{ asset('admin/assets/vendor/cropperjs/cropper.js') }}"></script>


<script>
    $(document).ready(function () {
        $('#date').datepicker({
            format: "dd/mm/yyyy"
        }).on('change', function () {
            $('.datepicker').hide();
        });

    });
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

            if (files[0].size / 1024 / 1024 > 1) {
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
                aspectRatio: 142 / 175,
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

    // function removeFile() {

    //     var img_id = $('#demo').val();

    //     $.ajax({
    //         type: "delete",
    //         url: "{{ route('admin.testimonial.deleteimg') }}",
    //         data: {
    //             "id": img_id
    //         },
    //     }).done(function (msg) {
    //         location.reload();
    //     });

    // }

    $('.remove-file').on('click', removeFile);

    $(function () {
        $('#ckeditor').ckeditor({
            toolbar: 'Full',
            enterMode: CKEDITOR.ENTER_BR,
            shiftEnterMode: CKEDITOR.ENTER_P
        });
    });



        function removeFile() {

          var img_id = $('#demo').val();

            $.ajax({
              type: "delete",
              url: "{{ route('admin.testimonial.deleteimg') }}",
              data:{"id" : img_id} ,
            }).done(function( msg ) {
             location.reload();
            });    

       }

        $('.remove-file').on('click', removeFile);



    function onVideocheck() {
    var status = ($('input[name=is_video]:checked').val());
    if (status == null) {
      $(".testmo").addClass("hide");
      $(".video").addClass("hide");
    }
    if (status == 1) {
      $(".video").removeClass("hide");
      $(".testmo").addClass("hide");
    } else if (status == 0) {
      
      $(".testmo").removeClass("hide");
      $( ".video").addClass("hide");
    }


  }
  onVideocheck()
  $('.radiobutton').change(onVideocheck);



</script>










@endsection