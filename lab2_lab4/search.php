<?php
  include('includes/bootstrap.php');

  $title = "Search the library";
  include("includes/top.php");
?>
<p>Search:</p>
<input name="search_field" id="search_field" type="text" onkeyup="search(this.value)" />
<div id="book_list" class="book_list">
</div>

<script type="text/javascript">
  function clear_results() {
    var result_div = document.getElementById("book_list");
    
    while (result_div.hasChildNodes()) {
      result_div.removeChild(result_div.lastChild);
    }
  }

  function search(search_string) {
    if(search_string.length == 0) {
      clear_results();
      return;
    }
    
    if (window.XMLHttpRequest) {
      xmlhttp=new XMLHttpRequest();
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("book_list").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET", "search_ajax.php?search_string=" + search_string);
    xmlhttp.send();
    
  }
</script>

<?php
  include("includes/bottom.php");
?>