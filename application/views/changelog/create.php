<?php $changelog = new Changelog_model();
      $changelog->validation();
?>

<div class="row">
  <div class="col-xs-12 col-md-4"></div>
  <div class="col-xs-12 col-md-4">
      <?php $changelog->generate_changelog_add_new_form(); ?>
  </div>
  <div class="col-xs-12 col-md-4"></div>  
</div>





