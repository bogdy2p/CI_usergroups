<?php

if (isset($this->session->userdata['user_id'])) {
  if (isset($_GET['id'])) {
    $user_id = $this->session->userdata['user_id'];
    $post_id = $_GET['id'];
    $is_ok = $this->post_model->verify_message_ownership($user_id, $post_id);
    if ($is_ok) {
      $this->post_model->delete_post($post_id);
      header('Location: ' . base_url() . 'post/my_posts');
    }
    else {
      die("You are not the creator of this message !");
    }
  }
  else {
    show_404();
  }
}
else {
  show_404();
}
?>