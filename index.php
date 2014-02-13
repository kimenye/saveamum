<?php
	require_once('lib/limonade.php');
	require_once('lib/twitteroauth/twitteroauth.php');
	date_default_timezone_set('Africa/Nairobi');

	define('TWITTER_OAUTH_CONSUMER_KEY','TJ73brA6QM9LNbqlYVRQQ');
	define('TWITTER_OAUTH_CONSUMER_SECRET','zDkN1conS5i5K791X6Tz3daosX5D2DWYfDXNxSo4');


	# 1. Setting global options of our application
	function configure()
	{
		# A. Setting environment
		$localhost = preg_match('/^localhost(\:\d+)?/', $_SERVER['HTTP_HOST']);
		$env =  $localhost ? ENV_DEVELOPMENT : ENV_PRODUCTION;

		option('env', $env);
  
  		# B. Initiate db connexion
		$dsn = $env == ENV_PRODUCTION ? 'mysql:host=127.0.0.1;port=3306;dbname=sproutco_saveamum' : 'mysql:host=127.0.0.1;port=8889;dbname=saveamum';
		$username = $env == ENV_PRODUCTION ? 'sproutco_smum' : 'root';
		$pass = $env == ENV_PRODUCTION ? 'sproutk3' : 'root';
		
		try
		{
	  		$db = new PDO($dsn, $username, $pass, array( PDO::ATTR_PERSISTENT => false));
		}
		catch(PDOException $e)
		{
	  		halt("Connexion failed: ".$e); # raises an error / renders the error page and exit.
		}

		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		option('db_conn', $db);
	}

	function before()
	{
		$donations = user_donation_find_all();
		set('donations', $donations);
		layout('layouts/default.html.php');
	}

	dispatch('/', 'home');
	function home() {
		return html('home/index.html.php'); # rendering HTML view
	}

	dispatch('/share', 'share');
	function share() {
		return html('home/share.html.php');
	}

	dispatch('/twitter', 'twitter');
	function twitter() {
		// session_start();
 
		if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) { 
			//we are in the callback???		 
		} else {
		 
		    $twoauth = new TwitterOAuth(TWITTER_OAUTH_CONSUMER_KEY,TWITTER_OAUTH_CONSUMER_SECRET);
		 
		 	$localhost = preg_match('/^localhost(\:\d+)?/', $_SERVER['HTTP_HOST']);
			$env =  $localhost ? ENV_DEVELOPMENT : ENV_PRODUCTION;
		 	$url = $env == ENV_PRODUCTION ? "http://saveamum.sprout.co.ke/callback/" : "http://localhost:8000/saveamum/callback/";

		    $request_token = $twoauth->getRequestToken($url);
		 
		    $_SESSION['oauth_token'] = $request_token['oauth_token'];
		    $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		 
		    if ($twoauth->http_code == 200) {
		        $url = $twoauth->getAuthorizeURL($request_token['oauth_token']);
		        header("Location: " . $url);
		    } else {
		        die("oops... something's wrong!");
		    }
		}
	}

	dispatch('/callback', 'callback');
	function callback() {
		if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) { 
		    $twoauth = new TwitterOAuth(TWITTER_OAUTH_CONSUMER_KEY, TWITTER_OAUTH_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);  
		    $access_token = $twoauth->getAccessToken($_GET['oauth_verifier']); 
		    $_SESSION['access_token'] = $access_token; 
		    $user_info = $twoauth->get('account/verify_credentials'); 
		 

		    $u = array("type" => "TW", "external_id" => $user_info->id, "email" => "");
		    $user_id = user_create($u); 
		    $user = user_find($user_id);

		    // set('user', $user);
		    $_SESSION['user'] = $user;
		    // return html('home/index.html.php'); # rendering HTML view
		    redirect_to('/');
		}
	}

	dispatch_post('/share', 'users_share');
	function users_share()
	{
		$donation_id = $_POST['user_donation_id'];
		$message = $_POST['message'];
		if ($donation_id = user_donations_update($donation_id, $message)) {
			$donation = user_donations_find($donation_id);
			$_SESSION['user_donation'] = $user_donation;
		}
	}

	dispatch('/messages/:id', 'messages');
	function messages() 
	{
		if( $user_donation = user_donations_find(params('id')) )
		{
			$user = user_find($user_donation['user_id']);

			set('user_donation',$user_donation);
			set('user', $user);

			return html('home/post.html.php');
		}
	}


	# matches POST /users
	dispatch_post('/users', 'users_create');
  	function users_create()
  	{ 
    	if($user_id = user_create($_POST['user'])) {
    		$user = user_find($user_id);
    		return json(json_encode($user));
    	}
    	else {
      		halt(SERVER_ERROR, "AN error occured while trying to create a new user"); # raises error / renders an error page
    	}
  	}

  	dispatch_post('/donate', 'donate');
  	function donate() {
  		if ($user_donation_id = user_donations_create('MPESA', $_POST['mpesa_ref'], 50, $_POST['user_id'])) {  			
  			$user_donation = user_donations_find($user_donation_id);
  			$_SESSION['user_donation'] = $user_donation;
  			redirect_to('share');	
  		}
  		
  	}

	run();
?>