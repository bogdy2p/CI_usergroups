<?php 
  if (isset($_GET['id'])){
    echo '<h1> VIEW INDIVIDUAL USER  with id : '.$_GET["id"].'</h1>';
  }else{
    die("error on user->view_user");
  }
?>