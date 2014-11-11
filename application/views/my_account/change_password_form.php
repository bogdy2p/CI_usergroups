
<h3>CHANGE YOUR PASSWORD</h3> 


<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4">
    <?php
    if (isset($custom_error)) {
      print_r($custom_error);
    }
    ?>
    <?php echo validation_errors('<p class="error">'); ?>
    <?php
    echo form_open('user/validate_form_change_password');
    echo form_label('Enter Old Password');
    echo '<br />';
    echo form_input('old_password', '', 'placeholder="Old Password" class="Password"');
    echo '<br />';
    echo form_label('New Password');
    echo '<br />';
    echo form_input('password', '', 'placeholder="Password" class="Password"');
    echo '<br />';
    echo form_label('Confirm New Password');
    echo '<br />';
    echo form_input('password_confirm', '', 'placeholder="Confirm Password" class="Password"');
    echo '<br /><br />';
    echo form_submit('submit', 'Change My Password', 'id="submit" class="btn btn-success"');
    echo form_close();
    ?>

  </div>
  <div class="col-xs-12 col-md-4"></div>

</div>