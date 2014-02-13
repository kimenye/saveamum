<?php
	require_once('lib/limonade.php');
	date_default_timezone_set('Africa/Nairobi');

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
  			redirect_to('share');	
  		}
  		
  	}

	run();
?>