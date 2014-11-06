<?php
if (isset($_GET['id'])){
  $id = $_GET['id'];
  $group = new Group_model();
  $group->delete($id);  
}else{
  die('group->delete.php error');
}
header('Location: '.base_url().'group');
?>