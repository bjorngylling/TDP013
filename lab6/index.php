<?php 
  function all_has_value() {
    return isset($_POST['name'], 
      $_POST['email'], 
      $_POST['address'], 
      $_POST['telephone']);
  }

  if($_POST) {
    if(all_has_value()) {
      
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Lab 6: Validering</title>
    <link rel="stylesheet" href="master.css" type="text/css" media="screen" charset="utf-8" />		
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  </head>
  <body>
    <div id="content" class="shadow">
      <h1>Lab 6: Validering</h1>
      <form action="" method="post">
        <p><label for="name" title="Namn">Namn</label><input type="text" name="name" id="name" value="<?php echo $_POST['name']; ?>" /></p>
        <p><label for="email" title="E-Post">E-Post</label><input type="text" name="email" id="email" value="<?php echo $_POST['email']; ?>" /></p>
        <p><label for="address" title="Adress">Adress</label><input type="text" name="address" id="address" value="<?php echo $_POST['address']; ?>" /></p>
        <p><label for="telephone" title="Telefon">Telefon</label><input type="text" name="telephone" id="telephone" value="<?php echo $_POST['telephone']; ?>" /></p>
        <p><input type="submit" value="Spara" id="submit_button" /></p>
        <p><input type="button" value="Nollställ" id="reset_button" /></p>
      </form>
    </div>
    <script type="text/javascript">
      function reset_val_on(element) {
        $("input[name=" + element + "]").removeClass("error");
        $("label[for=" + element + "]").removeClass("error");
        $("label[for=" + element + "]").html($("label[for=" + element + "]").attr("title"));
      }
      
      function add_validation_on(element) {
        $("input[name=" + element + "]").change(function() {
          reset_val_on(element);
          
          var value = $(this).val();
          if(value == "") {
            $(this).addClass("error");
            $("label[for=" + element + "]").addClass("error");
            $("label[for=" + element + "]").append(" (måste anges)")
          }
          else {
          }
        });
      }
    
      var is_valid = new Array();
      var inputs_to_validate = new Array("name", "email", "address", "telephone");
      
      for(i in inputs_to_validate) {
        add_validation_on(inputs_to_validate[i]);
      }
      
      var old_submit = form.submit;
      form.submit = function() {
        $(form).trigger("submit");
        oldSubmit.call(form, arguments);
      }

      
      $("#reset_button").click(function() {
        $("input[type=text]").attr('value', "");
      });
    </script>
  </body>
</html>