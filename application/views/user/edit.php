<?php
$user = new User_model();
$user->validate_and_save_user($_GET);

//print_r($_GET);
?>
<form class="form" id="edituser" action="<?php echo base_url() ?>user/edit?id=<?php echo $_GET['id']; ?>&type=users" method="post">
  <div class="row">
    <div class="col-xs-1 col-md-1"></div>
    <div class="col-xs-5 col-md-5">
      <h3>Userdata : </h3>
      <?php $user->print_userdata_inputs(); ?>		
    </div>
    <div class="col-xs-1 col-md-1"></div>
    <div class="col-xs-5 col-md-5">
      <?php $user->print_group_checkboxes_inputs(); ?>
    </div>
  </div>
  <br />
  <br />

  <div class="row">
    <div class="col-xs-1 col-md-1"></div>
    <div class="col-xs-10 col-md-10">


      <?php
      $user->get_userdata_details_availlable($_GET['id']);
      ?>

    </div>
    <div class="col-xs-1 col-md-1"></div>
  </div>
  <div class="row">	
    <div class="col-xs-4 col-md-4"></div>
    <div class="col-xs-2 col-md-2">
      <button type="submit" id="submit" class="button">Save User</button>
    </div>
    <div class="col-xs-6 col-md-6"></div>		
  </div>
</form>