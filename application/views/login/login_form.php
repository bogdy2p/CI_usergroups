<div id="login_form">
  <?php if (isset($account_created)) { ?>
    <h3> <?php echo $account_created; ?> </h3>
  <?php }
  else {
    ?>
    <h1> Login, please. </h1>
  <?php } ?>

  <?php
  echo form_open('user/validate_credentials_and_login');
  echo form_input('username', 'Username');
  echo form_password('password', '', 'placeholder="Password" class="Password"');
  echo '<br />';
  echo '<br />';
  echo form_submit('submit', 'Login');
  echo '<br /><br />';
  echo anchor('user/register', 'Create Account');
  echo "<br /><br />";
  echo anchor('user/forgot_password', 'Forgot Password ?');
  echo form_close();
  ?>

</div><!-- end login form -->