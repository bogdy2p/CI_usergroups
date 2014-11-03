<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$test = new Changelog_model();
$test->validation_and_insertion_of_a_new_changelog();
echo '
	<div class ="container">
		<div class="row">
			<div class="col-xs-12 col-md-4"> ';
				$test->generate_changelog_add_new_form();
   echo '
			</div>
			<div class="col-xs-12 col-md-4 "> 	
				<h2>Latest Applied Changes:</h2>
			</div>
			<div class="col-xs-12 col-md-4">
	<!-- ****************************************************************************************************************   -->
  ';
			$test->generate_select_day_form();
 echo '
	<!-- *****************************************************************************************************************   -->	
			</div>
		</div>
		<div class ="row"> ';
				 $test->generate_changelog_table_by_post(); 
 echo '   
		</div>
		  		
		<div class="row">';
		  		 //Crud::print_color_meanings();
  echo'
		</div>
    </div>
           ';