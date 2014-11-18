<?php

class Post_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function create() {
    $data = array(
      'title' => $this->input->post('post_title'),
      'content' => $this->input->post('post_content'),
      'user_id' => $this->session->userdata['user_id'],
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

  function read_for_user($user_id) {
    $this->db->select('*');
    $this->db->from('posts');
    $this->db->where('user_id', $user_id);
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row) {
      $return[] = $row;
    }
    return $return;
  }

  function read_last($number) {
    $this->db->select('*');
    $this->db->from('posts');
    $this->db->order_by('date_posted', 'DESC');
    $this->db->limit($number);
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row) {
      $return[] = $row;
    }
    return $return;
  }

  function print_poster_thumbnail($user_id) {
    $this->db->select('account_picture');
    $this->db->from('users');
    $this->db->where('id', $user_id);
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      if (!empty($row['account_picture'])) {
        return base_url() . 'uploads/account_pictures/thumbnails75/' . $row['account_picture'];
      }
      else {
        return 'http://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
      }
    }
  }

  function verify_message_ownership($user_id, $post_id) {
    $this->db->select('*');
    $this->db->from('posts');
    $this->db->where('id', $post_id);
    $this->db->where('user_id', $user_id);
    $result = $this->db->get();
    foreach ($result->result_array() as $row){
      return true;
    }
    return false;
  }

}
