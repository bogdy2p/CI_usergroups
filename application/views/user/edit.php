<!--// SHOULD GRAB USER OBJECT BEFORE PRINTING ALL?...-->

<div class="row">
  <?php
  echo validation_errors('<p class="error">');
  echo form_open('user/validate_form_update_user');
  ?>

  <div class="col-xs-12 col-md-3">
    <?php
    echo form_label('Email:');
    echo '<br />';
    echo form_input('email', set_value('email'), 'placeholder = "example@provider.com"');
    echo '<br />';
    echo form_label('First Name:');
    echo '<br />';
    echo form_input('first_name', set_value('first_name'), 'placeholder = "First Name"');
    echo '<br />';
    echo form_label('Last Name:');
    echo '<br />';
    echo form_input('last_name', set_value('last_name'), 'placeholder = "Last Name"');
    echo '<br />';
    echo form_label('Username:');
    echo '<br />';
    echo form_input('username', set_value('username'), 'placeholder = "Username"');
    echo '<br />';
    echo form_label('Password:');
    echo '<br />';
    echo form_input('password', '', 'placeholder="Password" class="password"');
    echo '<br />';
    echo form_label('Confirm Password:');
    echo '<br />';
    echo form_input('password_confirm', '', 'placeholder="Confirm Password" class="password"');
    ?>
    <br />
  </div>
  <div class="col-xs-12 col-md-3">
    <?php
    $detail_types = $this->user_model->get_all_user_detail_types();
    foreach ($detail_types as $detail_type) {
      echo form_label(ucfirst($detail_type));
      echo '<br />';
      echo form_input($detail_type, set_value($detail_type), 'placeholder="' . ucfirst($detail_type) . '"');
      echo '<br />';
    }
    ?>
    <br />
  </div>
  <div class="col-xs-12 col-md-3">coloana3</div>
  <div class="col-xs-12 col-md-3">coloana4</div>

</div>
<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-3">
    <br /><br /><br /><br />
    <?php
    echo form_submit('submit', 'Update/Save User', 'class="btn btn-success"');
    ?>
  </div>
  <div class="col-xs-12 col-md-5"></div>

</div>

<?php
$user = new User_model;
$user->print_userdata_inputs();
?>		

<?php $user->print_group_checkboxes_inputs(); ?>

<?php
$user->get_userdata_details_availlable($_GET['id']);
?>
<!--    
 function print_group_checkboxes_inputs() {
    $array_of_current_groups = Self::get_number_of_groups_for_a_user($_GET['id']);
    $groups_array = Self::get_all_groups_in_db();
    $group_names = $groups_array['name'];
    $group_ids = $groups_array['id'];
    echo '<h3>This user is a member of: </h3><br />';
    foreach ($group_names as $group_name) {
      if (in_array($group_name, $array_of_current_groups)) {
        echo '<input name="' . $group_name . '" type="checkbox" value="' . $group_name . '" checked>&nbsp;';
        echo '<label>' . $group_name . '\'s</label><br />';
      }
      else {
        echo '<input name="' . $group_name . '" type="checkbox" value="' . $group_name . '">&nbsp;';
        echo '<label>' . $group_name . '</label><br />';
      }
    }
  }-->