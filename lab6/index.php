<?php 

  require_once('recaptchalib.php');
  
  $captcha_valid = false;
  
  // Get a key from https://www.google.com/recaptcha/admin/create
  $publickey = "6Lcrpb0SAAAAAAQrf2gMjOngB4ffAYYWlb31TuVP";
  $privatekey = "6Lcrpb0SAAAAAGsZtp5X9_zNaPdF8sRKuXiCXVtj";
  
  # the response from reCAPTCHA
  $resp = null;
  # the error code from reCAPTCHA, if any
  $error = null;
  
  # was there a reCAPTCHA response?
  if ($_POST["recaptcha_response_field"]) {
    $resp = recaptcha_check_answer ($privatekey,
      $_SERVER["REMOTE_ADDR"],
      $_POST["recaptcha_challenge_field"],
      $_POST["recaptcha_response_field"]);

    if ($resp->is_valid) {
      $captcha_valid = true;
    } else {
      # set the error code so that we can display it
      $error = $resp->error;
    }
  }

  function all_has_value() {
    if($_POST['name'] != "" && $_POST['email'] != "" && $_POST['address'] != "" && $_POST['telephone'] != "")
      return true;
    else
      return false;
  }
  function is_email($email) {
    if(preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email))
      return true;
    else
      return false;
  }
  function is_telephone($telephone) {
    if(preg_match("/^[0-9]{5,14}$/", $telephone))
      return true;
    else
      return false;
  }

  if($_POST) {
    if(all_has_value() && is_email($_POST['email']) && is_telephone($_POST['telephone']) && $captcha_valid) {
      $all_is_good_in_php_land = true;
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
      <?php if($all_is_good_in_php_land) { ?><h1>Senaste postningen lyckades!</h1><?php } ?>
      <?php if(!$all_is_good_in_php_land && $_POST) { ?><h1 class="error">Senaste postningen misslyckades!</h1><?php } ?>
      <h1>Lab 6: Validering</h1>
      <form action="" method="post" onSubmit="return verify()">
        <p><label for="name" title="Namn">Namn</label><input type="text" name="name" id="name" value="<?php echo $_POST['name']; ?>" /></p>
        <p><label for="email" title="E-Post">E-Post</label><input type="text" name="email" id="email" value="<?php echo $_POST['email']; ?>" /></p>
        <p><label for="address" title="Adress">Adress</label><input type="text" name="address" id="address" value="<?php echo $_POST['address']; ?>" /></p>
        <p><label for="telephone" title="Telefon">Telefon</label><input type="text" name="telephone" id="telephone" value="<?php echo $_POST['telephone']; ?>" /></p>
        <?php echo recaptcha_get_html($publickey, $error); ?>
        <p><input type="submit" value="Spara" id="submit_button" /></p>
        <p><input type="button" value="Nollställ" id="reset_button" /></p>
      </form>
    </div>
    <script type="text/javascript">
      
      function array_remove(array, element){
        var i = array.indexOf(element);
        if(i != -1) array.splice(i, 1);
      }
      
      function reset_val_on(element) {
        $("input[name=" + element + "]").removeClass("error");
        $("label[for=" + element + "]").removeClass("error");
        $("label[for=" + element + "]").html($("label[for=" + element + "]").attr("title"));
      };
      function add_required_on(element) {
        $("input[name=" + element + "]").change(function() {
          reset_val_on(element);
          
          var value = $(this).val();
          if(value == "") {
            $(this).addClass("error");
            $("label[for=" + element + "]").addClass("error");
            $("label[for=" + element + "]").append(" (måste anges)");
            array_remove(is_valid, element);
          }
          else {
            if(is_valid.indexOf(element) == -1)
              is_valid.push(element);
          }
        });
      };
      function add_regexp_on(element, regexp, error_msg) {
        $("input[name=" + element + "]").change(function() {
          reset_val_on(element);
          
          var value = $(this).val();
          
          if(regexp.test(value) == false) {
            $(this).addClass("error");
            $("label[for=" + element + "]").addClass("error");
            $("label[for=" + element + "]").append(" (" + error_msg + ")");
            array_remove(is_valid, element);
          }
          else {
            if(is_valid.indexOf(element) == -1)
              is_valid.push(element);
          }
        });
      };
      function verify() {
        $("input[type=text]").trigger("change");
        if(is_valid.length == 4)
          return true;
        else
          return false;
      }
    
      var is_valid = new Array();
      var inputs_to_validate = new Array("name", "email", "address", "telephone");
      
      for(i in inputs_to_validate) {
        add_required_on(inputs_to_validate[i]);
      }
      add_regexp_on("email", new RegExp(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/), "verkar inte vara en epost adress");
      add_regexp_on("telephone", new RegExp(/^[0-9]{5,14}$/), "verkar inte vara ett telefonnummer");
      
      $("#reset_button").click(function() {
        $("input[type=text]").attr('value', "");
      });
    </script>
  </body>
</html>