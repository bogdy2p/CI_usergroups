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
   
    function update(){
      
    }
    
    function delete($name){
      $this->db->where('name', $name);
      $this->db->delete('user_detail_types'); 
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
}