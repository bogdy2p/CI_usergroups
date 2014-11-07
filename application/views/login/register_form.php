<div id="register_form">
  <?php if (isset($account_created)) { ?>
    <h3> <?php echo $account_created; ?> </h3>
  <?php }
  else { ?>
    <h1> Register New ACC </h1>
  <?php } ?>
 
  <?php
  echo form_open('register/validate_credentials');
  echo form_input('username', 'Username');
  echo form_password('password', '', 'placeholder="Password" class="Password"');
  echo '<br />';echo '<br />';
  echo form_submit('submit', 'Login');
  echo '<br /><br />';
  echo anchor('login/signup', 'Create Account');
  echo form_close();
  ?>

</div><!-- end login form -->