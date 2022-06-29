$(document).ready(function() {

    $('#restaurant_logo').change(function() {
        let extension = $('#restaurant_logo').val().split('.').pop().toLowerCase();
        if (extension != '') {
            if (jQuery.inArray(extension, ['png', 'jpg', 'svg']) == -1) {
                alert("Invalid Image File");
                $('#restaurant_logo').val('');
                return false;
            }
        }
    });
    //GET INFO SECTION DATA
    $.ajax({
        url: 'manage action/setting.php',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'getrestaurantdata'
        },
        success: function(response) {
            console.log(response);
            $("#restaurant_name").val(response.name);
            $("#restaurant_email").val(response.email);
            $("#restaurant_contact_no").val(response.phone);
            $("#restaurant_address").val(response.address);
            $("#from-time").val(response.from_time);
            $("#to-time").val(response.to_time);
            $("#facebook-link").val(response.facebook);
            $("#twitter-link").val(response.twitter);
            $("#linked-in-link").val(response.linked_in);
            $('#uploaded_logo').html('<input type="hidden" name="hidden_restaurant_logo" value="' + response.logo + '" />');
        }
    });
    //GET ABOUT US SECTION DATA
    $.ajax({
        url: 'manage action/setting.php',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'getaboutdata'
        },
        success: function(response) {
            $("#theme_color").val(response.theme_color);
            $("#about_us").val(response.about_us);
            $('#uploaded_about_us').html('<input type="hidden" name="hidden_about_us_photo" value="' + response.about_picture + '" />');
        }
    });
    //GET TESTIMONIALS SECTION DATA
    $.ajax({
        url: 'manage action/setting.php',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'gettestimonialdata'
        },
        success: function(response) {
            console.log(response.data[0]["customer_name"]);
            $("#customer_name1").val(response.data[0]["customer_name"]);
            $("#customer_testimonial1").val(response.data[0]["testimonial"]);
            $("#customer_name2").val(response.data[1]["customer_name"]);
            $("#customer_testimonial2").val(response.data[1]["testimonial"]);
            $("#customer_name3").val(response.data[2]["customer_name"]);
            $("#customer_testimonial3").val(response.data[2]["testimonial"]);
        },
        error: function(err) {
            console.log(err);
        }
    });
    //GET HEADER SECTION DATA
    $.ajax({
        url: 'manage action/setting.php',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'getheaderdata'
        },
        success: function(response) {
            $("#restaurant_slogan").val(response.restaurant_slogan);
            $('#uploaded_photo1').html('<input type="hidden" name="hidden_header_photo1" value="' + response.photo1 + '" />');
            $('#uploaded_photo2').html('<input type="hidden" name="hidden_header_photo2" value="' + response.photo2 + '" />');
            $('#uploaded_photo3').html('<input type="hidden" name="hidden_header_photo3" value="' + response.photo3 + '" />');
        },
        error: function(err) {
            console.log(err);
        }
    });


    //EDIT RESTAURANT INFO SECTION
    $("#edit_restaurant").on('click', function(e) {
        e.preventDefault();
        let form = $("#restaurant_form")[0];
        $.ajax({
            url: 'manage action/setting.php',
            method: 'POST',
            data: new FormData(form),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                $("#message_info").html("").fadeIn();
                if (response.data == "info") {
                    $("#message_info").html('<div class="alert alert-success">Info Section has been Edited</div>').fadeOut(4000);
            }}
        });
    });
    //EDIT TESTIMONIALS SECTION
    $("#edit_testimonial").on('click', function(e) {
        e.preventDefault();
        let name1 = $("#customer_name1");
        let testimonial1 = $("#customer_testimonial1");
        let name2 = $("#customer_name2");
        let testimonial2 = $("#customer_testimonial2");
        let name3 = $("#customer_name3");
        let testimonial3 = $("#customer_testimonial3");

        $.ajax({
            url: 'manage action/setting.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'edittestimonial',
                name1: name1.val(),
                testimonial1: testimonial1.val(),
                name2: name2.val(),
                testimonial2: testimonial2.val(),
                name3: name3.val(),
                testimonial3: testimonial3.val()
            },
            success: function(response) {
                $("#message_testimonial").html("").fadeIn();
                if (response == "testimonial") {
                    $("#message_testimonial").html('<div class="alert alert-success">Testimonial Section Has Been Edited</div>').fadeOut(4000);
            }
            }
        });
    });
    //EDIT ABOUT US SECTION
    $("#edit_about").on('click', function(e) {
        e.preventDefault();
        let form = $("#about_us_form")[0];
        $.ajax({
            url: 'manage action/setting.php',
            method: 'POST',
            data: new FormData(form),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                $("#message_about_us").html("").fadeIn();
                if (response.data == "about_us") {
                    $("#message_about_us").html('<div class="alert alert-success">About Us Section Has Been Edited</div>').fadeOut(4000);
            }
            }
        });
    });
    //EDIT HEADER SECTION
    $("#edit_header").on('click', function(e) {
        e.preventDefault();
        let form = $("#header_form")[0];
        $.ajax({
            url: 'manage action/setting.php',
            method: 'POST',
            data: new FormData(form),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                $("#message_header").html("").fadeIn();
                if (response.data == "header") {
                    $("#message_header").html('<div class="alert alert-success">Header Section Has Been Edited</div>').fadeOut(4000);
                    console.log(1);
            }
            }
        });
    });




});