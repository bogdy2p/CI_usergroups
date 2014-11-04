
<div class="row">Foreach file in the folder , print a link with the file's name / FUNCTIONS OF THIS KIND?</div>
<div class="row">
        <a href="group/add">ADD NEW GROUP</a>
</div>  

<div class="row"></div>


<?php 
$test = new Group_model();


$array = array('name'=>'asdddsa','special_key'=>'4324234234');

$test->generate_groups_table_html();


echo '<br />';

$asd = $test->group_already_exists('tester');
//var_dump($asd);



?>


<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>