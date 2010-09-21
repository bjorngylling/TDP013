<?php
  include('includes/bootstrap.php');
  
  allow_only_users();
  
  
  if(isset($_POST['title'], $_POST['author'], $_POST['isbn'])) {
    $book = Book::create_new($_POST['title'], $_POST['author'], $_POST['isbn'], $user->id);
    if($book) {
      set_notice("You added " . $book->title . " by " . $book->author . " to your collection.");
      redirect_to("my_books.php");
    }
  }

  $title = "Add a book";
  include("includes/top.php");
?>

<form action="" method="post">
  <fieldset>
    <legend>Add book</legend>
    <label for="title">Title: </label>
    <input name="title" type="text" id="title" value="<?php echo $_POST['title']; ?>" /><br />
    <label for="author">Author: </label>
    <input name="author" type="text" id="author" value="<?php echo $_POST['author']; ?>" /><br />
    <label for="isbn">ISBN: </label>
    <input name="isbn" type="text" id="isbn" /><br />
    <input name="submit" type="submit" id="submit" value="Add the book!" />
  </fieldset>
</form>

<?php
  include("includes/bottom.php");
?>