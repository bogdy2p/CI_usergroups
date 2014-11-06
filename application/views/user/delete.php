<?php
if (isset($_GET['id'])){
  $id = $_GET['id'];
  $user = new User_model();
  $user->delete($id);  
}else{
  die('user->delete.php error');
}
header('Location: '.base_url().'user');
?>