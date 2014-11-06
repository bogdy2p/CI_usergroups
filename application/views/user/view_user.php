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

      <form class="form" id="viewuser" action="view_user" method="post"><br /><br />
        <select name="id" id="id" form="viewuser">
          <?php
          $id_array = $user->grab_all_user_ids();
          foreach ($id_array as $id => $value) {
            echo '<option value="' . $value . '">' . $value . ' - ' . $user->get_user_name_by_user_id($value) . '</option>';
          }
          ?>
        </select>
        <br /><br />
        <button type="submit" class="button">View User's Data</button>
      </form>
    </div>
    <div class="col-xs-4 col-md-4"></div>
  </div>
  <div clas="row">
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