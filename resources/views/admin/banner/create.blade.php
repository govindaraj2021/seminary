@extends('admin.layouts.main') @if (isset($updating) && $updating)
    @section('title', 'Update Banner')
@else
    @section('title', 'Add Banner')
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

                        <a class="mb-xs mt-xs mr-xs btn btn-primary" href="{{ route('admin.banner.index') }}">List All</a>
                    </div>
                    <h2 class="panel-title">
                        @if (isset($updating) && $updating)
                            Update Banner
                        @else
                            Add Banner
                        @endif
                    </h2>
                </header>
                @if (isset($updating) && $updating)
                    <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                @endif @csrf
                <div class="panel-body">

                    <div
                        class="form-group
                            @if ($errors->has('name')) has-error @endif
                        ">
                        <label class="col-md-3 control-label" for="inputDefault">Title *</label>
                        <div class="col-md-6">
                            {{-- <textarea name="name" id="ckeditor" class="form-control" cols="30"
                                    rows="3" maxlength="500">{{ $banner->name ?? old('name') }}</textarea> --}}
                            <input type="text" name="name" maxlength="60" class="form-control" id="title"
                                value="{{ isset($banner) ? $banner->name : old('title') }}">
                            <small> Max length 60</small>
                            @if ($errors->has('name'))
                                <br><label for="title" class="error">{{ $errors->first('name') }}</label>
                            @endif
                        </div>
                    </div>

                    <div
                        class="form-group
                            @if ($errors->has('original_file')) has-error @endif
                        ">
                        <label class="col-md-3 control-label" for="inputDefault">Banner Image*</label>
                        <div class="col-md-6">


                            <input name='original_file' type='file' id='upload-file' class="form-control"
                                value="{{ isset($banner->large_image) ? $banner->large_image : old('large_image') }}">
                            <input type="hidden" name="image_props" id="image_props"
                                value=" {{ isset($banner->large_image) ? $banner->large_image : old('large_image') }}">
                            <small>file format should be .jpg/jpeg/png with < 2mb better dimensions is 1920 X 1080</small>
                                    @if ($errors->has('original_file'))
                                        <label for="large_image"
                                            class="error">{{ $errors->first('original_file') }}</label>
                                        @endif @if (isset($banner->large_image))
                                            <div style="margin-top: 10px;">
                                                <img src="{{ asset('storage/app/public/banner/' . $banner->large_image) }}"
                                                    alt="" class="img" width="100">
                                            </div>
                                        @endif {{-- @endif @if ($errors->has('large_image'))
                                <label for="Banner image Error" class="error">{{ $errors->first('large_image') }}</label> @endif --}}

                        </div>
                    </div>

                    <div
                        class="form-group
                            @if ($errors->has('original_file')) has-error @endif
                        ">
                        <label class="col-md-3 control-label" for="inputDefault">Mobile Banner Image*</label>
                        <div class="col-md-6">


                            <input name='original_file_mobile' type='file' id='upload-photo' class="form-control"
                                value="{{ isset($banner->large_image_mobile) ? $banner->large_image : old('large_image') }}">
                            <input type="hidden" name="image_props_mobile" id="image_props_mobile"
                                value=" {{ isset($banner->large_image_mobile) ? $banner->large_image_mobile : old('large_image_mobile') }}">
                            <small>file format should be .jpg/jpeg/png with < 2mb better dimensions is 375X700</small>
                                    @if ($errors->has('original_file_mobile'))
                                        <label for="large_image"
                                            class="error">{{ $errors->first('original_file_mobile') }}</label>
                                        @endif @if (isset($banner->large_image_mobile))
                                            <div style="margin-top: 10px;">
                                                <img src="{{ asset('storage/app/public/banner/' . $banner->large_image_mobile) }}"
                                                    alt="" class="img" width="100">
                                            </div>
                                        @endif {{-- @endif @if ($errors->has('large_image_mobile'))
                                <label for="Banner image Error" class="error">{{ $errors->first('large_image_mobile') }}</label> @endif --}}

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


    <div class="modal fade" id="modl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Crop the image</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crp">Crop</button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="imge" src="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/assets/vendor/cropperjs/cropper.js') }}"></script>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var thumbnail = document.getElementById('image_props'); // hiiden file id
            var image = document.getElementById('image'); //model image id 
            var upload_file = $('#upload-file'); //actual file upload id
            var $modal = $('#modal'); //model id
            var cropper;
            var cancel = $('.cancel');
            cancel.on('click', function() {
                upload_file.val('');
            })

            upload_file.on('change input', function(e) {
                var files = e.target.files;
                var fileInput = document.getElementById('upload-file');
                var filePath = fileInput.value;
                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (files[0].size / 1024 / 1024 > 2 && allowedExtensions.exec(filePath)) {
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
                    aspectRatio: 1920/1080,
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

        // case study img cropper
        var thumbnil = document.getElementById('image_props_mobile'); // hiiden file id
        var imge = document.getElementById('imge'); //model image id 
        var uplod_file = $('#upload-photo'); //actual file upload id
        var $modl = $('#modl'); //model id
        var crpper;


        uplod_file.on('change input', function(e) {
            var files = e.target.files;
            //
            var files = e.target.files;
            var fileInput = document.getElementById('upload-photo');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (files[0].size / 1024 / 1024 > 2 && allowedExtensions.exec(filePath)) {
                alert("File size exceeded")
                $('#upload-photo').val('');
                $('#thumbnail').val('');
            }
            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload file having extensions .jpeg/.jpg/.png only.');
                $('#upload-photo').val('');
                $('#thumbnail').val('');
            }
            //
            var done = function(url) {
                uplod_file.value = '';
                imge.src = url;
                $modl.modal('show');
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

        $modl.on('shown.bs.modal', function() {
            crpper = new Cropper(imge, {
                aspectRatio: 375 / 700,
                viewMode: 2,
            });
        }).on('hidden.bs.modal', function() {
            crpper.destroy();
            crpper = null;
        });

        document.getElementById('crp').addEventListener('click', function() {
            var initialAvatarURL;
            var canvas;

            $modl.modal('hide');

            // if (cropper) {
            //   canvas = cropper.getCroppedCanvas({
            //     height: 600,
            //     width: 800,
            //   });
            thumbnil.value = JSON.stringify(crpper.getData());



            // thumbnail.value = canvas.toDataURL();
            // }
        });

        // });
    </script>
@endsection
