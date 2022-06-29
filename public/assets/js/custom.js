$(function ($) {
  /* CLEAR FORMS */
  $("#reservationForm")[0].reset();
  $("#contactForm")[0].reset();

  /* FIXED NAVBAR */

  $(window).bind("scroll", function () {
    if ($(window).scrollTop() > 200) {
      $(".mu-main-navbar").addClass("navbar-bg");
      $(".navbar-brand").addClass("navbar-brand-small");
    } else {
      $(".mu-main-navbar").removeClass("navbar-bg");
      $(".navbar-brand").removeClass("navbar-brand-small");
    }
  });

  /* TOP SLIDER (SLICK SLIDER)*/

  $(".mu-top-slider").slick({
    dots: false,
    infinite: true,
    arrows: true,
    speed: 500,
    autoplay: true,
    fade: true,
    cssEase: "linear",
  });

  /* DATEPICKER */
  $("#datepicker").datepicker({
    format: "yyyy-mm-dd",
  });
  $("#timepicker").timepicker();

  /*  6. TESTIMONIAL SLIDER (SLICK SLIDER)*/

  $(".mu-testimonial-slider").slick({
    dots: true,
    infinite: true,
    arrows: false,
    autoplay: true,
    speed: 500,
    cssEase: "linear",
  });

  /* MENU SMOOTH SCROLLING */

  // Cache selectors
  let lastId,
    topMenu = $(".mu-main-nav"),
    topMenuHeight = topMenu.outerHeight() + 13,
    // All list items
    menuItems = topMenu.find("a[href^=\\#]"),
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function () {
      let item = $($(this).attr("href"));
      if (item.length) {
        return item;
      }
    });

  // Bind click handler to menu items
  // so we can get a fancy scroll animation
  menuItems.click(function (e) {
    let href = $(this).attr("href"),
      offsetTop = href === "#" ? 0 : $(href).offset().top - topMenuHeight + 32;
    jQuery("html, body").stop().animate(
      {
        scrollTop: offsetTop,
      },
      1500
    );
    jQuery(".navbar-collapse").removeClass("in");
    e.preventDefault();
  });

  /* HOVER DROPDOWN MENU */
  $("ul.nav li.dropdown").hover(
    function () {
      $(this).find(".dropdown-menu").stop(true, true).delay(200).fadeIn(200);
    },
    function () {
      $(this).find(".dropdown-menu").stop(true, true).delay(200).fadeOut(200);
    }
  );

  /*  SCROLL TOP BUTTON */

  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $(".scrollToTop").fadeIn();
    } else {
      $(".scrollToTop").fadeOut();
    }
  });

  $(".scrollToTop").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 800);
    return false;
  });

  /* PRELOADER */

  $(window).load(function () {
    $("#aa-preloader-area").delay(300).fadeOut("slow");
  });

  /* GET DATA FROM DATABASE */
  $(document).ready(function () {
    $.ajax({
      url: "data.php",
      method: "POST",
      dataType: "json",
      data: {
        key: "getrestaurantdata",
      },
      success: function (response) {
        $("title").text(response.name);
        $(".mu-slider-title").text("To  " + response.name);
        $("#phone_number").text(response.phone);
        $("#restaurant_email").text(response.email);
        $("#restaurant_address").text(response.address);
        $("#from_to_time").text(
          response.from_time + "  To  " + response.to_time
        );
        $("#facebook_link").attr("href", response.facebook);
        $("#twitter_link").attr("href", response.twitter);
        $("#linked_in_link").attr("href", response.linked_in);
        $("#logo").attr("src", response.logo);
        $("#icon").attr("href", response.logo);
      },
    });

    $.ajax({
      url: "data.php",
      method: "POST",
      dataType: "json",
      data: {
        key: "getaboutdata",
      },
      success: function (response) {
        $("#theme_switch").attr(
          "href",
          "assets/css/theme-color/" + response.theme_color + "-theme.css"
        );
        $("#about-us-text").text(response.about_us);
        $("#about_picture").attr("src", response.about_picture);
      },
    });

    $.ajax({
      url: "data.php",
      method: "POST",
      dataType: "json",
      data: {
        key: "gettestimonialdata",
      },
      success: function (response) {
        $("#customer_name1").text("- " + response.data[0]["customer_name"]);
        $("#testimonial-1").text(response.data[0]["testimonial"]);
        $("#customer_name2").text("- " + response.data[1]["customer_name"]);
        $("#testimonial-2").text(response.data[1]["testimonial"]);
        $("#customer_name3").text("- " + response.data[2]["customer_name"]);
        $("#testimonial-3").text(response.data[2]["testimonial"]);
      },
      error: function (err) {
        console.log(err);
      },
    });
    $.ajax({
      url: "data.php",
      method: "POST",
      dataType: "json",
      data: {
        key: "getheaderdata",
      },
      success: function (response) {
        $("p[id='restaurant_slogan']").text(response.restaurant_slogan);
        $("#header1").attr("src", response.photo1);
        $("#header2").attr("src", response.photo2);
        $("#header3").attr("src", response.photo3);
      },
      error: function (err) {
        console.log(err);
      },
    });
  });

  $.ajax({
    url: "data.php",
    method: "POST",
    dataType: "json",
    data: {
      key: "getmenudata",
    },
    success: function (response) {
      $("#meals-list").append(response.meals);
      $("#drinks-list").append(response.drinks);
      $("#snacks-list").append(response.snacks);
    },
  });
  /* Send RESERVATION DATA  */
  $("#reservationForm").on("submit", (e) => {
    e.preventDefault();
    let form = $("#reservationForm")[0];
    $.ajax({
      url: "data.php",
      method: "POST",
      data: new FormData(form),
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {
        form.reset();
        $("#res_message").html("").fadeIn();
        $("#res_message")
          .html(
            '<div class="alert alert-success">The Reservation Has been Sent</div>'
          )
          .fadeOut(4000);
      },
    });
  });

  /* SEND CONTCAT DATA */

  $("#contactForm").on("submit", (e) => {
    e.preventDefault();
    let form = $("#contactForm")[0];
    $.ajax({
      url: "data.php",
      method: "POST",
      data: new FormData(form),
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {
        form.reset();
        $("#contact_message").html("").fadeIn();
        $("#contact_message")
          .html(
            '<div class="alert alert-success">Your Message Has been Sent</div>'
          )
          .fadeOut(4000);
      },
    });
  });
});
