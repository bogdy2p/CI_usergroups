<h3>CHANGE YOUR DETAILS HERE</h3>

<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4">

    <?php
    $username = $this->session->userdata['username'];
    $current_user = $this->user_model->get_user_object_by_username($username);
    ?>
    <?php
    if (isset($custom_error)) {
      print_r($custom_error);
    }
    ?>
    <?php echo validation_errors('<p class="error">'); ?>
    <?php
    echo form_open('user/validate_form_update_details');
    echo form_label('First Name');
    echo '<br />';
    echo form_input('first_name', set_value('first_name', $current_user->first_name), 'placeholder="First Name"');
    echo '<br />';
    echo form_label('Last Name');
    echo '<br />';
    echo form_input('last_name', set_value('last_name', $current_user->last_name), 'placeholder ="Last Name"');
    echo '<br />';

    $detail_types = $this->user_model->get_all_user_detail_types();
    foreach ($detail_types as $detail_type) {
      echo form_label(ucfirst($detail_type));
      echo '<br />';
      $old_detail_data = $this->user_model->get_detail_by_usr_and_type($current_user->id, $detail_type);
      echo form_input($detail_type, set_value($detail_type, $old_detail_data), 'placeholder="' . ucfirst($detail_type) . '"');
      echo '<br />';
    }
    echo '<br />';
    echo form_submit('submit', 'Update My Details', 'id="submit" class="btn btn-success"');
    echo form_close();
    ?>

  </div>
  <div class="col-xs-12 col-md-4"></div>

</div>











