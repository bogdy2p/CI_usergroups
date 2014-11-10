<?php
if ((isset($this->session->userdata['is_logged_in'])) && (!empty($this->session->userdata))){
  if ((isset($this->session->userdata['admin_status'])) && ($this->session->userdata['admin_status'])){
       display_administrator_menu();
    }else{
      display_normal_menu();  
    }
  }else{
    display_no_session_menu();  
  }

function display_normal_menu() {
  echo '<nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>        
                            <a class="navbar-brand" href="' . base_url() . '"><span class="spanyel">Home</span></a>
                    </div>                            

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                             <li><a href="' . base_url() . 'site">   View SITE         </a></li>
                     <!--    <li><a href="' . base_url() . 'user/login"><span class="spangre">Login</span></a></li>
                             <li><a href="' . base_url() . 'user/register"><span class="spanred">Register</span></a></li> -->
                             <li><a href="' . base_url() . 'user/logout"><span class="spanred">Log Out !</span></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>';
}

function display_administrator_menu() {
  echo '            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">

                   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>        
                            <a class="navbar-brand" href="' . base_url() . '"><span class="spanyel">Home</span></a>
                    </div>                            

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                             <li><a href="' . base_url() . 'site">   View SITE         </a></li>
                             <li><a href="' . base_url() . 'main/tables">   View Tables         </a></li>
                             <li><a href="' . base_url() . 'detail_type">   Details Types  </a></li>
                             <li><a href="' . base_url() . 'user">   USER            </a></li>
                             <li><a href="' . base_url() . 'group">   GROUP           </a></li>
                             <li><a href="' . base_url() . 'changelog">   View Changelogs     </a></li>
                             <li><a href="' . base_url() . 'task">   Manage Todo\'s (tasks)    </a></li>
                         <!--<li><a href="' . base_url() . 'user/register"><span class="spanred">Register</span></a></li>
                             <li><a href="' . base_url() . 'user/login"><span class="spangre">Login</span></a></li> -->
                             <li><a href="' . base_url() . 'user/logout"><span class="spanred">Log Out !</span></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
';
}

function display_no_session_menu() {
  echo '            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">

                   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>        
                            <a class="navbar-brand" href="' . base_url() . '"><span class="spanyel">Home</span></a>
                    </div>                            

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                             <li><a href="' . base_url() . 'user/register"><span class="spanred">Register</span></a></li>
                             <li><a href="' . base_url() . 'user/login"><span class="spangre">Login</span></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
';
}


