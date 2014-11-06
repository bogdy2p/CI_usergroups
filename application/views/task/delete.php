<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $task = new Task_model();
  $task->delete($id);
}
else {
  die('task->delete.php error');
}
header('Location: ' . base_url() . 'task');
?>