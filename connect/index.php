<?php

require './src/facebook.php';

// Create Application instance
$facebook = new Facebook(array(
  'appId'  => '202465246524252',
  'secret' => '3150c34907ad4e82e727405f32f4f863',
));

// Get User ID
$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}

?>

<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">

    <head>
    	<title>Ágora - Facebook Connect</title>
    </head>
    
    <body>
    
        <h1>Ágora - Facebook Connect</h1>
        
		<?php if ($user): ?>
        
	        <h3><a href="<?php echo $logoutUrl; ?>">Logout</a></h3>
        
        <?php else: ?>
        
    	    <h3><a href="<?php echo $loginUrl; ?>">Login with Facebook</a></h3>
        
        <?php endif ?>
        
        <?php if ($user): ?>
        	
        	<h3>Facebook User Profile Data</h3>
        	<pre><?php print_r($user_profile); ?></pre>
        
        <?php else: ?>
        
        	<strong><em>You are not Connected.</em></strong>
        
        <?php endif ?>
        
    </body>

</html>