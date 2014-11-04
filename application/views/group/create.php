<?php 
$group = new Group_model();
$group->validation_and_create();
// VALIDATE AND ADD 
?>
<div class ="container">
	
		<div class="row"><?php $group->generate_groups_table_list_html();?></div>
		<div class="row">
				<div class="col-xs-4 col-md-4"></div>
				<div class="col-xs-4 col-md-4">
					<br />
					
					<form class="form" id="asd" action="#" method="post">
						<div id="group_error"></div>
						<label>group name</label><br />
						<input name="name" id="groupname" type="text"  placeholder="group name"> <br />
						<label>special key</label><br />
						<input name="special key"  type="text"  placeholder="special key"> <br />
						<br />
						<button type="submit" id="submit" class="btn btn-success">Create Group</button>
					</form>
				</div>
				<div class="col-xs-4 col-md-4"></div>
    </div>
      
</div>

<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>