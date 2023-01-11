@extends('layouts.main')
@section('title', 'Contact Us')
@section('css')
    <style>
        .hide {
            display: none;
        }

        label.error {
            font-size: 12px;
            color: red;
            margin-bottom: 0;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
@section('content')
    <section class="inner-banner">
        <div class="caption-wrapper">
            <div class="container">
                <div class="caption">
                    <h1>Contact Us</h1>
                </div>
            </div>
        </div>
        <div class="banner-bg">
            <picture>
                @if (isset($page->large_image))
                    <img src="{{ asset('storage/app/public/page/' . $page->large_image) }}" alt="Image Caption">
                @else
                    <img src="{{ asset('assets/img/banner/default-banner.jpg') }}" alt="Image Caption">
                @endif
            </picture>
        </div>
        <div class="banner-log">
            <img src="{{ asset('assets/img/label-icons/holy-cross.svg') }}" alt="Holy Cross">
        </div>
    </section>
    <nav class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('index') }}">Home</a>
                        </li>
                        <li>Contact Us</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <section class="news-and-events">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-area">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="contact-information">
                                    <h2 class="title-sm">Contact Information</h2>
                                    <div class="contact-details">
                                        <i class="fa-regular fa-location-dot"></i> Good Shepherd Major Seminary,
                                        <br>Kunnoth, Kiliyanthara P.O,
                                        <br>Kannur, Kerala, India
                                        <br>670 706
                                    </div>
                                    <div class="contact-details">
                                        <a href="tel:0091 0 490 2493850">
                                            <i class="fa-sharp fa-solid fa-phone-office"></i>0091-(0)490-2493850
                                        </a>
                                    </div>
                                    <div class="contact-details">
                                        <a href="tel:0091 9447547866">
                                            <i class="fas fa-mobile-alt"></i>0091-9447547866
                                        </a>
                                    </div>
                                    <div class="contact-details">
                                        <a href="mailto:gshepherdkunnoth@yahoo.com">
                                            <i class="fa-regular fa-envelope"></i>gshepherdkunnoth@yahoo.com
                                        </a>
                                    </div>
                                    <ul class="ct-social-media">
                                        <li>
                                            <a href="#" target="_blank">
                                                <i class="fa-brands fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <i class="fa-brands fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <i class="fa-brands fa-linkedin"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <i class="fa-brands fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-form">
                                    <h2 class="title-sm">Get In Touch</h2>
                                      <form method="post" action="{{route('contact-us.send')}}" id="contact-form">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input type="email" class="form-control" id="email" name ="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="phoneNumber" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="phoneNumber" name="phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="message" class="form-label">Message</label>
                                            <textarea class="form-control" id="message" name="message" rows="5"></textarea>
                                        </div>
                                        <div class="form-group mt-3">
                                            {{-- <button type="submit" class="btn btn-primary">SUBMIT</button> --}}
                                        
                                            <button type="button" class="btn btn-primary g-recaptcha"
                                            id="submit-button" data-sitekey="{{ config('captcha.sitekey') }}"
                                            data-callback='onSubmit'>Submit<img id="loading-image"
                                                class="loader-gif hide"
                                                src="{{ asset('assets/img/loading/ajax-loader.gif') }}"
                                                style="width: 20px" /></button>

                                          </div>

                                          <div class="alert alert-success alert-dismissible fade hide mt-3" role="alert">
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="location">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.4186614789683!2d75.7002498152653!3d12.014672438400757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba434d75689b5b9%3A0xa61eade0043c38b9!2sGood%20Shepherd%20Major%20Seminary!5e0!3m2!1sen!2sin!4v1669980314741!5m2!1sen!2sin"
                                        style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  }
  var token;
  var is_from_loading = false;

  function onSubmit(g_token) {
    token = g_token
    var submit_btn = $("#contact-form").find('#submit-button');
    $("#contact-form").trigger("submit");
    grecaptcha.reset()
  }
  $("#contact-form").validate({
    rules: {
      name: "required",

      email: {
        email: true
      },
      phone: {
        required: true,
        number: true,
        minlength: 10
      },
      message: {
        required: true
      }
    },
    messages: {
      name: {
        required: "Name field is required"
      },
      phone: {
        required: "Phone number field is required",
        number: "Please enter a valid phone number",
        minlength: "Please enter minimum 10 digits"
      },
      email: {
        email: "Please enter valid email address"
      },
      message: {
        required: "Message field is required"

      }
    },
    submitHandler: function (form) {
      if (is_from_loading)
        return false;
      is_from_loading = true;
      var submit_btn = $("#contact-form").find('#submit-button');
      var successMessageContainers = $("#contact-form").find('.alert-success');
      var warningMessageContainers = $("#contact-form").find('.alert-warning');
      submit_btn.attr('disabled', 'disabled');
      submit_btn.find('span').removeClass('hide');
      var form_data = $('[name!=g-recaptcha-response]', "#contact-form").serialize();
      form_data += '&g-recaptcha-response=' + token

      var url = $("#contact-form").attr('action');
      $.ajax({
        type: "POST",
        url: url,
        data: form_data,
        beforeSend: function () {
          $("#loading-image").show();
        },
        success: function () {
          is_from_loading = false
          $("#contact-form").trigger("reset");
          $("#loading-image").hide();
          successMessageContainers.removeClass('hide');
          successMessageContainers.addClass('show');
          submit_btn.removeAttr('disabled')
          submit_btn.find('span').addClass('hide');
        },
      }).fail(function () {
        is_from_loading = false
        $("#loading-image").hide();
        warningMessageContainers.removeClass('hide');
        warningMessageContainers.addClass('show');
        setTimeout(function () {
          warningMessageContainers.removeClass('show')
          warningMessageContainers.addClass('hide')
        }, 3000)
        submit_btn.removeAttr('disabled')
        submit_btn.find('span').addClass('hide');
      });
    }
  });

</script>

<script>
  $("#closemsg").click(function () {
    $('.alert-success').addClass('hide');
  })
</script>
@endsection
