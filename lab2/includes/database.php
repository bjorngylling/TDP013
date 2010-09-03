<?php
/* includes/database.php
   Database class for SQL 

*/

include 'database_settings.php';

class Database extends Database_Settings {
  
  public function connect() {
    if($this->con) {
      return true; // We're already connected
    }
    
    // Connect and select the database
    // TODO: This part might need some error-checking, 
    // making sure the connection succeeded before selecting table.
    $connection = mysql_connect($this->db_host, 
                                $this->db_user, 
                                $this->db_pass);
    $select_database = mysql_select_db($this->db_name, $connection);
  }
  
  public function disconnect() {
    
  }
  
  public function select() {
    
  }
  
  public function insert() {
    
  }
  
  public function delete() {
    
  }
  
}

$db = new Database();
$db->connect();