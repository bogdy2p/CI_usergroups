<?php
$user = new User_model();
//$user->validate_and_create();
?>




<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-3">
    
    <?php echo validation_errors('<p class="error">'); ?>
    <?php
    echo form_open('user/validate_form_create_user');
    echo form_label('Email:');echo '<br />';
    echo form_input('email', set_value('email'), 'placeholder = "example@provider.com"');echo '<br />';
    echo form_label('First Name:');echo '<br />';
    echo form_input('first_name', set_value('first_name'), 'placeholder = "First Name"');echo '<br />';
    echo form_label('Last Name:');echo '<br />';
    echo form_input('last_name', set_value('last_name'), 'placeholder = "Last Name"');echo '<br />';
    
    echo form_label('Username:');echo '<br />';
    echo form_input('username', set_value('username'), 'placeholder = "Username"');echo '<br />';
    echo form_label('Password:');echo '<br />';
    echo form_input('password', '', 'placeholder="Password" class="password"');
    echo form_label('Confirm Password:');echo '<br />';
    echo form_input('password_confirm', '', 'placeholder="Confirm Password" class="password"');
    echo '<br /><br />';
    
    /// FOREACH HERE TO DISPLAY THE FIELDS THAT MUST BE ADDED BY MAPPING !
    /// HERE YOU MUST DISPLAY THE FIELDS WITH NO VALUE. ON THE EDIT , THERE WILL BE VALUE ONTO THE FIELDS.
       
    
    echo form_submit('submit', 'Create Account' ,'class="btn btn-success"');
    ?>
    
    
<!--    <form class="form" id="asd" action="#" method="post">
      <div id="name_error"></div>
      <label>name</label><br />
      <input name="username" id="name" type="text"  placeholder="enter desired name" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"> <br />
      <label>password</label><br />
      <input name="password" id="password" type="password"  placeholder="enter password" value=""> <br />
      <div id="password_error"></div>
      <label>confirm password</label><br />
      <input name="pass_conf" id="pass_conf" type="password"  placeholder="confirm password" value=""> <br />-->
<br />
<br />
<?php $user->add_dynamic_user_detail_form_inputs(); ?>
      <br />
      <!--<button type="submit" id="submit" class="btn btn-success" id="submit">Create User</button>-->

    <!--</form>-->
  </div>
  <div class="col-xs-12 col-md-4"></div>

</div> <!-- <div class="row"> -->

