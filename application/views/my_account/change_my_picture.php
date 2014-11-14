<?php
if (isset($error)) {
  echo $error;
}
?>

<div class="row">

  <div class="col-xs-12 col-md-2"></div>
  <div class="col-xs-12 col-md-4">
    <img class="account_picture" src="
    <?php
    $username = $this->session->userdata['username'];
    echo $this->user_model->get_account_picture_link($username);
    ?>
         ">
  </div>
  <div class="col-xs-12 col-md-3">
    <div class="upload_account_image">
      <?php
      echo form_open_multipart('user/validate_form_change_picture_by_file');
      echo form_label('Choose an image');
      ?>
      <input type="file" name="userfile" size="20" />
      <br />
      <input type="submit" name="submit" value="Upload Another" class="btn btn-success" />
      </form>
      <br />
    </div>
    <div class="remove_account_image">
      <?php
      echo form_open('user/validate_form_remove_account_picture');
      echo form_submit('submit', 'Remove Picture', 'class="btn btn-danger"');
      echo form_close();
      ?>
    </div>
  </div>
  <div class="col-xs-12 col-md-3">

  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4"></div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4"></div>
</div>