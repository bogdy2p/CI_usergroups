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
  <div class="col-xs-12 col-md-3">

    <?php
    $array_of_groups_already_member = $this->user_model->get_number_of_groups_for_a_user($_GET['id']);
    $array_all_groups_availlable = $this->user_model->get_all_groups_in_db()['name'];
    echo '<h3>Change group\'s membersip: </h3><br />';
    foreach ($array_all_groups_availlable as $group) {
      if (in_array($group, $array_of_groups_already_member)) {
        echo form_checkbox($group, $group, TRUE);
        echo form_label($group . '\'s');
        echo '<br />';
      }
      else {
        echo form_checkbox($group, $group, FALSE);
        echo form_label($group . '\'s');
        echo '<br />';
      }
    }
    ?>


  </div>

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

//<?php
//$user = new User_model;
//$user->print_userdata_inputs();
//?>