<?php
$task = new Task_model();
$task->validate_insert_new_task();
?>


<div class="container">
			
		<div class="row">
		
				<div class="col-xs-12 col-md-4"></div>
				<div class="col-xs-12 col-md-4">
					<?php $test = new Task_model();
            $test->generate_todo_add_new_form();        
          ?>
				</div>
				<div class="col-xs-12 col-md-4"></div>
				
		</div>
	

		<div class="row">
				<div class="col-xs-12 col-md-1"></div>
				<div class="col-xs-12 col-md-10">
					<?php 
            $test->generate_todo_list_html_admin(); ?>
				</div>
				<div class="col-xs-12 col-md-1"></div>
				
		</div>
	