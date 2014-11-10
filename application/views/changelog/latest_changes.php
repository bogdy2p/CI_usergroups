<div class="row">
  <div class="col-xs-12 col-md-4 ">
    <?php $this->changelog_model->generate_select_export_form(); ?>
  </div>
  <div class="col-xs-12 col-md-4 "> 	
    <h2>Latest Applied Changes:</h2>
  </div>
  <div class="col-xs-12 col-md-4">
    <?php $this->changelog_model->generate_select_day_form(); ?>
  </div>
</div>