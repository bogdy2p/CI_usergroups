<?php
echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
  
    echo '<title>UserGroups on Codeigniter</title>';
    echo '<meta charset="utf-8">';
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';

      echo '<link href="'.base_url().'assets/css/bootstrap.css"       rel="stylesheet"  >';
      echo '<link href="'.base_url().'assets/css/bootstrap-theme.css" rel="stylesheet"  >';
      echo '<link href="'.base_url().'assets/css/style.css"           rel="stylesheet"  type="text/css">';
      echo '<script src="'.base_url().'assets/js/testuser.js"></script>';
      echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';

echo '</head>';

echo '<body>';
  echo '<div class ="container">';
   echo'   
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">';
   
   echo '                   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>        
                            <a class="navbar-brand" href="'.base_url().'">Home</a>
                    </div>                            
        ';
  echo ' 
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                             <li><a href="'.base_url().'main/tables">   View Tables         </a></li>
                             <li><a href="'.base_url().'">   User Details Types  </a></li>
                             <li><a href="'.base_url().'user">   USER            </a></li>
                             <li><a href="'.base_url().'group">   GROUP           </a></li>
                           <!--  <li><a href="'.base_url().'applog">   View App Logs       </a></li> -->
                             <li><a href="'.base_url().'changelog">   View Changelogs     </a></li>
                             <li><a href="'.base_url().'task">   Manage Todo\'s (tasks)    </a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
';