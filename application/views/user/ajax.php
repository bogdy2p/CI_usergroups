<?php

//USERNAME AJAX
check_ajax();

function return_ajax_for_username($input) {
  $user = new User_model();
  $exists = $user->user_already_exists($input);
  if ($exists) {
    echo '1';
  }
  else {
    echo '0';
  }
}

function check_ajax() {
  if (isset($_GET['name'])) {
    return_ajax_for_username($_GET['name']);
  }
  if (isset($_GET['edit_username'])) {
    return_ajax_for_username($_GET['edit_username']);
  }
}
