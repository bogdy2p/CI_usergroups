<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Task_model extends CI_Model {
 
  function read($table_name = 'todo_list'){
    $this->db->select('*');
    $this->db->from('todo_list');
    $this->db->order_by('date');
    $return = array();
    $result = $this->db->get();
    foreach ($result->result_array() as $row){
      $return[] = $row;
    }
    return $return;
	 }

	function create($name,$colour){
	  $data = array(
   'name' => $name,
   'colour' => $colour ,
    );
    $this->db->set('date', 'NOW()', FALSE);
    $this->db->insert('todo_list', $data); 
	}
  
  
}