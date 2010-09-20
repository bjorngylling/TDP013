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
  
  function __construct($id = false) {
    $this->config = Config::get_instance();
    if($id)
      $this->load_user($id);
  }
  
  public static function create_new($username, $password) {
    
  }
  
  public static function sign_in($username, $password) {
    $user = new User();
    
    $user_data = Database::get_instance()->query(
      "SELECT id, username, stylesheet_id 
       FROM users 
       WHERE username = ? 
       AND password = ?", 
      array($username,
        $user->hash_password($password)));
    
    $user->load_user($user_data[0]['id'], 
      $user_data[0]['username'], 
      $user_data[0]['stylesheet_id']);
    
    return $user;
  }
  
  private function load_user($id, $username = false, $stylesheet_id = false) {
    if($username AND $stylesheet_id) {
      $this->username = $username;
      $this->stylesheet_id = $stylesheet_id;
    }
    else {
      $user_data = Database::get_instance()->query(
        "SELECT username, stylesheet_id 
         FROM users 
         WHERE id = ?", 
        array($id));
      $this->username = $user_data[0]['username'];
      $this->stylesheet_id = $user_data[0]['stylesheet_id'];
    }
  }
  
  private function hash_password($password) {
    return sha1($password.$this->config->db_salt);
  }
  
}