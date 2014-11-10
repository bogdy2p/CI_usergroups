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

function return_ajax_for_email($input) {
  $user = new User_model();
  $exists = $user->email_already_exists($input);
  if ($exists) {
    echo '1';
  }
  else {
    echo '0';
  }
}

function check_ajax() {
  if (isset($_GET['email_field'])) {
    return_ajax_for_email($_GET['email_field']);
  }
  if (isset($_GET['username'])) {
    return_ajax_for_username($_GET['username']);
  }
  if (isset($_GET['edit_username'])) {
    return_ajax_for_username($_GET['edit_username']);
  }
}
