<div class="row"> <!--SECOND ROW -->
  <div class="col-xs-2 col-md-4"></div>
  <div class="col-xs-8 col-md-4"><h3>Edit detail type " <?php echo $_GET['name']; ?> " </h3></div>
  <div class="col-xs-2 col-md-4"></div>
</div> <!--END SECOND ROW -->

<div class="row"> <!--THIRD ROW -->
  <hr>
  <div class="col-xs-12 col-md-4"> <!--FIRST COLUMN -->
  </div> <!-- END FIRST COLUMN -->
  <div class="col-xs-12 col-md-4"> <!--SECOND COLUMN -->
    <div id="edit_detail_type_error"></div>
    <div class="row">
      <?php echo validation_errors('<p class="error">'); ?>
      <?php
      echo form_open('detail_type/validate_form_update_detail?name='.$this->input->get('name'), 'id="add_new_detail_form"');
      echo form_label('Update Detail : ' . $this->input->get('name'));
      echo '<br />';
      echo form_hidden('old_detail_name', $this->input->get('name'));
      echo form_input('detail_name', '', 'id="detail_name" placeholder ="New Detail Name"');
      echo '<br /><br />';
      echo form_submit('submit', 'Update detail', 'id="submit" class="btn btn-success"');
      echo '<br /><br />';
      echo form_close();
      ?>
    </div>
  </div> <!--END SECOND COLUMN -->
  <div class="col-xs-12 col-md-4"> <!--3rd COLUMN -->

  </div> <!--END THIRD COLUMN -->

</div><!--END THIRD ROW -->