<?php
  session_start();
  
  require_once('helpers.php');
  
  require_once('classes/config.php');
  require_once('classes/database.php');
  require_once('classes/user.php');
  require_once('classes/book.php');
  
if(is_signed_in()) {
  // We're signed in, create the user-instance
  $user = new User($_SESSION['user_id']);
  $stylesheet_id = $user->stylesheet_id;
}
else {
  $stylesheet_id = Config::get_instance()->default_stylesheet_id;
}
