// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs


$(function(){

	$(document).foundation();

	$('.fb').click(function() {
		fb_login();
	})

	function fb_login(){
 	   FB.login(function(response) {
	        if (response.authResponse) {
	            console.log('Welcome!  Fetching your information.... ');

	            //console.log(response); // dump complete info
	            access_token = response.authResponse.accessToken; //get access token
	            user_id = response.authResponse.userID; //get FB UID

	            FB.api('/me', function(response) {
	                user_email = response.email; //get user email
	          		// you can store this data into your database             
	          		console.log("Got the email address");

	          		var form_data = "user[external_id]=" + response.id + "&user[email]=" + user_email + "&user[type]=FB";
	          		$.ajax({
	          			type: "POST",
	          			url: "/users",
	          			data: form_data,
	          			success: function(data, textStatus) {
	          				// debugger;
	          				console.log("Success : ", data);
	          				data = $.parseJSON(data); //TODO: Fix double parsing...
	          				user = $.parseJSON(data);
	          				monster.set('loggedIn', 'yes');
	          				monster.set('loggedInUser', user);
	          			},
	          			error: function(jqXHR, textStatus, error) {
	          				// debugger;
	          				console.log("Error : ", error);
	          			}
	          		});
	            });
	        } else {
	            //user hit cancel button
	            console.log('User cancelled login or did not fully authorize.');
	        }
    	}, 
    	{
        	scope: 'publish_stream,email'
    	});
	}

	function check_login() {
		if (monster.get('loggedIn') == "yes") {
			//the user has logged in -- TODO: should probably set the cookies to expire
			$('body').addClass("donate");
			$('#user_id').val(monster.get('loggedInUser').id)
		}
	}

	check_login();

});