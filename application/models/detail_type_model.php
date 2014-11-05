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
    
    function delete_detail_type($name){
      $this->db->where('name', $name);
      $this->db->delete('user_detail_types'); 
  }
    
}