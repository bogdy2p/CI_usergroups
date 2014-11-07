<div id="register_form">
  <?php if (isset($account_created)) { ?>
    <h3> <?php echo $account_created; ?> </h3>
  <?php }
  else { ?>
    <h1> Create Account </h1>
  <?php } ?>
 
  <?php
  echo form_open('register/create_user');
  echo form_input('first_name', set_value('first_name','First Name'));
  echo form_input('last_name', set_value('last_name','Last Name'));
  echo form_input('email', set_value('email','Email Adress'));
  echo form_input('username', set_value('username','Username'));
  echo form_input('password','', 'placeholder="Passowrd" class="password"');
  echo form_input('password_confirm','', 'placeholder="Confirm Passowrd" class="password"');
  echo '<br />';
  echo form_submit('submit','Create Account');


  //echo form_close();
  ?>
  <?php echo validation_errors('<p class="error">'); ?>
</div><!-- end register form -->