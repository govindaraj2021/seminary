@extends('admin.layouts.main') @if(isset($updating) && $updating) 
@section('title', 'Update User') @else 
@section('title',
'Add User') @endif 
@section('styles')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/cropperjs/cropper.css') }}">
@endsection
 
@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">@if(isset($updating) && $updating) Update User @else Add User @endif
                </h2>
            </header>
            @if(isset($updating) && $updating)
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT') @else
                <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                    @endif @csrf
                    <div class="panel-body">


                        <div class="form-group
                            @if($errors->has('usergroup'))
                                has-error
                            @endif
                        ">
                            <label class="col-md-3 control-label" for="inputDefault">User Group Name</label>
                            <div class="col-md-6">
                                <select class="form-control mb-md" name="usergroup" @if(isset($updating) && $updating) style="pointer-events: none;background-color: #eeeeee;" @endif>
                                    @foreach ($usergroups as $usergroup)
                                        <option value="{{$usergroup->id}}"
                                            @if(isset($user) && $user->user_group_id == $usergroup->id)
                                            {{'selected'}}
                                          @endif
                                          {{-- {{ (old("usergroup") == $usergroup->id ? "selected":"") }} --}}
                                        >{{$usergroup->name}}</option>
                                    @endforeach
                                </select> @if($errors->has('usergroup'))
                                <label for="usergroup" class="error">{{ $errors->first('usergroup') }}</label> @endif
                            </div>
                        </div>

                        <div class="form-group
                            @if($errors->has('name'))
                                has-error
                            @endif
                        ">
                            <label class="col-md-3 control-label" for="inputDefault">Username*</label>
                            <div class="col-md-6">
                                <input type="text" name="name" maxlength="60" class="form-control" id="Name" value="{{$user->name ?? old('name') }}" {{ isset($updating)
                                    && $updating ? 'disabled' : '' }}>
                                <small>max length is 60.</small> @if($errors->has('name'))
                                <label for="name" class="error">{{ $errors->first('name') }}</label> @endif

                                <input type="hidden" id="profile"  name="profile"  value="Yes">
                            </div>
                        </div>
                        <div class="form-group
                        @if($errors->has('person_name'))
                            has-error
                        @endif
                    ">
                        <label class="col-md-3 control-label" for="inputDefault">Full Name*</label>
                        <div class="col-md-6">
                            <input type="text" name="person_name" maxlength="50" class="form-control" id="person_name" value="{{$user->person_name ?? old('person_name') }}">
                            <small>max 50 characters</small> @if($errors->has('person_name'))
                            <label for="person_name" class="error">{{ $errors->first('person_name') }}</label> @endif
                        </div>
                    </div>

                        <div class="form-group
                            @if($errors->has('phone'))
                                has-error
                            @endif
                        ">
                            <label class="col-md-3 control-label" for="inputDefault">Phone*</label>
                            <div class="col-md-6">
                                <input id="phone" maxlength="15" name="phone" placeholder="(123) 123-1234" class="form-control" value="{{$user->phone ?? old('phone') }}">                                {{-- <input type="number" name="phone" class="form-control" id="phone" value="{{$user->phone ?? old('phone') }}">                                --}} @if($errors->has('phone'))

                                <label for="phone" class="error">{{ $errors->first('phone') }}</label> @endif
                            </div>
                        </div>
                        <div class="form-group
                            @if($errors->has('email'))
                                has-error
                            @endif
                        ">
                            <label class="col-md-3 control-label" for="inputDefault">Email*</label>
                            <div class="col-md-6">
                                <input type="text" name="email" class="form-control" id="email" value="{{$user->email ?? old('email') }}">                                @if($errors->has('email'))
                                <label for="email" class="error">{{ $errors->first('email') }}</label> @endif
                            </div>
                        </div>
                        <div class="form-group
                            @if($errors->has('password'))
                                has-error
                            @endif
                        ">
                            <label class="col-md-3 control-label" for="inputDefault">Password*</label>
                            <div class="col-md-6">
                                <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">                                @if($errors->has('password'))
                                <label for="password" class="error">{{ $errors->first('password') }}</label> @endif
                            </div>
                        </div>
                        <div class="form-group
                                        @if($errors->has('image'))
                                            has-error
                                        @endif
                                    ">
                            <label class="col-md-3 control-label" for="inputDefault">Image*</label>
                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control" id="icon" value="{{$user->image ?? old('image') }}">
                                <input type="hidden" name="image_props" class="form-control" id="image_props" value="{{$user->image ?? old('image') }}">
                                <small>file format should be .jpg/jpeg/png with < 1mb better dimensions is 60x60 px</small> @if($errors->has('image'))
                                <label for="image" class="error">{{ $errors->first('image') }}</label> @endif @if(isset($user->icon))
                                <div style="margin-top: 10px;">
                                    <img src="{{ asset('storage/app/public/profile/'.$user->icon) }}" alt="" class="img" width="100">
                                </div>
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
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Crop the image</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
<script src="{{ asset('admin/assets/vendor/cropperjs/cropper.js') }}"></script>
<script>
    window.addEventListener('DOMContentLoaded', function () {
      var thumbnail = document.getElementById('image_props'); // hiiden file id
      var image = document.getElementById('image'); //model image id 
      var upload_file = $('#icon'); //actual file upload id
      var $modal = $('#modal'); //model id
      var cropper;


      upload_file.on('change input', function (e) {
        var files = e.target.files;
        var fileInput = document.getElementById('icon');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        if(files[0].size/1024/1024>1){
          alert("File size exceeded")
                $('#icon').val('');
                $('#thumbnail').val('');
        }

        if (!allowedExtensions.exec(filePath)) {
          alert('Please upload file having extensions .jpeg/.jpg/.png only.');
          $('#icon').val('');
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
          aspectRatio: 60 / 60,
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
@endsection