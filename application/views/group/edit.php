<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4">


    <div id="edit_group_error"></div>
    <?php echo validation_errors('<p class="error">'); ?>
    <?php
    $asd = $this->group_model->get_group_object_by_id($this->input->get('id'));
    echo form_open('group/validate_form_update_group', 'id="editgroup"');
    echo form_label('Old Group Name: ' . $asd->name);
    echo form_hidden('old_grp_name', $asd->name);
    echo form_hidden('old_grp_key', $asd->special_key);
    echo '<br />';
    echo form_input('name', '', 'id="edit_groupname" placeholder ="New Group Name"');
    echo '<br />';
    echo form_label('Old special key : ' . $asd->special_key);
    echo '<br />';
    echo form_input('special_key', '', 'placeholder="New Special Key"');
    echo '<br /><br />';
    echo form_submit('submit', 'Save Group_FH', 'id="submit" class="btn btn-success"');
    echo '<br /><br />';
    echo form_close();
    ?>
  </div>
  <div class="col-xs-12 col-md-4"></div>
</div>