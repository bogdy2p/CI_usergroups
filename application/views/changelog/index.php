<?php
$changelog = new Changelog_model();
?>
<div class="row">
    <div class="col-xs-12 col-md-4"></div>
    
    <div class="col-xs-12 col-md-4">
                  <a href="changelog/add">GOTO ADD NEW CHANGELOG</a>
    </div>
    <div class="col-xs-12 col-md-4">
                  <?php 
                  $_POST['data'] = array(
                    'path'=>'/var/www/html/',
                    'filename'=>'asdfghjkl.csv',
                    'data'=>array ('ionut','vasile'),
                  );
                  ?>
                  <a href="changelog/download">DOWNLOAD CSV</a>
    </div>
    
</div>