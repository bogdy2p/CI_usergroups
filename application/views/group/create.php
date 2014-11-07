<div class ="container">

  <div class="row">
    <?php
    $group = new Group_model();
    $group->generate_groups_table_list_html();
    ?>
  </div>
  <div class="row">
    <div class="col-xs-4 col-md-4"></div>
    <div class="col-xs-4 col-md-4">
      <br />
      <!-- The div where to display the jQuery Error Message!-->
      <div id="group_error"></div>
      <?php echo validation_errors('<p class="error">'); ?>
      <?php
      echo form_open('group/validate_form_create_group', 'id="asd"');
      echo form_label('Add new Group');
      echo '<br />';
      echo form_input('name', '', 'id="groupname" placeholder ="Group Name"');
      echo '<br /><br />';
      echo form_input('special_key', '', 'placeholder="Special Key"');
      echo '<br /><br />';
      echo '<br /><br />';
      echo form_submit('submit', 'Create Group_FH', 'id="submit" class="btn btn-success"');
      echo '<br /><br />';
      echo form_close();
      ?>

    </div>
    <div class="col-xs-4 col-md-4"></div>
  </div>

</div>
