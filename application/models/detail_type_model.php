<?php

class Detail_type_model extends CI_Model {

  //Constructor function for class Detail_type_model.
  function __construct() {
    parent::__construct();
  }

  function create() {
    $data = array(
      'name' => $this->input->post('detail_name'),
    );
    $this->db->insert('user_detail_types', $data);
  }

  function read() {
    $this->db->select('*');
    $this->db->from('user_detail_types');
    $return = array();
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      $return[] = $row;
    }
    return $return;
  }

  function update() {
    $old_value = $this->input->post('old_detail_name');
    $data = array(
      'name' => $this->input->post('detail_name'),
    );
    $this->db->where('name', $old_value);
    $this->db->update('user_detail_types', $data);
  }

  function update_detail_types_names_in_user_groups() {
    $old_name = $this->input->post('old_detail_name');
    $new_name = $this->input->post('detail_name');

    $data = array(
      'detail_type' => $new_name,
    );
    $this->db->where('detail_type', $old_name);
    $this->db->update('user_details', $data);
  }

  function delete($name) {
    $this->db->where('name', $name);
    $this->db->delete('user_detail_types');
    $this->db->where('detail_type', $name);
    $this->db->delete('user_details');
    // HERE WE SHOULD DELETE ALSO FROM USER_DETAILS , THE ROWS THAT HAVE AS A DETAIL TYPE , the same NAME      
  }

  function get_all_user_detail_types() {
    $this->db->select('*');
    $this->db->from('user_detail_types');
    $return = array();
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      $return[] = $row['name'];
    }
    return $return;
  }

  function add_dynamic_user_detail_form_inputs() {
    $detail_types = Self::get_all_user_detail_types();
    foreach ($detail_types as $detail_type) {
      echo '<label>' . $detail_type . '</label><br />';
      echo '<input name="' . $detail_type . '" type="text" placeholder="enter ' . $detail_type . '"';
      if (isset($_POST[$detail_type])) {
        echo 'value="' . $_POST[$detail_type] . '"> <br />';
      }
      else {
        echo 'value=""> <br />';
      }
    }
  }

  function get_detail_type_by_name($name) {
    $this->db->select('*');
    $this->db->from('user_detail_types');
    $this->db->where('name', $name);
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row) {
      $return['id'] = $row['id'];
      $return['name'] = $row['name'];
    }
    return $return;
  }

  function check_detail_type_exists($user_detail_type) {
    $this->db->select('id');
    $this->db->from('user_detail_types');
    $this->db->where('name', $user_detail_type);
    $result = $this->db->count_all_results();
    if ($result == 0) {
      return false;
    }
    else {
      return true;
    }
  }

  function return_detailcount() {
    $this->db->select('id');
    $this->db->from('user_detail_types');
    $result = $this->db->count_all_results();
    return $result;
  }

}
