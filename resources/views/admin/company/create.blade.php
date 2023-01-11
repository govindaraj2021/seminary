@extends('admin.layouts.main') @if(isset($updating) && $updating) 
@section('title', 'Update Company') @else 
@section('title',
'Add Company') @endif 
@section('styles')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/cropperjs/cropper.css') }}">
@endsection
 
@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">@if(isset($updating) && $updating) Update Company @else Add Company @endif
                </h2>
            </header>
            @if(isset($updating) && $updating)
            <form action="{{ route('admin.company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT') @else
                <form action="{{ route('admin.company.store') }}" method="POST" enctype="multipart/form-data">
                    @endif @csrf
                    <div class="panel-body">

                        <div class="form-group
                            @if($errors->has('name'))
                                has-error
                            @endif
                        ">
                            <label class="col-md-3 control-label" for="inputDefault">Name</label>
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" id="Name" value="{{$company->name ?? old('name') }}">                                @if($errors->has('name'))
                                <label for="name" class="error">{{ $errors->first('name') }}</label> @endif
                            </div>
                        </div>

                        <div class="form-group
                            @if($errors->has('site'))
                                has-error
                            @endif
                        ">
                            <label class="col-md-3 control-label" for="inputDefault">Website(eg:-google.com) *</label>
                            <div class="col-md-6">
                                <input name="site" placeholder="eg:-google.com) *" class="form-control" value="{{$company->site ?? old('site') }}">                                {{-- <input type="number" name="phone" class="form-control" id="phone" value="{{$user->phone ?? old('phone') }}">                                --}} @if($errors->has('phone'))
                                <label for="phone" class="error">{{ $errors->first('site') }}</label> @endif
                            </div>
                        </div>
                        <div class="form-group
                            @if($errors->has('email'))
                                has-error
                            @endif
                        ">
                            <label class="col-md-3 control-label" for="inputDefault">Email</label>
                            <div class="col-md-6">
                                <input type="text" name="email" class="form-control" id="email" value="{{$company->email ?? old('email') }}">                                @if($errors->has('email'))
                                <label for="email" class="error">{{ $errors->first('email') }}</label> @endif
                            </div>
                        </div>
                        <div class="form-group
                            @if($errors->has('phone'))
                                has-error
                            @endif
                        ">
                            <label class="col-md-3 control-label" for="inputDefault">Phone</label>
                            <div class="col-md-6">
                                <input type="number" name="phone" class="form-control" value="{{$company->phone ?? old('password') }}">                                @if($errors->has('password'))
                                <label for="password" class="error">{{ $errors->first('password') }}</label> @endif
                            </div>
                        </div>

                        <div class="form-group
                            @if($errors->has('address'))
                                has-error
                            @endif
                        ">
                            <label class="col-md-3 control-label" for="inputDefault">Address</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="address" rows="5">{{$company->address ?? old('address') }}</textarea>                                @if($errors->has('address'))
                                <label for="address" class="error">{{ $errors->first('address') }}</label> @endif
                            </div>
                        </div>

                        <div class="form-group
                            @if($errors->has('image'))
                                has-error
                            @endif
                        ">
                            <label class="col-md-3 control-label" for="inputDefault">Image</label>
                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control" id="icon">
                                <input type="hidden" name="image_props" class="form-control" id="image_props">
                                <small>Recommended image dimension : 300x80</small> @if($errors->has('image'))
                                <label for="image" class="error">{{ $errors->first('image') }}</label> @endif @if(isset($company->logo))
                                <div style="margin-top: 10px;">
                                    <img src="{{ asset('storage/app/public/company/'.$company->logo) }}" alt="" class="img" width="100">
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
    <div class="modal-dialog">
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
    var _URL = window.URL || window.webkitURL;
    
    
    $('#icon').change(function() {
        var file, img;
        if ((file = this.files[0])) {
               img = new Image();
               img.onload = function() {
                  width = this.width;
                  height = this.height;
                //   if(width >= 200 && height >= 40)
                //   {
                      var f_size=this.files[0].size;
                    if(f_size <=300000){
                          var fileExtension = ['jpeg', 'jpg', 'png','JPEG', 'JPG', 'PNG'];
                          if (jQuery.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                              document.getElementById("icon").value="";//jQuery('#jobman-field-16').value="";
                              alert("Only '.jpeg','.jpg', '.png' formats are allowed.");
                          }
                        }else {
                              document.getElementById("icon").value="";
                              alert("File size exceeded")
                          }
                      
                //   }else{
                //       document.getElementById("icon").value="";
                //       alert("Image resolution donot exceed 200x40");
                //   }
               };
               img.onerror = function() {
                    document.getElementById("icon").value="";
                  alert( "Not a valid file: " + file.type);
               };
               img.src = _URL.createObjectURL(file);
        }
    })

</script>
@endsection