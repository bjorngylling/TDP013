<?php
/* includes/database.php
   Database wrapper for mysqli 

*/

include 'config.php';

class Database {
  static private $instance = false;
  private $config = false;
  private $con = false;
  
  public function __construct() {
    $this->config = Config::get_instance();
    $this->connect();
  }
  
  static public function get_instance() {
    if (!self::$instance) {
      self::$instance = new Database;
    }
 
    return self::$instance;
  }
  
  private function connect() {
    if($this->con) {
      return true; // We're already connected
    }
    
    // Connect to the database
    // TODO: This part might need some error-checking
    $this->con = new mysqli($this->config->db_host, 
                            $this->config->db_user, 
                            $this->config->db_pass,
                            $this->config->db_name);
                             
    return true;
  }
  
  public function disconnect() {
    if($this->con) {
      $this->con->close();
      $this->con = false;
    }
  }
  
  public function query($query, $parameters) {
    // Construct the mysqli datatype string
    $data_types = "";
    foreach($parameters as $param)
      $data_types .= $this->var_to_mysqli_type($param);
      
    $params = array($data_types);
    foreach($parameters as $key => $value)
      $params[] = &$parameters[$key];
    
    $statement = $this->con->prepare($query);
    
    call_user_func_array(array(&$statement, 'bind_param'), $params);
    
  }
  
  private function var_to_mysqli_type($var) {
    if(is_int($var))
      return 'i';
    elseif(is_float($var))
      return 'd';
    else
      return 's';
  }
  
}

print Database::get_instance()->query("SELECT id FROM users WHERE username = ? AND password = ?", array("Arne", "Weise"));