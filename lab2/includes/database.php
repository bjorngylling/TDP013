<?php
/* includes/database.php
   Database class for SQL 

*/

include 'database_settings.php';

class Database extends Database_Settings {
  
  public function __construct() {
    $this->connect();
  }
  
  private function connect() {
    if($this->con) {
      return true; // We're already connected
    }
    
    // Connect to the database
    // TODO: This part might need some error-checking
    $this->con = new mysqli($this->db_host, 
                             $this->db_user, 
                             $this->db_pass,
                             $this->db_name);
                             
    return true;
  }
  
  public function disconnect() {
    if($this->con) {
      $this->con->close();
      $this->con = false;
    }
  }
  
  public function query($query, $parameters) {
    $data_types = "";
    foreach($parameters as $param)
      $data_types .= $this->var_to_mysqli_type($param);
      
    return $data_types;
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

$db = new Database();

print $db->query("SELECT id FROM users WHERE name = ? AND password = ?", array("Arne", "Weise", 123));