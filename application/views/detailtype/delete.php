<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $detail = new Detail_type_model();
  $detail->delete($id);
}
else {
  die('user->delete.php error');
}
header('Location: ' . base_url() . 'detail_type');
?>