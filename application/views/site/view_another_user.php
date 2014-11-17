<?php
/* THE FLOW :
 * VIEW A USER IF YOU ARE LOGGED IN AS ANOTHER USER.
  ONLY DISPLAY INFORMATION LIKE ;
  USERNAME , USER PICTURE AND LAST NAME.
  USERNAME and LAST NAME should be IMAGES generated not text. (to avoid email spam)
 */
if (isset($_GET['username'])) {

  //echo "YOU DID IT RIGHT !";
  $username = $_GET['username'];
  $viewed_user = $this->user_model->get_user_object_by_username($username);
  //echo '<pre>';
  //var_dump($viewed_user);
  ?> 
  <div class="row">
    <div class="col-xs-12 col-md-3"></div>
    <div class="col-xs-12 col-md-3">
      <div class="account_info">
        <h4>View-ing user : <?php echo $viewed_user->username; ?></h4>  

        <p>First Name : <spanyel><b><?php echo $viewed_user->first_name ?></b></spanyel></p> 
        <p>Last Login : <spanyel><b><?php echo $viewed_user->last_access_date; ?></b></spanyel></p>

      </div>
    </div>
    <div class="col-xs-12 col-md-3 unpadded overflowhidden">
      <div class="account_picture_view_user">
        <h4>Profile Picture :</h4>
        <img class="image" src="<?php echo $this->user_model->get_account_picture_link($viewed_user->username); ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-md-4"></div>
    <div class="col-xs-12 col-md-4 ask_for_email">
      <br /><br /><br />
      ASK FOR EMAIL FUNCTIONALITY
      <!--// IMPLEMENT A SYSTEM TO BE ABLE TO ASK FOR THE USER'S EMAIL. (Somehow avoid web SCRAPING robots).-->
      <!--// IMPLEMENT A SYSTEM TO BE ABLE TO ASK FOR THE USER'S EMAIL. (Somehow avoid web SCRAPING robots).-->
      <!--// IMPLEMENT A SYSTEM TO BE ABLE TO ASK FOR THE USER'S EMAIL. (Somehow avoid web SCRAPING robots).-->
      <!--// IMPLEMENT A SYSTEM TO BE ABLE TO ASK FOR THE USER'S EMAIL. (Somehow avoid web SCRAPING robots).-->
      <!--// IMPLEMENT A SYSTEM TO BE ABLE TO ASK FOR THE USER'S EMAIL. (Somehow avoid web SCRAPING robots).-->
      <!--// IMPLEMENT A SYSTEM TO BE ABLE TO ASK FOR THE USER'S EMAIL. (Somehow avoid web SCRAPING robots).-->
      <!--// IMPLEMENT A SYSTEM TO BE ABLE TO ASK FOR THE USER'S EMAIL. (Somehow avoid web SCRAPING robots).-->
    </div>
    <div class="col-xs-12 col-md-4"></div>


  </div>

  <?php
}
else {
  redirect(base_url());
}