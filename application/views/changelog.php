<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo 'This is changealog view.';

$test = new Changelog_model();
$asd = $test->read();
echo '<pre>';
var_dump($asd);


//$test->create_changelog_row('vasile', 'red');