<?php
  include('includes/bootstrap.php');
  
  allow_only_users();
  
  $user_id = $_SESSION['user_id'];

  $title = "Listing your books";
  include("includes/top.php");
?>

<div class="book_list">
<?php 
$book_list = Book::list_all($user_id);
if($book_list) {
  foreach($book_list as $book) { ?>
    <div class="book">
      <p><span class="title"><?php echo $book['title'] ?></span> by <span class="author"><?php echo $book['author'] ?></span>.</p>
      <p class="isbn">ISBN: <?php echo $book['isbn'] ?></p>
    </div>
  <?php } 
}
else { ?>
<p>You have no books!</p>
<?php } ?>

</div>

<?php
  include("includes/bottom.php");
?>