<?php
if ((isset($this->session->userdata['is_logged_in'])) && (!empty($this->session->userdata))) {
   $username = $this->session->userdata['username'];
  if ((isset($this->session->userdata['admin_status'])) && ($this->session->userdata['admin_status'])) {
   
    display_administrator_menu($username);
  }
  else {
    display_normal_menu($username);
  }
}
else {
  display_no_session_menu();
}

function display_normal_menu($username) {
  //print_r($username);
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
                        
                              <li class="dropdown">
                                  <a class="dropdown-toggle" data-toggle="dropdown">My Account <span class="caret"></span></a>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="' . base_url() . 'user/my_account">View Account Data</a></li>
                                    <li><a href="' . base_url() . 'user/my_account_password">Change Password</a></li>
                                    <li><a href="' . base_url() . 'user/my_account_update_details">Change Details</a></li>
                                  </ul>
                             </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                       <li><a href="' . base_url() . 'user/logout"><span class="spanred">Log Out !</span></a></li>
                       </ul>
                        <p class="navbar-text navbar-right">Signed in as <a href="' . base_url() . 'user/my_account" class="navbar-link"><spangre>'.$username.'</spangre></a></p>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>';
}
function display_administrator_menu($username) {
  echo '            <nav class="navbar navbar-default " role="navigation">
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
                             <li class="dropdown">
                                  <a class="dropdown-toggle" data-toggle="dropdown">My Account <span class="caret"></span></a>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="' . base_url() . 'user/my_account">View Account Data</a></li>
                                    <li><a href="' . base_url() . 'user/my_account_password">Change Password</a></li>
                                    <li><a href="' . base_url() . 'user/my_account_update_details">Change Details</a></li>
                                  </ul>
                             </li>
                             <li><a href="' . base_url() . 'main/tables">   View Tables         </a></li>
                             <li><a href="' . base_url() . 'detail_type">   Details Types  </a></li>
                             <li><a href="' . base_url() . 'user">   Admin Users            </a></li>
                             <li><a href="' . base_url() . 'group">   Admin Groups           </a></li>
                             <li><a href="' . base_url() . 'changelog">   Changelogs     </a></li>
                             <li><a href="' . base_url() . 'task">   Manage Tasks    </a></li>
                         <!--<li><a href="' . base_url() . 'user/register"><span class="spanred">Register</span></a></li>
                             <li><a href="' . base_url() . 'user/login"><span class="spangre">Login</span></a></li> -->
                          <!--   <li><a href="' . base_url() . 'user/logout"><span class="spanred">Log Out !</span></a></li> -->
                        </ul>
                     
                       <ul class="nav navbar-nav navbar-right">
                       <li><a href="' . base_url() . 'user/logout"><span class="spanred">Log Out !</span></a></li>
                       </ul>
                       <p class="navbar-text navbar-right">Signed in as <a href="' . base_url() . 'user/my_account" class="navbar-link"> <spangre>'.$username.' </spangre></a></p>
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
                        <ul class="nav navbar-nav navbar-right">
                             <li><a href="' . base_url() . 'user/register"><span class="spanred">Register</span></a></li>
                             <li><a href="' . base_url() . 'user/login"><span class="spangre">Login</span></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
';
}
