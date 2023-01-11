@extends('layouts.main')
@section('title', 'Testimonial')


@section('css')
<style>
  .warn_txt_clr {
      font-size: 12px;
      color: #fd3f3f;
  }
  .alert-dismissible .close {
      position: absolute;
      top: 0;
      right: 0;
      padding: 6px;
      color: inherit;
  }

  .hide {
      display: none;
  }

  .show {
      display: block;
  }

  label.error {
      font-size: 12px;
      color: #fd3f3f;
      width: 100%;
      text-align: left;
      margin-top: -10px;

  }
</style>
@endsection



@section('content')

<div class="page-banner">

  @if (isset($page->large_image))
  <img src="{{ asset('storage/app/public/page/' . $page->large_image) }}" alt="Image Caption">
  @else
  <img src="{{ asset('assets/img/banner/default-banner.jpg') }}" alt="Image Caption">
  @endif

</div>
<div class="page-path">
  <div class="container">
    <div class="row">
      <div class="col-12">
      <ul>
          <li>
            <a href="{{route('index')}}">Home</a>
          </li>
          <li>Testimonials</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="theme-title title-center">
          <h6>Client Testimonials</h6>
          <h1>What our Guests Say</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="page-wrap page-testimonial">
  <div class="container">
    <div class="row">
      <div class="col-md-12 intro-txt">
        <p>Sharing the words and videos of customers who have already experienced crystal suites.</p>
        <a href="{{route('video-gallery')}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#guestBook">
          <span>Write in Guest Book</span>
        </a>
      </div>
    </div>
    <div class="row">

      @foreach($testimonials as $testimonial)

        @if($testimonial->is_video==1)

          <div class="col-md-6 d-flex">
            <div class="card">
              <div class="card-body">
                <a href="https://www.youtube.com/watch?v={{ $testimonial->link }}" data-fancybox>
                  <img src="https://img.youtube.com/vi/{{ $testimonial->link }}/hqdefault.jpg" alt="">
                  <div class="overlay">
                    <i class="icon-play"></i>
                  </div>
                </a>
              </div>
            </div>
          </div>
        @else



          <div class="col-md-6 d-flex">
            <div class="card">
              <div class="card-body">
                <p>{{$testimonial->testimonial}}</p>
              </div>
              <div class="card-footer">

              @if($testimonial->large_image))
              <img src="{{ asset('storage/app/public/testimonial/' . $testimonial->large_image) }}" alt="">
              @else
              <img src="{{ asset('assets/img/default-img/testimonial-default.jpg') }}" alt="Image Caption">
              @endif
                <h6>{{$testimonial->name}}</h6>
              </div>
            </div>
          </div>

        @endif


      @endforeach
      @if (empty($testimonial))
          Sorry! Currently, we don't have any updates. Please check back later
      @endif
      <div class="d-flex justify-content-center mt-4">
          {!! $testimonials->links() !!}
      </div>



    </div>
  </div>
</section><!-- Modal -->
<div class="modal fade" id="guestBook" tabindex="-1" aria-labelledby="guestBookLabel" aria-hidden="true">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="guestBookLabel">Write in Guest Book</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>



      <form method="post" action="{{route('testimonial.send')}}" id="testimonial-form">
          @csrf


        <div class="modal-body">
          <div class="row g-3">

            <div class="col-12">
              <label class="form-label">Your Name*</label>
              <input type="text" class="form-control" name="name" maxlength="90">
            </div>
            <div class="col-12">
              <label class="form-label">Your Message*</label>
              <textarea rows="5" class="form-control" name="testimonial" maxlength="250"></textarea>
            </div>




            <div class="col-12">
              <label class="form-label">Upload Your Image</label>
              <input type="file" class="form-control" name="photo">
              <div class="form-text">File format should be .jpg/jpeg/png/ with size less than 1mb, better dimensions is
                120 X 120 px</div>
            </div>


            <div id='recaptcha' class="g-recaptcha" data-sitekey="{{config('captcha.sitekey')}}"
                  data-size="invisible">
              </div>


          </div>
        </div>
        <div class="modal-footer">

            <button type="submit" id="submit-button" class="btn btn-primary">Submit
            <span class="spinner loading hide">
              <i class="fa fa-spinner fa-pulse"></i>
          </span>
          </button>

        </div>

        <div class="alert alert-success alert-dismissible fade hide" role="alert">
          Thank you for your interest, we will get in touch with you soon
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="alert alert-warning alert-dismissible fade hide" role="alert">
          Something went wrong please try again later
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
      </form>



      </div>
    </div>



   



    
</div>
@endsection



@section('js')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
<script>
  $("#closemsg").click(function(){
  $('.alert-success').addClass('hide');
  $('.alert-success').removeClass('show');

  
  
})
  </script>
<script>

  $(document).ready(function () {
      $("#testimonial-form").validate({
          rules: {
              name: "required",
              message: "required",
              // designation:"required",
              testimonial:"required",
              resume: {
                  required: false,
                  extension: "jpg | jpeg| png"
              }
          },
          messages: {
              name: {
                  required: "Name field is required."
              },
              testimonial: {
                  required: "Testimonial field is required."
              },
              resume: {
                  extension: "Invalid file format."
              }
              
              // designation:{
              //   required:"Designation field is required."
              // },
          },
          
          submitHandler: function (form) {
              var submit_btn = $("#testimonial-form").find('#submit-button');
              var successMessageContainers = $("#testimonial-form").find('.alert-success');
              var warningMessageContainers = $("#testimonial-form").find('.alert-warning');

              submit_btn.attr('disabled', 'disabled');
              submit_btn.find('span').removeClass('hide');
              var $imageFile=$("#testimonial-form").find("#cust");
              var captcaha = grecaptcha.execute().then(function (token) {
              var form_data = $("#testimonial-form").serialize();
              var url = $("#testimonial-form").attr('action');

              var form_data = new FormData($(form)[0]);
              $.ajax({
                  type: "POST",
                  url: url,
                  data: form_data,
                  processData: false,
                  contentType: false,
                  success: function () {
                      $("#testimonial-form").trigger("reset");
                      successMessageContainers.removeClass('hide');
                      successMessageContainers.addClass('show');
                      $imageFile.html('Choose file'); 


                      submit_btn.removeAttr('disabled')
                      submit_btn.find('span').addClass('hide');
                  },
              }).fail(function () {
                  warningMessageContainers.removeClass('hide');
                  warningMessageContainers.addClass('show');

                  setTimeout(function () {
                      warningMessageContainers.removeClass('show')
                      warningMessageContainers.addClass('hide')
                  }, 5000);

                  submit_btn.removeAttr('disabled')
                  submit_btn.find('span').addClass('hide');
              });
              });
          }
      });
  });


var upload_file = $('#resume'); //actual file upload id
upload_file.on('change input', function (e) {
var files = e.target.files;
var fileInput = document.getElementById('resume');
var filePath = fileInput.value;
var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
if (files[0].size / 920 / 1280 > 1 && allowedExtensions.exec(filePath)) {
    alert("File size exceeded")
    $('#resume').val('');
 
}
if(!allowedExtensions.exec(filePath)){
    alert('Please upload file having extensions .jpg/.jpeg/.png only.');
    $('#resume').val('');
 
}
});
//modal close event
$('#exampleModal1').on('hidden.bs.modal', function (e) {
  // do something...
  successMessageContainers = $("#testimonial-form").find('.alert-success');
  successMessageContainers.addClass('hide');
  successMessageContainers.removeClass('show');
  $("#testimonial-form").trigger("reset");
})
</script>
@endsection