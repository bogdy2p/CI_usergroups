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
  <?php // echo '<h1>' . $username . '</h1>'; ?>
  <div class="col-xs-12 col-md-4">
    <h4>Account settings for  <?php echo $current_user->first_name . ' ' . $current_user->last_name; ?> </h4>
  </div>
  <div class="col-xs-12 col-md-4">
    <?php
    print_r("<h4>Account Level :");
    foreach ($groups_is_member as $group) {
      echo '<spanred> ' . $group . '</spanred>';
    }
    print_r(" .</h4>");
    ?>
  </div>
  <div class="col-xs-12 col-md-3">
    USER IMAGE ?!?! (should implement) ?
    USER IMAGE ?!?! (should implement) ?
    USER IMAGE ?!?! (should implement) ?
    USER IMAGE ?!?! (should implement) ?
    
  </div>
  <div class="col-xs-12 col-md-1"></div>
</div>


<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4"></div>
</div>

<br /><br />



