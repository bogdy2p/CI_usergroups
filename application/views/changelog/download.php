<?php    
  download_changelog();   
     
  function download_changelog(){   
    if ((isset($_POST['days'])) && isset($_POST['filename'])){
      
      if ((!empty($_POST['days'])) && !empty($_POST['filename'])){
          
          $filename = $_POST['filename'];
          header('Content-Type: csv; charset=utf-8');
          header('Content-Disposition: attachment; filename='.$filename.'.csv');
          $filename = date('D-M-Y_:H:m:s') .'_CSV';
          $changelog = new Changelog_model();
          $query = $changelog->export_query();
          $data = $changelog->dbutil->csv_from_result($query);
          print_r($data);
          }
    }else
      {
      echo 'Nothing to export;';
      }
  }  
?>
