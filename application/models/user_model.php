<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User_model extends CI_Model {
 
    function __construct()
    {
        parent::__construct();
    }
     
  function grab_all_users(){
    $this->db->select('*');
    $this->db->from('users');
    $result = $this->db->get();
    $return = array();
    foreach($result->result_array() as $row){
      $return[] = $row;
    }
    return $return;
 }
   
  function get_number_of_groups_for_a_user($id){
    $this->db->select('group_id');
    $this->db->from('usergroups');
    $this->db->where('user_id',$id);
    $result = $this->db->get();
    $groups_array = array();
    foreach ($result->result_array() as $row){
      $groups_array[] = $this->get_name_by_id($row['group_id'],'groups');
    }
    return $groups_array;
  }
 
  function get_name_by_id($id,$table_name){
    $this->db->select('name');
    $this->db->from($table_name);
    $this->db->where('id',$id);
    $result = $this->db->get();
    foreach ($result->result_array() as $row){
      return $row['name'];
    }
	}
  
  function generate_users_table_html(){
    Self::generate_users_table_header();
    Self::generate_users_table_content();
    Self::generate_users_table_footer();
  }

  function generate_users_table_header(){
		echo '<div class="col-xs-12 col-md-8">';
		echo "<h3>ALL USERS : </h3>";
		echo '<table class="table table-bordered" id="users_table">';
		echo '<th class="danger">ID</th>';
		echo '<th class="danger">User Name</th>';
		echo '<th class="danger">Groups of Belonging</th>';
		echo '<th class="danger">View</th>';
		echo '<th class="danger">Edit</th>';
		echo '<th class="danger">JAVASCRIPT Del</th>';
  }
  
  function generate_users_table_content(){
    $user = new User_model();
    $users = $user->grab_all_users();
   
    foreach ($users as $individual_user) {
            $type = 'users';
            $userid = $individual_user['id'];
            $groups_array = $user->get_number_of_groups_for_a_user($userid);
                       echo '<tr>';
                       echo '<td class="success">'. $individual_user['id'] . '</td>';
                       echo '<td>'. $individual_user['name'] . '</td>';
                       echo '<td>'.  implode(" / ",$groups_array) . '</td>';
                       echo '<td><a href="../views/view_user.php?id='.$individual_user["id"].'"><span class="glyphicon glyphicon-eye-open"></span></td>';
                       echo '<td><a href="../views/edit_user.php?id='.$individual_user["id"].'&type='.$type.'"><span class="glyphicon glyphicon-edit spangre"></span></td>';
                       echo '<td><a><span class="glyphicon glyphicon-remove spanred pointer" onclick=confirm_delete_user('.$individual_user["id"].');></span></td>';
                       echo '</tr>';
            }
}
  function generate_users_table_footer(){
    echo '</table></div>';
  }


/**********************************************************************************/
/*********************PRINT THE USER BASIC INFORMATION TABLE***********************/
/**********************************************************************************/
/**********************************************************************************/
/**********************************************************************************/
	function print_user_information_table_html($user_id){
		print_user_information_table_header($user_id);
		$user = new User();
		$user->get_user_object_by_id($user_id);
		$groups_array = $user->get_number_of_groups_for_a_user($user_id);
		print_user_information_table_content($user,$groups_array);
		print_user_information_table_footer();
	}

	function print_user_information_table_header($user_id){
		echo '<div class="col-xs-12 col-md-12">';
		echo '<h3> Userdata for user : '.$user_id.'</h3>';
		echo '<table class="table table-bordered">';
			echo '<th class="col-xs-1 col-md-1" id="wordwrap">ID</th>';
			echo '<th class="col-xs-3 col-md-2" id="wordwrap">Name</th>';
			echo '<th class="col-xs-3 col-md-3" id="wordwrap">Password</th>';
			echo '<th class="col-xs-5 col-md-5" id="wordwrap">Is member of</th>';
	}

	function print_user_information_table_content($user,$groups_array){
			echo '<tr>';
		  echo '<td>'. $user->id .'</td>';
			echo '<td  id="wordwrap">'. $user->name . '</td>';
			echo '<td  id="wordwrap">'. $user->password . '</td>';
			echo' <td  id="wordwrap">'.  implode(" / ",$groups_array) . '</td>';	
		    echo '</tr>';
	}

	function print_user_information_table_footer(){
		echo '</table></div>';
	}
/**********************************************************************************/
/**********************************************************************************/


/**********************************************************************************/
/*********************PRINT THE USER DETAILS ATTACHED TABLE************************/
/****************************used into view_user.php*******************************/
/**********************************************************************************/
/**********************************************************************************/

	function print_user_details_information_table_html($user_id){
			
			$user = new User();
			$user_details_ids = $user->get_user_details_array($user_id);
			if(!empty($user_details_ids)){
				print_user_details_information_table_header();
				print_user_details_information_table_content($user_details_ids);
				print_user_details_information_table_footer();
			}else{
				echo "<h3>This user has no details set.</h3>";
			}
	}

	function print_user_details_information_table_header(){
		echo "<h3>The details set for this user are :</h3>";
        echo "<br />";
		echo '<div class="col-xs-2 col-md-2">';
        echo '<table class="table table-bordered">';
	}

	function print_user_details_information_table_content($user_details_ids){
			$user = new User();
		foreach ($user_details_ids as $user_detail_id) {
			$detail = $user->get_detail_data_by_detail_id($user_detail_id);
			echo '<th class="col-xs-2 col-md-2">User '.$_POST['id'] . '\'s ' . $detail['type'] .'</th>';							
			echo '<tr><td class="col-xs-2 col-md-2">'. $detail['value'] .'</td></tr>';
		}  
	}

	function print_user_details_information_table_footer(){
		echo '</table>';
		echo '</div>'; 
	}
/**********************************************************************************/
/**********************************************************************************/
  
}