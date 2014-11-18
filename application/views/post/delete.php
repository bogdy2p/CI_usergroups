Delete pOST VIEW / Button
<?php

// IF IS LOGGED IN , GRAB SESSION [USER ID]

// CHECK THAT THE USER IS THE SAME AS THE POSTER , THEN DO DELETE.

if (isset($_GET['post_id'])) {
  $post_id = $_GET['post_id'];
  $detail = new Detail_type_model();
  $detail->delete($post_id);
}
else {
  die('user->delete.php error');
}
header('Location: ' . base_url() . 'post');

?>