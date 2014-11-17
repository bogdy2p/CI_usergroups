<?php

$user_id = $this->session->userdata['user_id'];
$my_posts = $this->post_model->read_for_user($user_id);

foreach ($my_posts as $post){
  echo '<pre>';
  print_r($post);
  echo '</pre>';
}
