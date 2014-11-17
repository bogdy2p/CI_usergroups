<?php

class Post_model extends CI_Model {

  function __construct() {
    parent::__construct();
    
  }

  function create() {
    $data = array(
      'title' => $this->input->post('title'),
      'content' => $this->input->post('content'),
      'user_id' => 'user_id',
    );
    $this->db->set('date_posted', 'NOW()', FALSE);
    $insert = $this->db->inserT('posts', $data);
    return $insert;
  }

  function read() {
    $this->db->select('*');
    $this->db->from('posts');
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row) {
      $return[] = $row;
    }
    return $return;
  }

  function delete_post($id) {
    $this->db->where('id', $id);
    $this->db->delete('posts');
  }

}
