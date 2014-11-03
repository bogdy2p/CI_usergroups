<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Changelog_model extends CI_Model {
 
  	//Constructor function for class Changelog.
   function __construct()
    {
        parent::__construct();
    }
    
	 function create($array,$table = 'app_changelog'){
		return parent::create($array,$table);
	}
  
  //CODEIGNITER
	function read($table_name = 'app_changelog'){
    $this->db->select('*');
    $this->db->from($table_name);
    $this->db->order_by('date');
    $return = array();
    $result = $this->db->get();
    foreach ($result->result_array() as $row){
      $return[] = $row;
    }
    return $return;
  }
  
	 function create_changelog_row($name,$colour){
     
    $data = array('name' => $name,'colour' => $colour,);
    $this->db->set('date', 'NOW()', FALSE);
    $this->db->insert('app_changelog', $data);
   }
     
  function read_changelogs_for_last_24_hours(){
    $this->db->select('*');
    $this->db->from('app_changelog');
    $this->db->where('date >= NOW() - INTERVAL 1 DAY ORDER BY date DESC');
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row){
      $return[] = $row;
    }
    return $return;
	}
  
//CODEIGNITER ?
	function read_changelogs_for_last_x_days($days = '0'){
    $this->db->select('*');
    $this->db->from('app_changelog');
    $this->db->where('date >= NOW() - INTERVAL '.$days.' DAY', '', false); 
    $this->db->order_by('date DESC');
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row){
      $return[] = $row;
    }
    return $return;
    
//    
//		$this->db = new Database();
//	 	$this->db = $this->db->dbConnect();
//	  	$statement = $this->db->prepare("SELECT * FROM app_changelog WHERE date >= CURDATE() - ? ORDER BY date DESC");
//	  	$statement->bindParam(1,$days);
//	  	$statement->execute();
//	  	// print_r($statement);
//	  	return $statement;
	}

  
  
  
}