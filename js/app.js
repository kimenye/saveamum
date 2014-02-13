// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs


$(function(){

	$(document).foundation();

	$('.fb').click(function() {
		fb_login();
	});


	$('#share_form').submit(function() {
		$theForm = $(this);

		// send xhr request
	    $.ajax({
	        type: $theForm.attr('method'),
	        url: $theForm.attr('action'),
	        data: $theForm.serialize(),
	        success: function(data) {
	            console.log('Yay! Form sent.');
	            // debugger;

	            data = $.parseJSON(data);
	            user = data[1];
	            donation = data[0];

	            $('.donation').addClass('hide');
	            $('.message .text').html($('.your_message').val());
	            $('.message').removeClass('hide');

	            if (user.type == "FB") {
	            	FB.ui(
					  {
					    method: 'feed',
					    name: 'Save a Mum',
					    link: 'http://saveamum.sprout.co.ke/messages/' + data.id,
					    picture: 'http://saveamum.sprout.co.ke/images/flower.png',
					    caption: 'I support the SaveAMum Initiative',
					    description: $('.your_message').val()
					  },
					  function(response) {
					  	debugger;
					    if (response && response.post_id) {
					      console.log('Post was published.');
					    } else {
					      console.log('Post was not published.');
					    }
					  }
					);
	            }
	        }
	    });

	    // prevent submitting again
	    return false;
	});

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
	          				// console.log("Success : ", data);
	          				data = $.parseJSON(data); //TODO: Fix double parsing...
	          				user = $.parseJSON(data);
	          				monster.set('loggedIn', 'yes');
	          				monster.set('loggedInUser', user);
	          				check_login();
	          			},
	          			error: function(jqXHR, textStatus, error) {
	          				// debugger;
	          				// console.log("Error : ", error);
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
			if (monster.get('loggedInUser') != null)
				$('#user_id').val(monster.get('loggedInUser').id);
		}
	}

	check_login();

});