<?php
/* includes/book.php
   A book !

*/

class Book {
  public $id;
  public $title;
  public $author;
  public $isbn;
  
  function __construct($id = false) {
    $this->config = Config::get_instance();
    if($id)
      $this->load_book($id);
  }
  
  public static function create_new($title, $author, $isbn, $user_id) {
    $book = new Book();
    
    // Make sure the book doesn't exist (on ISBN number)
    $book_query = Database::get_instance()->query(
      "SELECT id 
       FROM books 
       WHERE isbn = ?", 
      array($isbn));
    
    if($book_query) {
      set_notice("A book with that isbn number already exists!");
      return false;
    }
    
    // Create the book
    $id = Database::get_instance()->query(
      "INSERT INTO books
       (user_id, title, author, isbn)
       VALUES (?, ?, ?, ?)",
      array($user_id, $title, $author, $isbn));
    
    $book->load_book($id);
    
    return $book;
  }
  
  public static function list_all($user_id = false) {
    if($user_id) {
      $result = Database::get_instance()->query( 
        "SELECT title, author, isbn
         FROM books
         WHERE user_id = ?
         ORDER BY id DESC",
        array($user_id));
    }
    else {
      $result = Database::get_instance()->query( 
        "SELECT title, author, isbn
         FROM books
         ORDER BY id DESC");
    }
    
    return $result;
  }
  
  private function load_book($id) {
    var_dump($id);
    $book_data = Database::get_instance()->query(
      "SELECT title, author, isbn 
       FROM books 
       WHERE id = ?", 
      array($id));
    var_dump($book_data);
    $this->id = $id;
    $this->title = $book_data[0]['title'];
    $this->author = $book_data[0]['author'];
    $this->isbn = $book_data[0]['isbn'];
    var_dump($this);
  }
}