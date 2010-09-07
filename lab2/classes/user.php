<?php
/* includes/user.php
   User handling

*/

require_once 'config.php';
require_once 'database.php';

class User {
  public $stylesheet_id;
  public $username;
  
  private $config = false;
  
  function __construct($id) {
    $this->config = Config::get_instance();
  }
  
  public static function create_new($username, $password) {
    
  }
  
}