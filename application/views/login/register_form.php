<div id="register_form">
  <?php if (isset($account_created)) { ?>
    <h3> <?php echo $account_created; ?> </h3>
  <?php }
  else {
    ?>
    <h1> Create Account </h1>
  <?php } ?>

  <?php
  echo form_open('user/validate_form_create_user');
  echo form_input('first_name', set_value('first_name'), 'placeholder = "First Name"');
  echo form_input('last_name', set_value('last_name'), 'placeholder = "Last Name"');
  echo form_input('email', set_value('email'), 'placeholder = "example@provider.com"');
  echo form_input('username', set_value('username'), 'placeholder = "Username"');
  echo form_input('password', '', 'placeholder="Password" class="password"');
  echo form_input('password_confirm', '', 'placeholder="Confirm Password" class="password"');
  echo '<br />';
  echo form_submit('submit', 'Create Account');
  ?>
  <?php echo validation_errors('<p class="error">'); ?>
</div><!-- end register form -->