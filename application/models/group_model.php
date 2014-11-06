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
    
   
   function update($id, $data){
    $groupname = Self::get_group_object_by_id($id)->name;
		$exists = Self::group_already_exists($groupname,'groups');
		if(($exists) && (!empty($data))) {
          //AICI FACI VERIFICARE IN FUNCTIE DE NAME
          if (isset($data['name'])){
            $data = array(
               'name' => $data['name'],
               'special_key' => $data['special_key'],
            );
          }else{
            $data = array(
               'special_key' => $data['special_key'],
            );
          }
          $this->db->where('id', $id);
          $this->db->update('groups', $data);
          
					}
          else 
            { die('Object id '.$id.'doesnt exist in db , table is incorrect , or params array is empty'); }    
    }
    
    function delete($id){
      $this->db->where('id', $id);
      $this->db->delete('groups'); 
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
			header('Location: '.base_url().'group');
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
    //die();

		if(isset($_POST['name']) && isset($_POST['special_key'])){
			$update_details = array(
					'id' => $_POST['id'],
					'name' => $_POST['name'],
					'special_key' => $_POST['special_key'],
					);			
      //VERIFICARE DACA NU EXISTA ALT GRUP CU ACELASI NUME DEJA , DACA EXISTA THROW AN ERROR
       $exists = Self::group_already_exists($_POST['name']);
       if ($exists == false){
          Self::update($_GET['id'],$update_details);
          header("Location: group");
       }else{ 
            unset($update_details['name']);
            Self::update($_GET['id'],$update_details);
            header("Location: group");
            }
			//header("Location: group");
			die();						
			}
	}else{ die("validation error");}
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
                  echo '<td><a href="'.base_url().'group/edit?id='.$individual_group["id"].'"><span class="glyphicon glyphicon-edit spangre"></td>';
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
    
    $groups = Self::read();
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