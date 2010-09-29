<?php
include('includes/bootstrap.php');

$result_list = Book::search($_GET['search_string']);

if($result_list) {
foreach($result_list as $book) { ?>
    <div class="book">
      <p><span class="title"><?php echo $book['title'] ?></span> by <span class="author"><?php echo $book['author'] ?></span>.</p>
      <p class="isbn">ISBN: <?php echo $book['isbn'] ?></p>
    </div>
  <?php } 
}
else { ?>
<p>The search returned no results!</p>
<?php } ?>