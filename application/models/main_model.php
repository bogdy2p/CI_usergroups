<?php

class Main_model extends CI_Model {
 
  function __construct()
    {
        parent::__construct();
    }
  
  function read($table_name){
    $this->db->select('*');
		$this->db->from($table_name);	
		$query = $this->db->get();
		return $query->result();
	 }
 
   //IN MODEL SUNT TREBURILE CU BAZA DE DATE.
 
   
   
   
   
   
   
   
   
}