<?php

// IF IS LOGGED IN , GRAB SESSION [USER ID]

// CHECK THAT THE USER IS THE SAME AS THE POSTER , THEN DO DELETE.

if (isset($_GET['id'])) {
  $post_id = $_GET['id'];
  $post_model = new Post_model();
  $post_model->delete_post($post_id);
}
else {
  die('post->delete.php error');
}
header('Location: ' . base_url() . 'post/my_posts');

?>