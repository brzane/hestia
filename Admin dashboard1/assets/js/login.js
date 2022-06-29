$(document).ready(function() {
	//CHECK THE NAME AND PASS AND REDIRECT PAGE
	$('#submit').on('click', function() {
		let email = $('#email').val();
		let password = $('#password').val();

		if (email == "" || password == "") {
			alert('Some data is empty');
		} else {
			$.ajax({
				url: 'login.php',
				method: 'POST',
				dataType: 'json',
				data: {
					login: 1,
					email_: email,
					password_: password
				},
				success: function(response) {
					if (response.error != 'wrong') {
						window.location.href = "https://localhost/project/admin%20dashboard1/" + response.success;
					} else {
						$("#message").html('<div class="alert alert-danger">Sorry, Your Email or Password is incorrect , contact Admin</div>');
					}
				},
				error: function(err) {
					console.log(err);

				}
			});
		}
	});

});
//INPUT FIELD ANIMATION
$('.input').each(function() {
	$(this).on('focus', () => $(this).parent().parent().addClass('focus'));
	$(this).on('blur', () => {
		if ($(this).val() == "") {
			$(this).parent().parent().removeClass('focus');
		}
	});
})