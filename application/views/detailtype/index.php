<?php
$detail = new Detail_type_model();
?>
<div class="row"> <!--SECOND ROW -->
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4"><h3>User Detail Types</h3></div>
  <div class="col-xs-12 col-md-4"></div>
</div> <!--END SECOND ROW -->
<div class='row'><!--THIRD ROW -->
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4">
    <a href="detail_type/add" >ADD NEW DETAIL TYPE</a>
  </div>
  <div class="col-xs-12 col-md-4"></div>
</div><!--END THIRD ROW -->

<div class="row"> <!--FOURTH ROW -->
  <hr>
  <div class="col-xs-12 col-md-3"> <!--FIRST COLUMN -->
    <?php
    $detail_types_array = $detail->get_all_user_detail_types();
    $detail->print_user_details_table_html($detail_types_array);
    ?>
  </div> <!-- END FIRST COLUMN -->
  <div class="col-xs-12 col-md-3"> <!--SECOND COLUMN -->
  </div> <!--END SECOND COLUMN -->
  <div class="col-xs-12 col-md-3"> <!--3rd COLUMN -->        
  </div> <!--END THIRD COLUMN -->
  <div class="col-xs-12 col-md-3"> <!--4th COLUMN -->
  </div> <!--END FOURTH COLUMN -->
</div><!--END FOURTH ROW -->
