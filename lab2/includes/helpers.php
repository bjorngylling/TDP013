<?php 

function set_notice($notice) {
  $_SESSION['notice'] = $notice;
}

function redirect_to($file) {
  $url = "http://" . $_SERVER['HTTP_HOST'];
  $url .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  session_write_close();
  header("Location: $url/$file");
}

function is_signed_in() {
  return isset($_SESSION['user_id']);
}

function allow_only_users() {
  if(!is_signed_in()) {
    set_notice("You have to log in to view that page.");
    redirect_to('sign_in.php');
  }
}

function insert_stylesheet($stylesheet_id) {
  $query = Database::get_instance()->query(
    "SELECT file
     FROM stylesheets
     WHERE id = ?",
    array($stylesheet_id));
    
  echo '<link rel="stylesheet" href="media/css/' . $query[0]['file'] . '.css" type="text/css" media="screen" charset="utf8" />';
}

function list_all_stylesheets() {
  return Database::get_instance()->query(
    "SELECT id, name
     FROM stylesheets");
}