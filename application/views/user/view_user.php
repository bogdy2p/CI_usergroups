<?php $user = new User_model(); ?>
<div class ="container">
  <?php
  if (isset($_POST['id'])) {
    $_GET['id'] = $_POST['id'];
  }
  ?>


  <div class="row">
    <div class="col-xs-4 col-md-4"></div>
    <div class="col-xs-4 col-md-4">

      <?php
      // GENERATE FORM OF SWITCHING USERS WITH CODEIGNITER FORM HELPER
      echo form_open('user/view_user');
      $id_array = $user->grab_all_user_ids();
      $data = array();
      foreach ($id_array as $id => $value) {
        $data[$value] = 'User ' . $value . ' - ' . $user->get_user_name_by_user_id($value);
      }
      echo form_dropdown('id', $data, 'ASD');
      echo '<br /><br />';
      echo form_submit('submit', 'Change User Account', 'class="btn btn-success"');

      echo form_close();
      ?>
    </div>
    <div class="col-xs-4 col-md-4"></div>
  </div>
  <div clas="row">



    <?php
    // GENERATE TABLES USING CODEIGNITER TABLE HELPER 
    ?>




    <?php
    if (isset($_GET['id']) && ($_GET['id'] > 0)) {
      $_POST['id'] = $_GET['id'];
    }
    if (isset($_POST['id']) && ($_POST['id'] > 0)) {
      $user->print_user_information_table_html($_POST['id']);
      $user->print_user_details_information_table_html($_POST['id']);
    }
    ?>
  </div>
</div>