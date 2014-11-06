<?php
    var_dump($_POST);
    var_dump($_GET);

    if (isset($_POST['data'])){
    $changelog = new Changelog_model();
    $changelog->export_changelog_data($_POST['data']); // EXPORT SHOULD GET AN ARRAY
      echo ' File exported';
    }else{
      echo 'Nothing to export;';
    }
    
?>


<?php 
//$filename = date('D/M/Y :H:m:s') .'_CSV'; //The name of the csv file.
//header('Content-Type: text/csv; charset=utf-8');
//header('Content-Disposition: attachment; filename='.$filename.'.csv');



$path = '/var/www/html/';
$days = '3';
//$changelog->export_changelog_data($path,$filename,$days);
?>


 <br /><br /><br /> <br /><br /><br />
SELECT CSV PERIOD TO DOWNLOAD <br />
THIS IS DOWNLOAD SHOULD HAVE A BUTTON , <br />AND FUNCTIONALITY TO DOWNLOAD CSV FROM DB USING FILTERS