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
    $this->load_user($id);
  }
  
  public static function create_new($username, $password) {
    
  }
  
  public static function sign_in($username, $password) {
    $user = Database::get_instance()->query(
      "SELECT username, stylesheet_id 
       FROM users 
       WHERE username = ? 
       AND password = ?", 
       $username,
       $this->hash_password($password));
    
    return new User($user[0]['id']);
  }
  
  private function load_user($id) {
    $user = Database::get_instance()->query("SELECT username, stylesheet_id FROM users WHERE id = ?", $id);
    $this->username = $user['username'];
    $this->stylesheet_id = $user['stylesheet_id'];
  }
  
  private function hash_password($password) {
    return sha1($password.$this->config->db_salt);
  }
  
}