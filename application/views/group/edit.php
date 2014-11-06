<?php
$group = new Group_model();
$group->validate_and_update_group();
?>

<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4">
    <form class="form" id="editgroup" action="#" method="post">
      <div id="edit_group_error"></div>
      <label>Name</label><br />
      <input name="name" id="edit_groupname" type="text"  placeholder="<?php if (isset($group)) echo $group->name; ?>" value="<?php if (isset($group)) echo $group->name; ?>"> <br />
      <label>Special Key</label><br />
      <input name="special_key"   type="text"  placeholder="<?php if (isset($group)) echo $group->special_key; ?>" value="<?php if (isset($group)) echo $group->special_key; ?>"> <br/>
      <br />
      <button type="submit" id="submit" class="btn btn-success">Save Group</button>
    </form>
  </div>
  <div class="col-xs-12 col-md-4"></div>
</div>