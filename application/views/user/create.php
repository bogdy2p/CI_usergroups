<?php
  $user = new User_model();
  $user->validate_and_create();
?>
			<div class="row">
				<div class="col-xs-4 col-md-4"></div>
				<div class="col-xs-4 col-md-4">
					<br /><br />

					<form class="form" id="asd" action="#" method="post">
						<div id="name_error"></div>
						<label>name</label><br />
						<input name="name" id="name" type="text"  placeholder="enter desired name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>"> <br />
						<label>password</label><br />
						<input name="password" id="password" type="password"  placeholder="enter password" value=""> <br />
						<div id="password_error"></div>
						<label>confirm password</label><br />
						<input name="pass_conf" id="pass_conf" type="password"  placeholder="confirm password" value=""> <br />
						<?php $user->add_dynamic_user_detail_form_inputs(); ?>
						<br />
						<button type="submit" id="submit" class="btn btn-success" id="submit">Create User</button>

					</form>
				</div>
				<div class="col-xs-4 col-md-4"></div>
			
			</div> <!-- <div class="row"> -->

