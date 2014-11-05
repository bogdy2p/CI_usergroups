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
   
  function update($data_array){
    $exists = Self::user_already_exists_by_id($data_array['id']);
		if(($exists) && (!empty($data_array))) {
      $data = array('name'=>$data_array['name'],'password'=>$data_array['password'],);
      $this->db->where('id',$data_array['id']);
      $this->db->update('users',$data);
		}else{
			echo("User with id : {$id} doesnt exist  !");
		}
	 }

  function update_user_details_for_user($user_id,$detail_type,$new_detail){
    $data = array(
                 'detail' => $new_detail,
              );
    $this->db->where('user_id', $user_id);
    $this->db->where('detail_type', $detail_type);
    $this->db->update('user_details', $data); 
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
  
  function validate_and_save_user($get) {
	
	if(isset($get) && ($get != NULL))
		{ 
			//$user = new User(); //Call User Class
			$user = Self::get_user_object($get['id']); //Fetch the user object from the database by the ID !!
			$old_pass = $user->password; // Grab the old password from the object
			$old_name = $user->name;			
			$_POST['id'] = $get['id'];
					if(isset($_POST['old_password'])) { 
							if(!empty($_POST['old_password'])) {
									if(md5($_POST['old_password']) == $old_pass){
											if($_POST['password'] == $_POST['pass_conf']) {
                        
												//Create the update details array using the post data.																		
												$user_update_details = Self::create_user_update_details_array($_POST);                        
												//Update the user details correspondingly
												$update = Self::update($user_update_details);
												//Delete all the mapping for this user			
												$delete_current_mapping = Self::delete_all_mapping_for_user($get['id']);
												//Get an array of checked groups in the form
												$group_ids_checked_array = Self::get_group_ids_checked_in_form();
												//Apply new mapping using the new values from the form !!!! (Foreach in one line)
												$test = Self::verify_update_details_for_user($get['id']);
												foreach ($group_ids_checked_array as $group_id_checked) {Self::assign_user_to_group($get['id'],$group_id_checked);}
												header('Location: '.base_url().'user');		
												die();						
											}else{
												print_r("The passwords you entered do not match.");
                        die();
											}
									}else{
										echo "That is not the current password for this user !";
										die();
									}
							}	
							 else  {//If field OLD PASSWORD IS EMPTY
							 		$delete_current_mapping = Self::delete_all_mapping_for_user($get['id']);
							 		$group_ids_checked_array = Self::get_group_ids_checked_in_form();
							 		$test = Self::verify_update_details_for_user($get['id']);
							 		foreach ($group_ids_checked_array as $group_id_checked) {Self::assign_user_to_group($get['id'],$group_id_checked);}
							 		header('Location: '.base_url().'user');
								 	die();
									}

					}else 	{
							echo "";
							//If $_POST does not exists (@ the first page load , before submit)
							}
		}
	else{
		die("There is no get. Or it's NULL // 404 Redirect Here !");
		}
} //end Verification
  
  
  
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
   
   function user_already_exists_by_id($id){
     $this->db->select('*');
     $this->db->from('users');
     $this->db->where('id',$id);
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
      $groups_array[] = $this->get_group_name_by_id($row['group_id']);
    }
    return $groups_array;
  }
 
  function get_group_name_by_id($id){
    $this->db->select('name');
    $this->db->from('groups');
    $this->db->where('id',$id);
    $result = $this->db->get();
    foreach ($result->result_array() as $row){
      return $row['name'];
    }
	}
  
  function get_user_name_by_user_id($id){
    $this->db->select('name');
    $this->db->from('users');
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
  function grab_all_user_ids() {
    $this->db->select('id');
    $this->db->from('users');
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row){
      $return[] = $row['id'];
    }
    return $return;
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
  
  function get_groups_checked_in_form(){
    //Grab an the array of all groups ind the db.
    $groups_from_db = Self::get_all_groups_in_db($_GET['id']);
    $names_of_groups_from_db = $groups_from_db['name'];
    $groups_selected = array();
    foreach ($names_of_groups_from_db as $group_name) {
      if (isset($_POST[$group_name])){
        $groups_selected[] = $group_name;
      }
    }
    return $groups_selected;
  }
  
  function get_groupid_by_groupname($groupname){
    $this->db->select('id');
    $this->db->from('groups');
    $this->db->where('name',$groupname);
    $result = $this->db->get();
    foreach ($result->result_array() as $row){
      return $row['id'];
    }
	}
  
  
  function get_group_ids_checked_in_form(){
    $name_of_groups_array = Self::get_groups_checked_in_form();
    $array_of_group_ids_checked = array();
      foreach ($name_of_groups_array as $key => $value) {
        $array_of_group_ids_checked[] = Self::get_groupid_by_groupname($value);	
      }
    return $array_of_group_ids_checked;
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
				}
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
  
  function get_user_details_array($user_id) {
    $this->db->select('id');
    $this->db->from('user_details');
    $this->db->where('user_id',$user_id);
    $result = $this->db->get();
    $details_array = array();
    foreach ($result->result_array() as $row){
      $details_array[] = $row['id'];
    }
    return $details_array;
	}  
  
  function get_detail_data_by_detail_id($detail_id) {
    $this->db->select('*');
    $this->db->from('user_details');
    $this->db->where('id',$detail_id);
    $result = $this->db->get();
    $data = array();
    foreach ($result->result_array() as $row){
      $data['type'] = $row['detail_type'];
      $data['value'] = $row['detail'];
    }
    return $data;
	}	
    
  function get_userdata_details_availlable($user_id){
 		$already_set_details = array(); 
		$all_existing_detail_types = Self::get_all_user_detail_types();
		$user_details_ids = Self::get_user_details_array($user_id);
 		foreach ($user_details_ids as $key => $value) {		
 			$already_set_details[$value] = Self::get_detail_data_by_detail_id($value)['type'];
  		}
  		foreach ($all_existing_detail_types as $individual_detail) {
  				if(in_array($individual_detail, $already_set_details)){
  					$detail_value = Self::grab_detail_value_by_type_and_id($user_id,$individual_detail);
  					Self::print_detail_inputs_with_value($individual_detail,$detail_value);
  					$_POST[$individual_detail] = $detail_value;
  				}else{
  					Self::print_detail_inputs_without_value($individual_detail);
  				}
  		}
}

function grab_detail_value_by_type_and_id($id,$type){
  $this->db->select('detail');
  $this->db->from('user_details');
  $this->db->where('user_id',$id);
  $this->db->where('detail_type',$type);
  $result = $this->db->get();
  foreach($result->result_array() as $row){
    return $row['detail'];
  }
}

function print_detail_inputs_with_value($type,$detail){
		echo '
			<label>'.$type.'</label></br>
			<input name="'.$type.'" type="text" placeholder="" value="'.$detail.'"></br>
			';
}
function print_detail_inputs_without_value($detail){
		echo '
			<label>'.$detail.'</label></br>
			<input name="'.$detail.'" type="text" placeholder="" value=""></br>
			';
}
  
  function verify_update_details_for_user($user_id){
    // 1 . Grab all detail types array.
    // 2 . For each detail type , check POST [ that detail ] is set and is not null
    // 3 . Call the update function that UPDATES the values in the database with the values from the POST (input)
    $all_existing_detail_types = Self::get_all_user_detail_types();
    foreach ($all_existing_detail_types as $detail) {

      if(isset($_POST[$detail]) && (!empty($_POST[$detail]))){
        $detail_pair_exists = Self::check_detail_pair_exists($user_id,$detail);
        if (!$detail_pair_exists){
          $create_a_new = Self::add_user_detail_with_type($user_id,$detail,$_POST[$detail]);
        }else{}
        Self::update_user_details_for_user($user_id,$detail,$_POST[$detail]);
      }
    }
  }


  
function create_user_update_details_array($post_array){
	$data = array(
		'id' => $post_array['id'],
		'name' => $post_array['name'],
		'password' => md5($post_array['password']),
    
		);
		return $data;
}  
  
 function delete_all_mapping_for_user($user_id){
      $this->db->where('user_id',$user_id);
      $this->db->delete('usergroups');
		}
  
  function assign_user_to_group($user_id,$group_id){
		$mapping_exists = Self::verify_existing_mapping($user_id,$group_id);
		if(!$mapping_exists){
			Self::map_user_group($user_id,$group_id);
		}else{
			$username = Self::get_name_by_id($user_id,'users');
			$groupname = Self::get_name_by_id($user_id,'groups');
			die("'".$username."' is already into the '" .$groupname. "' Group!");
		}
	}

	function map_user_group($uid,$gid){
    $data = array(
      'user_id'=>$uid,
      'group_id'=>$gid,
      );
    
    $this->db->insert('usergroups', $data); 
	}

	function verify_existing_mapping($uid,$gid){
    $this->db->select('*');
    $this->db->from('usergroups');
    $this->db->where('user_id',$uid);
    $this->db->where('group_id',$gid);
    $result = $this->db->count_all_results();
     if ($result >= 1){
       return true;
     }else{
       return false;
     }
	}  
    
    
    
  function check_detail_pair_exists($user_id,$detail_type){
    $this->db->select('id');
    $this->db->from('user_details');
    $this->db->where('user_id',$user_id);
    $this->db->where('detail_type',$detail_type);
     $result = $this->db->count_all_results();
     if ($result >= 1){
       return true;
     }else{
       return false;
     }
	}


  
  
  /**********************************************************************************/
  /*******************************USER DETAILS TABLE**********************************/
  /**********************************************************************************/
  /**********************************************************************************/
  /**********************************************************************************/ 
    
  function print_user_details_table_html($user_details_array){
    Self::print_user_details_table_header();
    Self::print_user_details_table_content($user_details_array);
    Self::print_user_details_table_footer();
  }

  function print_user_details_table_header(){
    echo '<table class="table table-bordered">';
    echo '<th> Current User Details Set</th>';
    echo '<th> Edit</th>';
    echo '<th> Delete</th>';
  }
  function print_user_details_table_content($user_details_array){
    foreach ($user_details_array as $key => $value) {
      echo '<tr>';
      echo '<td>'.$value.'</td>';
      echo '<td> <a href="#?name='.$value.'"><span class="glyphicon glyphicon-edit"></span></a>  </td>';
      echo '<td><a><span onclick="confirm_detail_type_delete(\''.$value.'\')" class="glyphicon glyphicon-remove spanred pointer"></span></a></td>';
      echo '</tr>';
    }
  }
  function print_user_details_table_footer(){
    echo '</table>';
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
		Self::print_user_information_table_header($user_id);
		$user = Self::get_user_object($user_id);
		$groups_array = Self::get_number_of_groups_for_a_user($user_id);
		Self::print_user_information_table_content($user,$groups_array);
		Self::print_user_information_table_footer();
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
			$user_details_ids = Self::get_user_details_array($user_id);
			if(!empty($user_details_ids)){
				Self::print_user_details_information_table_header();
				Self::print_user_details_information_table_content($user_details_ids);
				Self::print_user_details_information_table_footer();
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
		foreach ($user_details_ids as $user_detail_id) {
			$detail = Self::get_detail_data_by_detail_id($user_detail_id);
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