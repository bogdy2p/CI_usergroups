<?php $username = $this->session->userdata['username']; ?>

<?php
echo '<h1>' . $username . '</h1>';
?>

Welcome to My Account View
<?php
echo '<pre>';
print_r($this->session->userdata);
echo '</pre>';
?>
