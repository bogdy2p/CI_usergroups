<?php
$changelog = new Changelog_model();

?>

<div class ="container">
      <div class="row">
            <div class="col-xs-12 col-md-4">
              <a href="changelog/add">GOTO ADD NEW CHANGELOG</a>
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
          


<!-- 
      EXPORT CSV of CHANGELOGS IN FUNCTIE DE FILTRE.
      SORTARE LA TOATE TABELELE DUPA DATA / NUME ( HEADER )    
-->