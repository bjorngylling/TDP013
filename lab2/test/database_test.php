<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(str_replace('//','/',dirname(__FILE__).'/') .'../classes/database.php');

class TestDatabase extends UnitTestCase {
  function test_simple_query() {
    $result = Database::get_instance()->query("SELECT id FROM users");
    
    // Result should be array
    $this->assertIsA($result, 'array');
    
    $this->assertEqual(sizeof($result), 2);
    // First user has id 1
    $this->assertEqual($result[0]['id'], 1);
  }
  
  function test_selection_query() {
    $result = Database::get_instance()->query("SELECT id FROM users WHERE username = ?", array('Administrator'));
    
    // Result should be array
    $this->assertIsA($result, 'array');
    // Only one user named "Administrator"
    $this->assertEqual(sizeof($result), 1);
    // Administrator has id 2
    $this->assertEqual($result[0]['id'], 2);
  }
}