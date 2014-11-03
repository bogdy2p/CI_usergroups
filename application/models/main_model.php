<?php

class Main_model extends CI_Model {
 
  function read($table_name){
    $this->db->select('*');
		$this->db->from($table_name);	
		$query = $this->db->get();
		return $query->result();
	 }
 
   
 
   
   
   
   
   
   
   
   
}