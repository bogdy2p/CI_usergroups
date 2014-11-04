<div class="container">
			
		<div class="row">
		
				<div class="col-xs-12 col-md-4"></div>
				<div class="col-xs-12 col-md-4">a
					<?php //generate_todo_add_new_form(); 
          
          $test = new Task_model();
          $asd = $test->read();
          var_dump($asd);
          
          $test->create('1','2');
          
          
          ?>
				</div>
				<div class="col-xs-12 col-md-4"></div>
				
		</div>
	

		<div class="row">
				<div class="col-xs-12 col-md-1"></div>
				<div class="col-xs-12 col-md-10">b
					<?php //generate_todo_list_html_admin(); ?>
				</div>
				<div class="col-xs-12 col-md-1"></div>
				
		</div>
	