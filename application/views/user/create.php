<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-3">

    <?php echo validation_errors('<p class="error">'); ?>
    <?php
    echo form_open('user/validate_form_create_user');
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
    echo '<p id="username_error"></p>';
    echo form_label('Username:');
    echo '<br />';
    echo form_input('username', set_value('username'), 'id="username" placeholder = "Username"');
    echo '<br />';
    echo form_label('Password:');
    echo '<br />';
    echo form_input('password', '', 'placeholder="Password" class="password"');
    echo '<br />';
    echo form_label('Confirm Password:');
    echo '<br />';
    echo form_input('password_confirm', '', 'placeholder="Confirm Password" class="password"');
    echo '<br />';

    $detail_types = $this->user_model->get_all_user_detail_types();
    
    foreach ($detail_types as $detail_type) {
      echo form_label(ucfirst($detail_type));
      echo '<br />';
      echo form_input($detail_type, set_value($detail_type), 'placeholder="' . ucfirst($detail_type) . '"');
      echo '<br />';
    }

    echo '<br />';

    echo form_submit('submit', 'Create Account', 'id="submit" class="btn btn-success"');
    ?>



  </div>
  <div class="col-xs-12 col-md-4"></div>

</div> <!-- <div class="row"> -->

