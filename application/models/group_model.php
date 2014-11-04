<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Group_model extends CI_Model {
 
  function __construct()
    {
        parent::__construct();
    }
  
  function create($array,$table = 'groups'){
    $data = array(
      'name'=>$array['name'],
      'special_key'=>$array['special_key'], 
        );
    $this->db->insert($table,$data);
	}

  function read(){
    $this->db->select('*');
    $this->db->from('groups');
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row){
      $return[] = $row;
    }
    return $return;
	 } 
     
   function validation_and_create(){
		$group = array();
		if(isset($_POST['name'])){ $group['name'] = $_POST['name']; }else{ $group['name'] = NULL; }
		if(isset($_POST['special_key'])){ $group['special_key'] = $_POST['special_key']; }else{ $group['special_key'] = NULL; }

		if(isset($group['name']) && isset($group['special_key'])) {
            if($group['name'] != ''){
                  Self::create($group);
            }else{
              die('GroupName Is NULL. Cannot Enter');
            }
			header("Location: #");
			die();
		}
	}
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
  function generate_groups_table_html(){
    Self::generate_groups_table_header();
    Self::generate_groups_table_content();
    Self::generate_groups_table_footer();
}

  function generate_groups_table_header(){
    echo '<div class="col-xs-12 col-md-4">';
    echo "<h3>ALL GROUPS :</h3>";
    echo '<table class="table table-bordered">';
    echo '<th class="success">Id</th>';
    echo '<th class="success">Group Name</th>';
    echo '<th class="success">Special Key</th>';
    echo '<th class="success">Edit</th>';
    echo '<th class="success">Delete</th>';
  }
  function generate_groups_table_content(){
    $groups = Self::read();
    foreach ($groups as $individual_group) {
        $type = 'groups';
          echo '<tr>';
                  echo '<td class="warning">'. $individual_group['id'] . '</td>';
                  echo '<td>'. $individual_group['name'] . '</td>';
                  echo '<td>'. $individual_group['special_key'] . '</td>';
                  echo '<td><a href="../views/edit_group.php?id='.$individual_group["id"].'&type='.$type.'"><span class="glyphicon glyphicon-edit spangre"></td>';
                  echo '<td><a><span onclick="confirm_delete_group('.$individual_group["id"].')" class="glyphicon glyphicon-remove spanred pointer"></span></a></td>';
                  echo '</tr>';
      }
  }
  function generate_groups_table_footer(){
    echo '</table></div>';
  }

  function generate_groups_users_table_html(){
    Self::generate_groups_users_table_header();
    Self::generate_groups_users_table_content();
    Self::generate_groups_users_table_footer();
  }

  function generate_groups_users_table_header(){
    echo '<div class="col-xs-12 col-md-3">
        <h3>Users by group</h3>';
    echo '<table class="table table-bordered" name="groups_users">';
  }



  function generate_groups_users_table_content(){
    $user = new User();
    $group = new Group();
    $groups = Self::read();
    $groups = $group->list_groups();    
    foreach ($groups as $group) 
      {
        $userids_array = $user->get_userids_for_a_group($group['id']);	
        echo '<th class="info">'.$group["name"].'\'s</th>';
        echo '<th class="info">User ID</th>';
                  foreach ($userids_array as $key => $value) {
                    echo "<tr>";
                        print_r("<td>".$user->get_name_by_id($value)."</td>");
                        print_r("<td>".$value."</td>");
                    echo "</tr>";
                  }
      }
  }

  function generate_groups_users_table_footer(){
    echo "</table>
        </div>";
  }


  function generate_groups_table_list_html(){
    Self::generate_groups_table_list_header();
    Self::generate_groups_table_list_content();
    Self::generate_groups_table_list_footer();
  }

  function generate_groups_table_list_header(){
    echo '<div class="col-xs-12 col-md-12">';
    echo "<h4>Already Existent Groups :</h4>";
    echo '<table class="table table-bordered">';

  }
  function generate_groups_table_list_content(){
    $groups = Self::read();
    $count = 0;
    foreach ($groups as $group) {
        $count += 1;
        $type = 'groups';
          echo '<tr>';
                  echo ''.$count.'-'. $group['name'] . ' | &nbsp;';             
                  echo '</tr>';
      }
  }
  function generate_groups_table_list_footer(){
    echo '</table></div>';
  }  
  
}