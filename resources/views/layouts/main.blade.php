<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/plugins.min.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('assets/css/app.min.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('assets/css/icon.min.css')}}" media="all">
    <link rel="icon" href="{{asset('assets/img/favicon/favicon-16x16.png')}}">
    <script async src="{{asset('assets/js/modernizr.min.js')}}"></script>
    <title>

    @hasSection('title')
        @yield('title') | Major Seminary
    @else
        Major Seminary 
    @endif
    
    </title>
    <meta name="description" content="Good Shepherd Major Seminary">
    <meta property="og:url" content="http://majorseminary.org/">
    <meta property="og:type" content="website">
    <meta property="og:title"
        content="Good Shepherd Major Seminary is the third major seminary of the Syro-Malabar Church. It was canonically erected at Kunnoth, Iritty, North Kerala, India, by the Synod of the Church on 1st September 2000 (Synodal Decree no. 2336/2000).">
    <meta property="og:description" content="Good Shepherd Major Seminary">
    <meta property="og:image" content="https://demolocation.co.in/seminary/htmls/assets/img/og-image/og-image.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="alphonsatsy.com">
    <meta property="twitter:url" content="http://majorseminary.org/">
    <meta name="twitter:title"
        content="Good Shepherd Major Seminary is the third major seminary of the Syro-Malabar Church. It was canonically erected at Kunnoth, Iritty, North Kerala, India, by the Synod of the Church on 1st September 2000 (Synodal Decree no. 2336/2000).">
    <meta name="twitter:description" content="Good Shepherd Major Seminary">
    <meta name="twitter:image" content="https://demolocation.co.in/seminary/htmls/assets/img/og-image/og-image.jpg">

    @yield('css')
</head>

<body class="homepage">
    <header>
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-md-2">
                    <a href="{{route('index')}}" class="brand">
                        <img src="{{ asset('assets/img/logo/logo.svg') }}" alt="Good Shepherd Major Seminary">
                    </a>
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
                <div class="col-md-10">
                    <div class="top-menu">
                        <div class="brand-name">Good Shepherd Major Seminary Kunnoth</div>
                        <ul class="e-contact">
                            <li>
                                <a href="tel:009104902491095">
                                    <i class="fa-solid fa-phone"></i>0091-(0)490-2491095
                                </a>
                            </li>
                            <li>
                                <a href="maito:gshepherdkunnoth@yahoo.com">
                                    <i class="fa-solid fa-envelope"></i>gshepherdkunnoth@yahoo.com
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="main-menu">
                        <div class="overlay"></div>
                        <ul>
                            <li class="active">
                                <a href="{{route('index')}}">Home</a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">About Us</a>
                            </li>
                            <li class="dropdown">
                                <a href="{{route('page','#')}}">Administration</a>
                                <button type="button">
                                    <i class="fa-regular fa-chevron-down"></i>
                                </button>
                                <div class="mega-menu single-column">
                                    <div class="mega-sub-menu">
                                        <ul>
                                            <li>
                                                <a href="{{route('page','#')}}">Synodal Commission</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Staff</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Visiting Professors</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Former Staff</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="{{route('page','#')}}">Students</a>
                                <button type="button">
                                    <i class="fa-regular fa-chevron-down"></i>
                                </button>
                                <div class="mega-menu">
                                    <div class="mega-sub-menu">
                                        <h4>Theology</h4>
                                        <ul>
                                            <li>
                                                <a href="{{route('page','#')}}">Theology I</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Theology Ii</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Theology Iii</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Theology Iv</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mega-sub-menu single-column">
                                        <h4>Philosophy</h4>
                                        <ul>
                                            <li>
                                                <a href="{{route('page','#')}}">Philosophy I</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Philosophy Ii</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Philosophy Iii</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">Institute</a>
                            </li>
                            <li class="dropdown single-column">
                                <a href="{{route('page','#')}}">Activities</a>
                                <button type="button">
                                    <i class="fa-regular fa-chevron-down"></i>
                                </button>
                                <div class="mega-menu single-column">
                                    <div class="mega-sub-menu">
                                        <ul>
                                            <li>
                                                <a href="{{route('page','#')}}">Formation</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Arts & Sports</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Cultural Activities</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Social Ministry</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Jesus Fraternity</a>
                                            </li>
                                            <li>
                                                <a href="{{route('page','#')}}">Media Ministry</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">Publications</a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">News & Events</a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">Gallery</a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')


    <div class="cta-group share-option">
        <div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style">
            <ul>
                <li>
                    <a class="a2a_button_facebook" target="_blank"></a>
                </li>
                <li>
                    <a class="a2a_button_twitter" target="_blank"></a>
                </li>
                <li>
                    <a class="a2a_button_linkedin" target="_blank"></a>
                </li>
            </ul>
        </div>
        <button type="button" class="share-btn" title="Share">
            <i class="fa-solid fa-share"></i>
        </button>
    </div>
    <div class="cta-group whatsapp-backto-top" title="Whatsapp">
        <a href="https://wa.me/91000000000?text=Hello%20!" title="Whatsapp" target="_blank" class="btn-whatsapp">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <button type="button" class="btn-back-to-top back-to-top" title="Back to Top">
            <i class="fa-solid fa-chevron-up"></i>
        </button>
    </div>
    <ul class="click-to-connect">
        <li>
            <a href="tel:0091 0 490-2493850">
                <i class="fas fa-phone"></i>Click to Call
            </a>
        </li>
        <li>
            <a href="mailto:gshepherdkunnoth@yahoo.com">
                <i class="far fa-envelope"></i>Send Email
            </a>
        </li>
    </ul>
    <footer>
        <div class="container">
            <div class="row row-cols-md-5">
                <div class="col-md">
                    <div class="foot-items">
                        <h3>Quick Links</h3>
                        <ul class="footer-menu">
                            <li>
                                <a href="{{route('index')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Home
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>About Us
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Publications
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>News & Events
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Gallery
                                </a>
                            </li>
                            <li>
                                <a href="{{route('contact-us')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Contact Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="foot-items">
                        <h3>Activities</h3>
                        <ul class="footer-menu">
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Formation
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Arts & Sports
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Publications
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Cultural Activities
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Social Ministry
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Jesus Fraternity
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Media Ministry
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="foot-items">
                        <h3>Administration</h3>
                        <ul class="footer-menu">
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Synodal Commission
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Staff
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Visiting Professor
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Former Staff
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Social Ministry
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Jesus Fraternity
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Media Ministry
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="foot-items">
                        <h3>Students</h3>
                        <ul class="footer-menu">
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Theology
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Philosophy
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Alumni
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Former Staff
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Social Ministry
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Jesus Fraternity
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Media Ministry
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="foot-items">
                        <h3>Institute</h3>
                        <ul class="footer-menu">
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>History
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Governing Bodies
                                </a>
                            </li>
                            <li>
                                <a href="{{route('page','#')}}">
                                    <i class="fa-solid fa-chevrons-right"></i>Curriculum
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-line">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{route('page','#')}}" class="brand">
                            <img src="{{ asset('assets/img/logo/footer-logo.svg') }}"
                                alt="Good Shepherd Major Seminary">
                        </a>
                        <div class="foot-items">
                            <h3>Good Shepherd Major Seminary</h3>
                            <address>Kunnoth, Kiliyanthara P.O,
                                <br>PIN-670 706, Kannur,
                                <br>Kerala, S. India
                            </address>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="foot-items">
                            <h3>Good Shepherd Major Seminary</h3>
                            <div class="e-contact">
                                <h6>Phone:</h6>
                                <a hre="tel:009104902493850">0091-(0)490-2493850</a>
                            </div>
                            <div class="e-contact">
                                <h6>Mobile:</h6>
                                <a hre="tel:00919447547866">0091-9447547866</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="foot-items">
                            <h3>Email Us</h3>
                            <div class="e-contact">
                                <a hre="mailto:gshepherdkunnoth@yahoo.com">gshepherdkunnoth@yahoo.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="foot-items">
                            <h3>Connect Us</h3>
                            <ul class="social-media">
                                <li>
                                    <a href="{{route('page','#')}}" target="_blank">
                                        <i class="fa-brands fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('page','#')}}" target="_blank">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('page','#')}}" target="_blank">
                                        <i class="fa-brands fa-linkedin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('page','#')}}" target="_blank">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights-development">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>Copyright © 2022, Good Shepherd Major Seminary Kunnoth. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p>Website developed by <a href="{{route('page','#')}}" target="_blank">
                                <img src="{{ asset('assets/img/logo/sesame-tag.png') }}" alt="Sesame Technologies">
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>


    @yield('js')

    
</body>

</html>
