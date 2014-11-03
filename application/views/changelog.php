<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo 'This is changealog view.';
echo '<hr>';

$test = new Changelog_model();
$days = '7';
$asd = $test->generate_changelog_table_html($days);
//echo '<pre>';
//$aaa = $test->read_for_last_x_days('5');
//var_dump($aaa);