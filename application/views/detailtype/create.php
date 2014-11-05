<?php $detail = new Detail_type_model();
  $detail->validate_and_add();

?>

<div class="row"> 
						<div class="col-xs-3 col-md-4"></div>
						<div class="col-xs-6 col-md-4">
              
              <?php $detail->print_add_new_user_detail_form(); ?>
            
            </div>
						<div class="col-xs-3 col-md-4"></div>
</div>
