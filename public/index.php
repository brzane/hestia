<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="icon" id="icon" href="">
  <!-- Fontawesome -->
  <link href="assets/vendor/fontawesome/font-awesome.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="assets/vendor/bootstrap/bootstrap.css" rel="stylesheet">
  <!-- Slick slider -->
  <link rel="stylesheet" type="text/css" href="assets/vendor/slick/slick.css">
  <!-- Date Picker -->
  <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/bootstrap-datepicker.css">
  <!-- Bootsrap Select -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap-select.min.css">
  <link rel="stylesheet" href="assets/vendor/jquery/jquery.timepicker.min.css">
  <!-- Theme color -->
  <link href="assets/css/theme-color/default-theme.css" id="theme_switch" rel="stylesheet">
  <!-- Main style sheet -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- Pre Loader -->
  <div id="aa-preloader-area">
    <div class="mu-preloader">
      <img src="assets/img/hourglass.gif" alt=" loader img">
    </div>
  </div>
  <!--START SCROLL TOP BUTTON -->
  <a class="scrollToTop" href="#">
    <i class="fa fa-angle-up"></i>
  </a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header section -->
  <header id="mu-header">
    <nav class="navbar navbar-default mu-main-navbar" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO -->
          <a class="navbar-brand" href="index.html"><img id="logo" src="" alt="Logo img"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav navbar-right mu-main-nav">
            <li><a href="#mu-slider">HOME</a></li>
            <li><a href="#mu-about-us">ABOUT US</a></li>
            <li><a href="#mu-restaurant-menu">MENU</a></li>
            <li><a href="#mu-reservation">RESERVATION</a></li>
            <li><a href="#mu-client-testimonial">TESTIMONIAL</a></li>
            <li><a href="#mu-contact">CONTACT</a></li>
            </li>
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>
  </header>
  <!-- End header section -->


  <!-- Start slider  -->
  <section id="mu-slider">
    <div class="mu-slider-area">
      <!-- Top slider -->
      <div class="mu-top-slider">
        <!-- Top slider single slide -->
        <div class="mu-top-slider-single">
          <img id="header1" src="" alt="img">
          <!-- Top slider content -->
          <div class="mu-top-slider-content">
            <span class="mu-slider-small-title">Welcome</span>
            <h2 class="mu-slider-title"></h2>
            <p id="restaurant_slogan"> </p>
          </div>
          <!-- / Top slider content -->
        </div>
        <!-- / Top slider single slide -->
        <!-- Top slider single slide -->
        <div class="mu-top-slider-single">
          <img id="header2" src="" alt="img">
          <!-- Top slider content -->
          <div class="mu-top-slider-content">
            <span class="mu-slider-small-title">Welcome</span>
            <h2 class="mu-slider-title"></h2>
            <p id="restaurant_slogan"> </p>
          </div>
          <!-- / Top slider content -->
        </div>
        <!-- / Top slider single slide -->
        <!-- Top slider single slide -->
        <div class="mu-top-slider-single">
          <img id="header3" src="" alt="img">
          <!-- Top slider content -->
          <div class="mu-top-slider-content">
            <span class="mu-slider-small-title">Welcome</span>
            <h2 class="mu-slider-title"></h2>
            <p id="restaurant_slogan"> </p>
          </div>
          <!-- / Top slider content -->
        </div>
        <!-- / Top slider single slide -->
      </div>
    </div>
  </section>
  <!-- End slider  -->

  <!-- Start About us -->
  <section id="mu-about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-about-us-area">
            <div class="mu-title">
              <span class="mu-subtitle">Discover</span>
              <h2>ABOUT US</h2>
              <i class="fa fa-spoon"></i>
              <span class="mu-title-bar"></span>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mu-about-us-left">
                  <p id="about-us-text"></p>
                  <ul>
                    <li>Fancy Restaurant With The Best Profissonal Chefs. </li>
                    <li>"If It Isn't Fresh Don't Serve It" That's Our Promise.</li>
                    <li>Great Place To Impress Your Date.</li>
                  </ul>

                </div>
              </div>
              <div class="col-md-6">
                <div class="mu-about-us-right">
                  <ul class="mu-abtus-slider">
                    <li><img id="about_picture" src="" alt="img"></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End About us -->


  <!-- Start Restaurant Menu -->
  <section id="mu-restaurant-menu">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-restaurant-menu-area">
            <div class="mu-title">
              <span class="mu-subtitle">Discover</span>
              <h2>OUR MENU</h2>
              <i class="fa fa-spoon"></i>
              <span class="mu-title-bar"></span>
            </div>
            <div class="mu-restaurant-menu-content">
              <ul class="nav nav-tabs mu-restaurant-menu">
                <li class="active"><a href="#meals" data-toggle="tab">Meals</a></li>
                <li><a href="#snacks" data-toggle="tab">Snacks</a></li>
                <li><a href="#drinks" data-toggle="tab">Drinks</a></li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">

                <div class="tab-pane fade in active  " id="meals">
                  <div class="mu-tab-content-area">
                    <div class="row">
                      <div class="mu-menu-item-nav" id="meals-list">

                      </div>

                    </div>
                  </div>
                </div>
                <div class="tab-pane fade " id="snacks">
                  <div class="mu-tab-content-area">
                    <div class="row">
                      <div class="mu-menu-item-nav" id="snacks-list">

                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade " id="drinks">
                  <div class="mu-tab-content-area">
                    <div class="row">
                      <div class="mu-menu-item-nav" id="drinks-list">

                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- End Restaurant Menu -->

  <!-- Start Reservation section -->
  <section id="mu-reservation">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-reservation-area">
            <div class="mu-title">
              <span class="mu-subtitle">Make A</span>
              <h2>Reservation</h2>
              <i class="fa fa-spoon"></i>
              <span class="mu-title-bar"></span>
            </div>
            <div class="mu-reservation-content">
              <div id="res_message"></div>
              <form method="POST" class="mu-reservation-form" id="reservationForm">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Name" required="required" name="res_name">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="number" class="form-control" placeholder="Phone No" required="required" name="res_phone">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" id="datepicker" placeholder="Date" required="required" name="res_date">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <select class="form-control selectpicker show-tick" title="How Many?" required="required" name="res_sets">
                        <option value="1">1 Person</option>
                        <option value="2">2 People</option>
                        <option value="3">3 People</option>
                        <option value="4">4 People</option>
                        <option value="5">5 People</option>
                        <option value="6">6 People</option>
                        <option value="7">7 People</option>
                        <option value="8">8 People</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" id="timepicker" placeholder="Time" required="required" name="res_time">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <br>
                  </div>
                  <button type="submit" class="mu-make-reservation-btn mu-readmore-btn">Make Reservation</button>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Reservation section -->


  <!-- Start Client Testimonial section -->
  <section id="mu-client-testimonial">
    <div class="mu-overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="mu-client-testimonial-area">
              <div class="mu-title">
                <span class="mu-subtitle">Testimonials</span>
                <h2>What Customers Say</h2>
                <i class="fa fa-spoon"></i>
                <span class="mu-title-bar"></span>
              </div>
              <!-- testimonial content -->
              <div class="mu-testimonial-content">
                <!-- testimonial slider -->
                <ul class="mu-testimonial-slider">
                  <li>
                    <div class="mu-testimonial-single">
                      <div class="mu-testimonial-info">
                        <p id="testimonial-1"></p>
                      </div>
                      <div class="mu-testimonial-bio">
                        <p id="customer_name1"></p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="mu-testimonial-single">
                      <div class="mu-testimonial-info">
                        <p id="testimonial-2"></p>
                      </div>
                      <div class="mu-testimonial-bio">
                        <p id="customer_name2"></p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="mu-testimonial-single">
                      <div class="mu-testimonial-info">
                        <p id="testimonial-3"></p>
                      </div>
                      <div class="mu-testimonial-bio">
                        <p id="customer_name3"></p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Client Testimonial section -->



  <!-- Start Contact section -->
  <section id="mu-contact">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-contact-area">
            <div class="mu-title">
              <span class="mu-subtitle">For Any Complaints</span>
              <h2>Contact Us</h2>
              <i class="fa fa-spoon"></i>
              <span class="mu-title-bar"></span>
            </div>
            <div class="mu-contact-content">
            <div id="contact_message"></div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mu-contact-left">
                    <form class="mu-contact-form" id="contactForm">
                      <div class="form-group" method="POST">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" required="required" name="name">
                      </div>
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" required="required" name="email">
                      </div>
                      <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" placeholder="Subject" required="required" name="subject">
                      </div>
                      <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" cols="30" rows="10" placeholder="Type Your Message" required="required" name="message"></textarea>
                      </div>
                      <button type="submit" class="mu-send-btn">Send Message</button>
                    </form>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mu-contact-right">
                    <div class="mu-contact-widget">
                      <h3>Restaurant Address</h3>
                      <address>
                        <p><i class="fa fa-phone"></i> (+963) <span id="phone_number"></span></p>
                        <p><i class="fa fa-envelope-o"></i><span id="restaurant_email"></span> </p>
                        <p><i class="fa fa-map-marker"></i><span id="restaurant_address"></span></p>
                      </address>
                    </div>
                    <div class="mu-contact-widget">
                      <h3>Open Hours</h3>
                      <address>
                        <p><span>Saturday - Thursday</span> <span id="from_to_time"></span> </p>
                        <p><span>Friday</span> Closed</p>
                      </address>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact section -->

  <!-- Start Footer -->
  <footer id="mu-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-footer-area">
            <div class="mu-footer-social">
              <a href="#" id="facebook_link"><span class="fa fa-facebook"></span></a>
              <a href="#" id="twitter_link"><span class="fa fa-twitter"></span></a>
              <a href="#" id="linked_in_link"><span class="fa fa-linkedin"></span></a>
            </div>
            <div class="mu-footer-copyright">
              <p>Designed by <a>Hestia.inc</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <!-- jQuery library -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/bootstrap.js"></script>
  <script src="assets/vendor/fontawesome/fontawesome.min.js"></script>
  <script src="assets/vendor/jquery/jquery.timepicker.min.js"></script>
  <!-- Slick slider -->
  <script type="text/javascript" src="assets/vendor/slick/slick.js"></script>
  <!-- Date Picker -->
  <script type="text/javascript" src="assets/vendor/bootstrap/bootstrap-datepicker.js"></script>
  <!-- bootstrap select-->
  <script src="assets/vendor/bootstrap/bootstrap-select.min.js"></script>
  <!-- Custom js -->
  <script src="assets/js/custom.js"></script>

</body>

</html>