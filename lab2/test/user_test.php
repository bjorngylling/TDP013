<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(str_replace('//','/',dirname(__FILE__).'/') .'../classes/user.php');

class TestUser extends UnitTestCase {
  
  function test_truth() {
    $this->AssertTrue(true);
  }
  
}