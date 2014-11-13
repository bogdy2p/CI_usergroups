<?php
/////////////////////////////TESTINGS//////////////////////////////////////
//$this->user_model->set_account_picture_link('admin','http://thepbc.go.ro/eroarea.jpg');
//$this->user_model->remove_account_picture('admin');
/////////////////////////////TESTINGS//////////////////////////////////////
?>
<br/><br/>

<div class="row">
  <div class="col-xs-12 col-md-4">
    <div class="upload_account_image">
      <?php
      echo form_open('user/blablabla');
      echo'<br/>';
      echo form_label('Choose an option below:');
      echo'<br/><br/><br/>';
      echo form_label('Enter direct image link');
      echo'<br/>';
      echo form_input('fds');
      echo'<br/><br/><br/>';
      echo form_label('Upload a local image file');
      echo'<br/>';
      echo form_upload('file');
      echo'<br/>';
      echo form_submit('submit', 'Save Image');
      echo form_close();
      echo'<br/>';
      ?>
    </div>
  </div>
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4">
    <div class="remove_account_image">

      Remove account image button

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




<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
1.IMAGE DISPLAY THE OLD PICTURE<br/>
2. FORM INPUT ANOTHER PICTURE<br/>
3. FORM SUBMIT FOR THE NEW PICTURE<br/>
4. DELETE BUTTON FOR THE ALREADY SET PICTURE
