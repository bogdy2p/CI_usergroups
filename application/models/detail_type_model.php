<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Detail_type_model extends CI_Model {
 
  	//Constructor function for class Changelog.
   function __construct()
    {
        parent::__construct();
    }
    
    function create($name){
    $data = array(
      'name' => $name,
      );  
    $this->db->insert('user_detail_types', $data); 
    }
    
   function read(){
    $this->db->select('*');
    $this->db->from('user_detail_types');
    $return = array();
    $result = $this->db->get();
    foreach ($result->result_array() as $row){
      $return[] = $row;
    }
    return $return;
	 }
   
	 function update($old_value,$new_value){
     $data = array(
       'name'=>$new_value,
     );
      $this->db->where('name',$old_value);
      $this->db->update('user_detail_types',$data);
    }
 
  function update_detail_types_names_in_user_groups($old_name,$new_name){
      $data = array(
        'detail_type' => $new_name,
      );
      $this->db->where('detail_type',$old_name);
      $this->db->update('user_details',$data);
	}
    
    function delete($name){
      $this->db->where('name', $name);
      $this->db->delete('user_detail_types');
      $this->db->where('detail_type',$name);
      $this->db->delete('user_details');
     // HERE WE SHOULD DELETE ALSO FROM USER_DETAILS , THE ROWS THAT HAVE AS A DETAIL TYPE , the same NAME      
  }
  
  function validate_and_add(){
      if(isset($_POST['detail_name'])){
        if(!empty($_POST['detail_name'])){
            $detail = $_POST['detail_name'];
            Self::create($detail);
            header('Location: '.base_url().'detail_type');
        }else{
          echo "<h3>You cannot create a empty detail!<br /></h3>";
          echo '<h3><a href="'.base_url().'detail_type">Go Back</a></h3>';
          die();
        }
      }else{}
  } 
  
function validate_and_edit(){
	if(isset($_POST['name'])){
		if(!empty($_POST['name'])){
      $data = array('name'=> $_POST['name'],);
      print_r($data);
      Self::update($_GET['name'],$_POST['name']);
			Self::update_detail_types_names_in_user_groups($_GET['name'],$_POST['name']);
			header('Location: '.base_url().'detail_type');
			die('errz');
		}else{
			echo '$_post is set but EMPTY';
			header('Location: '.base_url().'detail_type');
		}
	}else{/*echo "NO POST";*/}
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
  
  function print_add_new_user_detail_form(){
	echo '
			<form class="form" id="add_new_detail_form" action="add" method="post">
				<label>Add Detail Type</label><br />
					<div id="detail_type_error"></div>
					<input name="detail_name" id="detail_name" type="text"  placeholder="new detail type"> <br />
					<br />
					<button type="submit" id="submit" class="btn btn-success">Add new Detail</button>
			</form>
	';
}

  function print_edit_existing_detail_form($name){
	echo '
			<form class="form" id="edit_existing_detail_form" action="edit?name='.$_GET['name'].'" method="post">
				<label>Change detail name for "'.$name.'" </label><br />
					<div id="edit_detail_type_error"></div>
					<input name="name" id="new_name" type="text"  placeholder="change detail name"> <br />
					<br />
					<button type="submit" id="submit" class="btn btn-success">Save </button>
			</form>
	';
}

  function get_detail_type_by_name($name){
    $this->db->select('*');
    $this->db->from('user_detail_types');
    $this->db->where('name',$name);
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row){
      $return['id'] = $row['id'];
      $return['name'] = $row['name'];
    }
    return $return;
	}
  
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
 
   
   function return_detailcount(){
     $this->db->select('id');
     $this->db->from('user_detail_types');
     $result = $this->db->count_all_results();
     return $result;
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
      echo '<td> <a href="'.base_url().'detail_type/edit?name='.$value.'"><span class="glyphicon glyphicon-edit"></span></a>  </td>';
      echo '<td><a><span onclick="confirm_detail_type_delete(\''.$value.'\')" class="glyphicon glyphicon-remove spanred pointer"></span></a></td>';
      echo '</tr>';
    }
  }
  function print_user_details_table_footer(){
    echo '</table>';
  }
  
  /**************************************************************************************/
  function print_edit_detail_table_html($name){
    Self::print_edit_detail_table_header($name);
		Self::print_edit_detail_table_content($name);
		Self::print_edit_detail_table_footer();	
  }
  function print_edit_detail_table_header($name){
    echo '<div class="col-xs-12 col-md-12">
        <h4>Current data for "'.$name.'" detail </h4>';
    echo '<table class="table table-bordered" name="view_detail">';
  }
  function print_edit_detail_table_content($name){
     $details = Self::get_detail_type_by_name($name);
     foreach ($details as $key => $value) {
      echo '<tr>';
      echo '<th class="info"> Detail '.$key.'</th>';
      echo '<td>'.$value.'</td>';	 	
      echo '</tr>';
     }
  }
  function print_edit_detail_table_footer(){
    echo "</table>
        </div>";
  }  
}