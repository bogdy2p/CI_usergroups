<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4">
    <?php
    if (isset($success_message)) {
      print_r($success_message);
    }
    ?></div>
  <div class="col-xs-12 col-md-4"></div>
</div> 

<?php
$username = $this->session->userdata['username'];
$current_user = $this->user_model->get_user_object_by_username($username);

$groups_is_member = $this->user_model->get_number_of_groups_for_a_user($current_user->id);
print_r("You currently belong to this groups :");
$contor = 1;
foreach ($groups_is_member as $group) {
  echo ' ' . $contor . ' - <spanred>' . $group . '</spanred>';
  $contor++;
}
print_r(" .");
?>
<br /><br />
<div class ="row">
  
  
  <div class="col-xs-12 col-md-2">A TABLE WITH ALL MY ACCOUNT DATA SHOULD BE PRINTED HERE</div>
  <div class="col-xs-12 col-md-2"></div>
  <div class="col-xs-12 col-md-2"></div>
  <div class="col-xs-12 col-md-2"></div>  
  <div class="col-xs-12 col-md-2"></div>  
  <div class="col-xs-12 col-md-2"></div>  
</div>



<br /><br />
<br /><br />






<?php
echo '<pre>';
print_r($current_user);
echo '</pre>';

echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';
echo '<br />';

echo '<h1>' . $username . '</h1>';
?>

Welcome to My Account View
<?php
//print_r($this->session->userdata);
?>
