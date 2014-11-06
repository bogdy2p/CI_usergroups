<?php
  header('Content-Type: csv; charset=utf-8');
  header('Content-Disposition: attachment; filename=.csv');

  
  $filename = date('D-M-Y_:H:m:s') .'_CSV';
  $path_with_file = '/var/www/html/user_ci/temporary/'.$filename;
     
     $_POST['data'] = array(
                    'path'=> '/var/www/html/user_ci/temporary/',
                    'file_name'=> $filename.'.csv',
                    'data'=>array('ion','vasile'),
                  );
     $_POST['days'] = '3';        


    //var_dump($_POST);
    //var_dump($_GET);

    if ((isset($_POST['data'])) && isset($_POST['days'])){
      if (!empty($_POST['days'])){
          $changelog = new Changelog_model();
          //$changelog->export_changelog_data($_POST['data']); // EXPORT SHOULD GET AN ARRAY
          $query = $changelog->export_query($_POST['data']);
          var_dump($query->result());
          
            //echo ' File exported';
          }
    }else
      {
      //echo 'Nothing to export;';
      }
    
?>


<?php 
//$path = '/var/www/html/';
//$days = '3';
//$changelog->export_changelog_data($path,$filename,$days);
?>
