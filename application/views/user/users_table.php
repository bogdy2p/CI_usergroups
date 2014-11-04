<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
<?php
$user = new User_model();
$user->generate_users_table_html();
?>

