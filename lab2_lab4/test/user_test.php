<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(str_replace('//','/',dirname(__FILE__).'/') .'../includes/classes/user.php');

class TestUser extends UnitTestCase {
  
  function test_sign_in() {
    $result = User::sign_in("Administrator", "1qaz9ijn");
    
    $this->AssertEqual($result->username, "Administrator");
    $this->AssertEqual($result->stylesheet_id, "0");
  }
  
  function test_load_user() {
    $result = new User(1);
    
    $this->AssertEqual($result->username, "Arne");
    $this->AssertEqual($result->stylesheet_id, "0");
  }
  
}