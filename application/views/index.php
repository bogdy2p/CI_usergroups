<div class="container">
 
  
			<div class="row"><?php //Crud::print_sitewide_menu();?></div>
			
			<div class="row">
					 <div class="col-xs-12 col-md-4 "></div>
		  			 <div class="col-xs-12 col-md-4 "><h1>Users-Groups Administration CMS</h1></div>
		  			 <div class="col-xs-12 col-md-4 "></div>
	  		</div>

      
      <?php 
        $asd = $this->main_model->read('usergroups');
        ?>  

<!--	  		<div class="row">
			  		<hr>
				  	<div class="col-xs-12 col-md-3">
				  		<h2>Todo Tasks :</h2>
				  		<?php
                //$this->main_model->read('usergroups');
//                var_dump($test);
                
				  			//$test = new User();
				  			//$test->get_table_of_users_and_number_of_detail_types();
				  		?>
				  	</div>
				  	<div class="col-xs-12 col-md-6">
				  	 	<?php 
				  	 	//	$todo = new Todo();
				  	 		//$todo->generate_todo_list_html();
				  	 	?>
            </div>
					<div class="col-xs-12 col-md-3">
						<?php 
								//$user = new User();
							//	$user->get_database_statistics(); 
						?>
					</div>	
		  	</div>-->
		  	
		  	<div class="row">
		  			<?php //Crud::print_color_meanings(); ?>
		  	</div>
  </div>
     
    
	

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>


