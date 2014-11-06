<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $main = new Main_model();
  $main->delete_mapping($id);
}
else {
  die('user->delete.php error');
}
header('Location: ' . base_url() . 'main/tables');
?>