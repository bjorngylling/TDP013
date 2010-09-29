<?php
  include('includes/bootstrap.php');
  
  allow_only_users();
  
  if(isset($_POST['stylesheet_id'])) {
    $user->set_stylesheet($_POST['stylesheet_id']);
    $stylesheet_id = $user->stylesheet_id;
  }

  $title = "Change style";
  include("includes/top.php");
?>

<form action="" method="post">
  <fieldset>
    <legend>Change style</legend>
    <select name="stylesheet_id">
      <?php foreach(list_all_stylesheets() as $stylesheet) { ?>
        <option value="<?php echo $stylesheet['id'] ?>" <?php if($stylesheet['id'] == $user->stylesheet_id) echo 'selected="selected"'; ?> ><?php echo $stylesheet['name'] ?></option>
      <?php } ?>
    </select><br />
    <input name="submit" type="submit" id="submit" value="Save change" />
  </fieldset>
</form>

<?php
  include("includes/bottom.php");
?>