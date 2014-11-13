<div class="row"> 
  <div class="col-xs-3 col-md-4"></div>
  <div class="col-xs-6 col-md-4">
    <div id="detail_type_error"></div>
    <?php echo validation_errors('<p class="error">'); ?>
    <?php
    echo form_open('detail_type/validate_form_create_detail', 'id="add_new_detail_form"');
    echo form_label('Add New DetailType');
    echo '<br />';
    echo form_input('detail_name', '', 'id="detail_name" placeholder ="New Detail Name"');
    echo '<br /><br />';
    echo form_submit('submit', 'Add New Detail_FH', 'id="submit" class="btn btn-success"');
    echo '<br /><br />';
    echo form_close();
    ?>
  </div>
  <div class="col-xs-3 col-md-4"></div>
</div>
