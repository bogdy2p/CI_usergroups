<?php

// DETAIL TYPE AJAX
check_ajax();

function return_ajax_for_detail_type($input) {
  $detail = new Detail_type_model();
  $exists = $detail->check_detail_type_exists($input);
  if ($exists) {
    echo '1';
  }
  else {
    echo '0';
  }
}

function check_ajax() {
  if (isset($_GET['detail_name'])) {
    return_ajax_for_detail_type($_GET['detail_name']);
  }
  if (isset($_GET['edit_detail'])) {
    return_ajax_for_detail_type($_GET['edit_detail']);
  }
}
