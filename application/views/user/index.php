<div class="col-xs-12 col-md-4"></div>
<div class="col-xs-12 col-md-4">
  <a href="user/add">GOTO ADD NEW USER</a>
</div>
<div class="col-xs-12 col-md-4"></div>
<?php
$user = new User_model();
$user->generate_users_table_html();
?>

