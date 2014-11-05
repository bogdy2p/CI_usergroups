<?php 
  $user = new User_model();
?>
<form class="form" id="edituser" action="../models/edit_user_model.php?id=<?php echo $_GET['id'];?>&type=users" method="post">
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

							<!-- <h3>ADD FUNCTIONALITY TO EDIT USER CORRESPONDING DETAILS</h3> -->
							<!-- <h4>phone , etc ,, for each detail type availlable (must be DYNAMIC)</h4> -->
							<?php
								  
								$user->get_userdata_details_availlable($_GET['id']); 
								/// VERIFY IF INPUTS EXIST , AND IF EXIST , UPDATE WITH THE INFORMATION IN THE POST.


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