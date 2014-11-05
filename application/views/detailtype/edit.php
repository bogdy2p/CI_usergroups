<?php $detail = new Detail_type_model();

      if(isset($_POST['name']) && !empty($_POST['name'])) {
        $detail->validate_and_edit($_POST['name']);   
      }
      
?>
<div class="row"> <!--SECOND ROW -->
			<div class="col-xs-2 col-md-4"></div>
			<div class="col-xs-8 col-md-4"><h3>Edit detail type</h3></div>
			<div class="col-xs-2 col-md-4"></div>
		</div> <!--END SECOND ROW -->

		<div class="row"> <!--THIRD ROW -->
			<hr>
			<div class="col-xs-12 col-md-4"> <!--FIRST COLUMN -->
				<?php 
					$detaliu = $detail->get_detail_type_by_name($_GET['name']);
          //print_r($detaliu);
					$detail->print_edit_detail_table_html($detaliu['name']);
				?>
			</div> <!-- END FIRST COLUMN -->
			<div class="col-xs-12 col-md-4"> <!--SECOND COLUMN -->
				<div class="row">
							<?php 
								$detail->print_edit_existing_detail_form($_GET['name']);
							?>
				</div>
			</div> <!--END SECOND COLUMN -->
			<div class="col-xs-12 col-md-4"> <!--3rd COLUMN -->
				
			</div> <!--END THIRD COLUMN -->
			
		</div><!--END THIRD ROW -->