<?php
/////////////////////////////TESTINGS//////////////////////////////////////
//$this->user_model->set_account_picture_link('admin','http://thepbc.go.ro/eroarea.jpg');
//$this->user_model->remove_account_picture('admin');
/////////////////////////////TESTINGS//////////////////////////////////////
?>
<?php
if (isset($error)) {
  echo $error;
}
?>

<div class="row">

  <div class="col-xs-12 col-md-3">
    <img class="account_picture" src="
    <?php
    $username = $this->session->userdata['username'];
    if ($this->user_model->has_image_file_on_server($username)) {
      echo $this->user_model->get_account_picture_link($username);
    }
    else {
      echo 'http://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
    }
    ?>
         ">

  </div>
  <div class="col-xs-12 col-md-3">
    <div class="upload_account_image">
      <?php
//      echo form_open('user/validate_form_change_picture_by_link');
//      echo form_label('Enter direct image link');
//      echo'<br/>';
//      echo form_input('image_link');
//      echo'<br/><br/>';
//      echo form_submit('submit', 'Update By Link', 'class="btn btn-success"');
//      echo form_close();
//      echo'<br/>';
      ?>

    </div>
  </div>
  <div class="col-xs-12 col-md-3">
    <?php
    echo form_open_multipart('user/validate_form_change_picture_by_file');
    echo form_label('Choose an image');
    ?>
    <input type="file" name="userfile" size="20" />
    <br />
    <input type="submit" name="submit" value="Update by File" class="btn btn-success" />
    </form>


  </div>
  <div class="col-xs-12 col-md-3">
    <div class="remove_account_image">
      <?php
      echo form_open('user/validate_form_remove_account_picture');
      echo form_submit('submit', 'Remove Picture', 'class="btn btn-danger"');
      echo form_close();
      ?>
    </div>
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




<br/><br/><br/><br/><br/><br/>
1.IMAGE DISPLAY THE OLD PICTURE<br/>
2. FORM INPUT ANOTHER PICTURE<br/>
3. FORM SUBMIT FOR THE NEW PICTURE<br/>
4. DELETE BUTTON FOR THE ALREADY SET PICTURE
