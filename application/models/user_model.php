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
  function create($array,$table = 'users'){
    $data = array(
      'name'=>$array['name'],
      'password'=>$array['password'],
        );
    $this->db->insert($table,$data);
	}
    
  function read(){
    $this->db->select('*');
    $this->db->from('users');
    $result = $this->db->get();
    $return = array();
    foreach($result->result_array() as $row){
      $return[] = $row;
    }
    return $return;
 }
  
  function delete($id){
      $this->db->where('id', $id);
      $this->db->delete('users'); 
    }
 
 
 
  function validate_and_create(){
		$user = array();
		if(isset($_POST['name'])){ $user['name'] = $_POST['name']; }else{ $user['name'] = NULL; }  
		if(isset($_POST['password'])){ $user['password'] = $_POST['password']; }else{ $user['password'] = NULL; }
		if(isset($_POST['pass_conf'])){ $user['pass_conf'] = $_POST['pass_conf']; }else{ $user['pass_conf'] = NULL; }
    
		if(isset($user['name']) && isset($user['password'])) {
			if($_POST['password'] === $_POST['pass_conf']){
        $exists = Self::user_already_exists($user['name']);
          if ($exists == false){
              $detail_types = Self::get_all_user_detail_types();
              $enc_pass = md5($_POST['password']);
              $user['password'] = $enc_pass;
              $asd = Self::create($user);
              $user_id = Self::grab_userid_by_username($user['name']);
              
              foreach ($detail_types as $detail_type) {
								if(isset($_POST[$detail_type])){   
                      Self::add_user_detail_with_type($user_id,$detail_type,$_POST[$detail_type]);
								}
            	}
          }else
          {
              die("this username already exists !");
          }						
        header('Location: '.base_url().'user');
				die();
			}
			else{
				echo "ERROR : Passwords do not match ! Please re-enter !";
			}
		}
		 else{}
	}
  
  function add_user_detail_with_type($user_id,$detail_type,$detail){
		$detail_exists = Self::check_detail_exists_of_type($user_id,$detail_type,$detail);
		$detail_type_exists = Self::check_detail_type_exists($detail_type);
		if((!$detail_exists) && (!(is_null($detail))) && ($detail != ' ') && ($detail != '')){
			if($detail_type_exists){
          $data = array('user_id'=>$user_id, 'detail_type'=>$detail_type, 'detail'=>$detail,);
          $this->db->insert('user_details',$data);
			}else{
				echo "You cannot enter a detail which hasn't been predefined in the db";
			}
		}else{/*echo "Unable to add {$detail} : This detail already exists for this user / Is null !";*/}
	}
  
  
  function check_detail_exists($user_id,$detail){
    $this->db->select('id');
    $this->db->from('user_details');
    $this->db->where('detail',$detail);
    $this->db->where('user_id',$user_id);
    $result = $this->db->count_all_results();
    if ($result == 0){
       return false;
     }else{
       return true;
     }
	}
  function get_detail_types_set_for_user($user_id){
    $this->db->select('detail_type');
    $this->db->from('user_details');
    $this->db->where('user_id',$user_id);
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row){
      $return[] = $row['detail_type'];
    }
    return $return;
	}

  function check_detail_exists_of_type($user_id,$detail_type,$detail){
		$exists = Self::check_detail_exists($user_id,$detail);
		if($exists){
			$already_set_details = Self::get_detail_types_set_for_user($user_id);
			if(in_array($detail_type, $already_set_details)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
  //OLD VERSION YET
  function check_detail_type_exists($user_detail_type) {
    $this->db->select('id');
    $this->db->from('user_detail_types');
    $this->db->where('name',$user_detail_type);
    $result = $this->db->count_all_results();
    if ($result == 0){
       return false;
     }else{
       return true;
     }
  }
  
  function user_already_exists($name){
     $this->db->select('*');
     $this->db->from('users');
     $this->db->where('name',$name);
     $result = $this->db->count_all_results();
     if ($result == 0){
       return false;
     }else{
       return true;
     }
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
  
  function grab_userid_by_username($name){
    $this->db->select('id');
    $this->db->from('users');
    $this->db->where('name',$name);
    $result = $this->db->get();
    foreach ($result->result_array() as $row){
      return $row['id'];
    }
  }
  
  function get_all_user_detail_types() {
    $this->db->select('*');
    $this->db->from('user_detail_types');
    $return = array();
    $result = $this->db->get();
    foreach ($result->result_array() as $row){
      $return[] = $row['name'];
    }
    return $return;
	}
  
  
  
  function add_dynamic_user_detail_form_inputs(){
		$detail_types = Self::get_all_user_detail_types();
		foreach ($detail_types as $detail_type) {
			echo '<label>'.$detail_type.'</label><br />';
			echo '<input name="'.$detail_type.'" type="text" placeholder="enter '.$detail_type.'"';
				if(isset($_POST[$detail_type])){ echo 'value="'. $_POST[$detail_type] .'"> <br />'; }
				else{ echo 'value=""> <br />'; }
		}
	}
  
  function get_user_object($id){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('id',$id);
    $result = $this->db->get();
    foreach ($result->result() as $user_object){
      return $user_object;
    }
  }
  
  
  function print_userdata_inputs(){
		if(isset($_GET['id'])){
			$user = Self::get_user_object($_GET['id']); //Fetch the user object from the database
	echo '
		<p id="hideable_on_click">To change the password OR the username , <br /> you must know the old password !</p>
		<label>Name</label><br />
		<div id="edit_username_error"></div>
		<input name="name" id="edit_username" type="text"  placeholder="User Name" value="'.$user->name.'"> <br />
		<label>Enter current Password</label><br />
		<input name="old_password"  type="password"  placeholder="Old Password" value=""><br />
		<label>New Password</label><br />
		<input name="password"  type="password"  placeholder="New Password" value=""><br />
		<label>Confirm New Password</label><br />
		<input name="pass_conf" type="password"  placeholder="Confirm New Password" value=""><br />
    ';
	}
}
  
  function print_group_checkboxes_inputs(){
				$array_of_current_groups = Self::get_number_of_groups_for_a_user($_GET['id']);
				$groups_array = Self::get_all_groups_in_db();				
				$group_names = $groups_array['name'];
				$group_ids = $groups_array['id'];
				echo '<h3>This user is a member of: </h3><br />';
				foreach ($group_names as $group_name) {
					if (in_array($group_name, $array_of_current_groups)){
						echo '<input name="'.$group_name.'" type="checkbox" value="'.$group_name.'" checked>&nbsp;';
						echo '<label>'.$group_name.'\'s</label><br />';
					}else{
						echo '<input name="'.$group_name.'" type="checkbox" value="'.$group_name.'">&nbsp;';
						echo '<label>'.$group_name.'</label><br />';
					}
				} //end foreach
	}
  
  function get_all_groups_in_db() {
    $this->db->select('*');
    $this->db->from('groups');
    $result = $this->db->get();
    $groups_array = array();
    foreach ($result->result_array() as $row){
      $groups_array['id'][] = $row['id'];
      $groups_array['name'][] = $row['name'];
      }
    return $groups_array;
    }  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  /**********************************************************************************/
  /**********************************************************************************/
  /**********************************************************************************/
  /**********************************************************************************/
  /**********************************************************************************/
  
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
    $users = $user->read();
   
    foreach ($users as $individual_user) {
            $type = 'users';
            $userid = $individual_user['id'];
            $groups_array = $user->get_number_of_groups_for_a_user($userid);
                       echo '<tr>';
                       echo '<td class="success">'. $individual_user['id'] . '</td>';
                       echo '<td>'. $individual_user['name'] . '</td>';
                       echo '<td>'.  implode(" / ",$groups_array) . '</td>';
                       echo '<td><a href="'.base_url().'user/view_user?id='.$individual_user["id"].'"><span class="glyphicon glyphicon-eye-open"></span></td>';
                       echo '<td><a href="'.base_url().'user/edit?id='.$individual_user["id"].'&type='.$type.'"><span class="glyphicon glyphicon-edit spangre"></span></td>';
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