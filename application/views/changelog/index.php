<?php
$changelog = new Changelog_model();
$changelog->validation_and_insertion_of_a_new_changelog();
?>

<div class ="container">
      <div class="row">
            <div class="col-xs-12 col-md-4">
                        <?php	$changelog->generate_changelog_add_new_form(); ?>
            </div>
            <div class="col-xs-12 col-md-4 "> 	
                      <h2>Latest Applied Changes:</h2>
            </div>
            <div class="col-xs-12 col-md-4">
                        <?php	$changelog->generate_select_day_form(); ?>
            </div>
      </div>
      <div class ="row">
                    <?php $changelog->generate_changelog_table_by_post();  ?>
      </div>
</div>
          
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>


<!-- 
      EXPORT CSV of CHANGELOGS IN FUNCTIE DE FILTRE.
      SORTARE LA TOATE TABELELE DUPA DATA / NUME ( HEADER )    
-->