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
    
   
   function update($id, $table, $update_params_array){
		$exists = Crud::verify_object_exists($id,$table);
		if(($exists) && (!empty($update_params_array))) {

				if ($table == 'users'){
							$statement = $this->db->prepare("UPDATE users SET name=?, password=? WHERE id=?");
							$statement->bindParam(1, $update_params_array['name']);
							$statement->bindParam(2, $update_params_array['password']);
							$statement->bindParam(3, $id);
						
									  }
				elseif ($table == 'groups'){

				$statement = $this->db->prepare("UPDATE groups SET id=?, name=?, special_key=? WHERE id=? ");
				$statement->bindParam(1, $update_params_array['id']);
				$statement->bindParam(2, $update_params_array['name']);
				$statement->bindParam(3, $update_params_array['special_key']);
				$statement->bindParam(4, $id);
				
					}
			$statement->execute();
		}else{
			echo("Object id {$id} doesnt exist in db , table is incorrect , or params array is empty <br />");
		}
	 }
   
   
   
   
   
   
   
   
   function validation_and_create(){
		$group = array();
		if(isset($_POST['name'])){ $group['name'] = $_POST['name']; }else{ $group['name'] = NULL; }
		if(isset($_POST['special_key'])){ $group['special_key'] = $_POST['special_key']; }else{ $group['special_key'] = NULL; }
		if(isset($group['name']) && isset($group['special_key'])) {
            $exists = Self::group_already_exists($group['name']);
            if($group['name'] != '' && ($exists == false)){
                  Self::create($group);
            }else{
              die('GroupName Is NULL / Already exists. Cannot Add');
            }
			header("Location: #");
			die();
		}
	}
   
  
function validate_and_update_group() {
	if(isset($_GET['id'])){
		$group = Self::get_group_object_by_id($_GET['id']);
		$group_id = $group->id; 
		$old_name = $group->name;
		$old_special_key = $group->special_key;
		$_POST['id'] = $_GET['id'];

		if(isset($_POST['name']) && isset($_POST['special_key'])){
		
			$group_update_details = array(
					'id' => $_POST['id'],
					'name' => $_POST['name'],
					'special_key' => $_POST['special_key'],
					);
			
			$update = $group->update($group_update_details['id'],'groups',$group_update_details);
			//header("Location: /user/views/view_list.php");
			die();						
			}
	}else{
    echo "GET DE ID IS NOT SET";
  }
}

  function get_group_object_by_id($id, $table_name = 'groups'){
    $this->db->select('*');
    $this->db->from('groups');
    $this->db->where('id',$id);
    $return = array();
    $result = $this->db->get();
    foreach ($result->result() as $row){
      $this->id = $row->id;
      $this->name = $row->name;
      $this->special_key = $row->special_key;
    }
   return $this;
	}
  
  
   function group_already_exists($name){
     $this->db->select('*');
     $this->db->from('groups');
     $this->db->where('name',$name);
     $result = $this->db->count_all_results();
     if ($result == 0){
       return false;
     }else{
       return true;
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
                  echo '<td><a href="group/edit?id='.$individual_group["id"].'&type='.$type.'"><span class="glyphicon glyphicon-edit spangre"></td>';
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