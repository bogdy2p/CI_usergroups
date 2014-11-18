<?php

class Group_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function create() {
    $data = array(
      'name' => $this->input->post('name'),
      'special_key' => $this->input->post('special_key'),
    );
    $this->db->insert('groups', $data);
  }

  function read() {
    $this->db->select('*');
    $this->db->from('groups');
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row) {
      $return[] = $row;
    }
    return $return;
  }

  function update() {
    $old_name = $this->input->post('old_grp_name');
    $old_key = $this->input->post('old_grp_key');
    $a = $this->input->post('name');
    if (!empty($a)) {
      $data = array(
        'name' => $this->input->post('name'),
        'special_key' => $this->input->post('special_key'),
      );
    }
    else {
      $data = array(
        'special_key' => $this->input->post('special_key'),
      );
    }
    $this->db->where('name', $old_name);
    $this->db->update('groups', $data);
  }

  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('groups');
  }

  function get_group_object_by_id($id) {
    $this->db->select('*');
    $this->db->from('groups');
    $this->db->where('id', $id);
    $return = array();
    $result = $this->db->get();
    foreach ($result->result() as $row) {
      return $row;
    }
  }

  function grab_all_group_ids() {
    $this->db->select('id');
    $this->db->from('groups');
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row) {
      $return[] = $row['id'];
    }
    return $return;
  }

  function get_group_id_of_group_user() {
    $this->db->select('*');
    $this->db->from('groups');
    $this->db->where('name', 'user');
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      return $row['id'];
    }
  }

  function get_group_name_by_group_id($id) {
    $this->db->select('name');
    $this->db->from('groups');
    $this->db->where('id', $id);
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      return $row['name'];
    }
  }

  function group_already_exists($name) {
    $this->db->select('*');
    $this->db->from('groups');
    $this->db->where('name', $name);
    $result = $this->db->count_all_results();
    if ($result == 0) {
      return false;
    }
    else {
      return true;
    }
  }

  function return_groupcount() {
    $this->db->select('*');
    $this->db->from('groups');
    $result = $this->db->count_all_results();
    return $result;
  }

  function generate_groups_list_html() {
    echo "<h4>Already Existent Groups :</h4>";
    $groups = Self::read();
    $count = 0;
    echo '<ul class="list-inline">';
    foreach ($groups as $group) {
      $count += 1;
      $type = 'groups';
      echo '<li>';
      echo '' . $count . '-' . $group['name'] . '';
      echo '</li>';
    }
    echo '</ul>';
  }

}
