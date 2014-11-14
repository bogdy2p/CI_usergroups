<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4"><?php
    if (isset($success_message)) {
      print_r($success_message);
    }
    ?></div>
  <div class="col-xs-12 col-md-4"></div>
</div> 

<?php
$username = $this->session->userdata['username'];
$current_user = $this->user_model->get_user_object_by_username($username);
$groups_is_member = $this->user_model->get_number_of_groups_for_a_user($current_user->id);
?>

<div class ="row">
  <div class="col-xs-12 col-md-4">
    <div class="account_info">
      <h4>Account Information:</h4>  
      <p>Username : <spanyel><b><?php echo $current_user->username; ?></b></spanyel></p>
      <p>First Name : <spanyel><b><?php echo $current_user->first_name ?></b></spanyel></p> 
      <p>Last Name : <spanyel><b><?php echo $current_user->last_name; ?></b></spanyel></p>
      <p>Last Login : <spanyel><b><?php echo $current_user->last_access_date; ?></b></spanyel></p>
      <p>From : <spanyel><b><?php echo $current_user->last_ip_accessed; ?></b></spanyel></p>
      <p>Total Logins : <?php echo $current_user->total_logins; ?></p>
      <p></p>
      <p></p>
    </div>
  </div>
  <div class="col-xs-12 col-md-4">
    <div class="account_level_information">
      <?php
      print_r("<h4>Account Level :");
      foreach ($groups_is_member as $group) {
        echo '<spanred> ' . $group . '</spanred>';
      }
      print_r(" .</h4>");
      ?>
    </div>
  </div>
  <div class="col-xs-12 col-md-4 unpadded overflowhidden">
    <div class="account_picture">
      <img class="image" src="<?php echo $this->user_model->get_account_picture_link($this->session->userdata['username']); ?>">
      <a class="button" href="my_account_change_picture">Change</a>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4"></div>
</div>

<br /><br />



