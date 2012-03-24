<?php
/*
 * @author: Evandro Eisinger 
 */
 
  require("facebook-sdk/facebook.php");
  
  $config = array(
    'appId' => "202465246524252",
    'secret' => "3150c34907ad4e82e727405f32f4f863",
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
  
   if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

        $user_profile = $facebook->api('/me','GET');
        echo "Name: " . $user_profile['name'];

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl(); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, print a link for the user to login
      $login_url = $facebook->getLoginUrl();
      echo 'Please <a href="' . $login_url . '">login.</a>';

    }
  
?>