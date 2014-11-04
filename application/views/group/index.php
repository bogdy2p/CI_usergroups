<?php 
$test = new Group_model();

$array = array('name'=>'asdddsa','special_key'=>'4324234234');

//$test->create($array);
$test->generate_groups_table_html();


echo '<br />';

$asd = $test->group_already_exists('tester');
var_dump($asd);



?>


<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>