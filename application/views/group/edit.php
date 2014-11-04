<?php $group = new Group_model();
$group->validate_and_update_group();
?>


<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4">
      <form class="form" id="editgroup" action="#" method="post">
				<div id="edit_group_error"></div>
				<label>Name</label><br />
				<input name="name" id="edit_groupname" type="text"  placeholder="Group Name" value="<?php if(isset($old_name)) echo $old_name;?>"> <br />
				<label>Special Key</label><br />
				<input name="special_key"   type="text"  placeholder="Special Key" value="<?php if(isset($old_special_key)) echo $old_special_key;?>"> <br/>
				
				<button type="submit" id="submit" class="button">Save Group</button>
			</form>
  </div>
  <div class="col-xs-12 col-md-4"></div>
</div>