$(document).ready(function() {

    //GET PROFILE DATA
    $.ajax({
        url: 'manage action/profile.php',
        method: 'POST',
        dataType: 'json',
        data: {
            key: 'getexistingdata'
        },
        success: function(response) {
            $("#user_name").val(response.name);
            $("#user_contact_no").val(response.phone);
            $("#user_email").val(response.email);
            $("#user_password").val(response.password);
        }
    });
    //SEND EDITED DATA
    $("#edit_button").on('click', function(e) {
        e.preventDefault();
        let name = $("#user_name");
        let phone = $("#user_contact_no");
        let email = $("#user_email");
        let password = $("#user_password");
        $.ajax({
            url: 'manage action/profile.php',
            method: 'POST',
            dataType: 'text',
            data: {
                key: 'edit',
                name: name.val(),
                phone: phone.val(),
                email: email.val(),
                password: password.val()
            },
            success: function(response) {
                $("#message").html("").fadeIn();
                if (response == "edited") {
                    $("#message").html('<div class="alert alert-success">The Profile has been Edited</div>').fadeOut(4000);
                    $("#user_name").html(name.val());
                    $("#user_contact_no").html(phone.val());
                    $("#user_email").html(email.val());
                    $("#user_password").html(password.val());
                }


            }
        });
    });
});