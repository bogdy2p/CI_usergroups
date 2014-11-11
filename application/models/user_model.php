<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function create() {
    $data = array(
      'username' => $this->input->post('username'),
      'first_name' => $this->input->post('first_name'),
      'last_name' => $this->input->post('last_name'),
      'email' => $this->input->post('email'),
      'password' => md5($this->input->post('password')),
      'creation_ip' => $this->session->userdata['ip_address'],
    );

    $this->db->set('creation_date', 'NOW()', FALSE);
    $insert = $this->db->inserT('users', $data);
    return $insert;
  }

  function create_user_dynamic_fields($fieldname) {
    $username = $this->input->post('username');
    $the_user_id = $this->user_model->grab_userid_by_username($username);
    $data = array(
      'user_id' => $the_user_id,
      'detail_type' => $fieldname,
      'detail' => $this->input->post($fieldname),
    );
    $insert = $this->db->insert('user_details', $data);
    return $insert;
  }

  function read() {
    $this->db->select('*');
    $this->db->from('users');
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row) {
      $return[] = $row;
    }
    return $return;
  }

  function check_old_password_is_correct($username, $password) {
    $this->db->where('username', $username);
    $this->db->where('password', md5($this->input->post('old_password')));
    $query = $this->db->get('users');
    if ($query->num_rows == 1) {
      return true;
    }
  }

  function update_password_for_username($username) {
    $data = array(
      'password' => md5($this->input->post('password')),
    );
    $this->db->where('username', $username);
    $this->db->update('users', $data);
  }

  function update_access_at_login(){
      $data = array(
        'last_ip_accessed' => $this->session->userdata['ip_address'],
      );
      $this->db->set('last_access_date', 'NOW()', FALSE);
      $this->db->where('username',$this->input->post('username'));
      $update = $this->db->update('users',$data);
      return $update;
  }
  
  
  function update() {
    $id = $this->input->post('id');
    $data = arraY(
      'first_name' => $this->input->post('first_name'),
      'last_name' => $this->input->post('last_name'),
    );

    $this->db->where('id', $id);
    $update = $this->db->update('users', $data);
    return $update;
  }

  function update_user_by_session() {
    $username = $this->session->userdata['username'];
    $data = arraY(
      'first_name' => $this->input->post('first_name'),
      'last_name' => $this->input->post('last_name'),
    );
    $this->db->where('username', $username);
    $update = $this->db->update('users', $data);
    return $update;
  }

  function update_user_fields_by_session($fieldname) {
    $user_id = $this->session->userdata['user_id'];
    $exists = $this->user_model->check_detail_pair_exists($user_id, $fieldname);

    if ($exists) {
      if (!empty($this->input->post($fieldname))) {
        $data = array('detail' => $this->input->post($fieldname),);
        $this->db->where('detail_type', $fieldname);
        $this->db->where('user_id', $user_id);
        $update = $this->db->update('user_details', $data);
        return $update;
      }
      else {
        //IF THE VALUE FROM THE FORM IS EMPTY (nothing entered , delete from database);
        $this->db->where('detail_type', $fieldname);
        $this->db->where('user_id', $user_id);
        $delete = $this->db->delete('user_details');
        return $delete;
      }
    }
    else {
      /// If it doesnt exist , run CREATE SCRIPT
      if (!empty($this->input->post($fieldname))) {
        $data = array(
          'user_id' => $user_id,
          'detail_type' => $fieldname,
          'detail' => $this->input->post($fieldname),
        );
        $insert = $this->db->insert('user_details', $data);
        return $insert;
      }
    }
  }

  function update_user_dynamic_field($fieldname) {
    $user_id = $this->input->post('id');
    $exists = $this->user_model->check_detail_pair_exists($user_id, $fieldname);
    if ($exists) {
      $data = array(
        'detail' => $this->input->post($fieldname),
      );
      $this->db->where('detail_type', $fieldname);
      $this->db->where('user_id', $user_id);
      $update = $this->db->update('user_details', $data);
      return $update;
    }
    else {
      if (!empty($this->input->post($fieldname))) {
        $data = array(
          'user_id' => $user_id,
          'detail_type' => $fieldname,
          'detail' => $this->input->post($fieldname),
        );
        $insert = $this->db->insert('user_details', $data);
        return $insert;
      }
    }
  }

  function update_user_details_for_user($user_id, $detail_type, $new_detail) {
    $data = array(
      'detail' => $new_detail,
    );
    $this->db->where('user_id', $user_id);
    $this->db->where('detail_type', $detail_type);
    $this->db->update('user_details', $data);
  }

  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('users');
  }

  function delete_user_detail_row($userid, $detailtype) {
    $this->db->where('user_id', $userid);
    $this->db->where('detail_type', $detailtype);
    $this->db->delete('user_details');
  }

  function validate_login() {
    $this->db->where('username', $this->input->post('username'));
    $this->db->where('password', md5($this->input->post('password')));
    $query = $this->db->get('users');

    if ($query->num_rows == 1) {
      return true;
    }
  }

  function add_user_detail_with_type($user_id, $detail_type, $detail) {
    $detail_exists = Self::check_detail_exists_of_type($user_id, $detail_type, $detail);
    $detail_type_exists = Self::check_detail_type_exists($detail_type);
    if ((!$detail_exists) && (!(is_null($detail))) && ($detail != ' ') && ($detail != '')) {
      if ($detail_type_exists) {
        $data = array('user_id' => $user_id, 'detail_type' => $detail_type, 'detail' => $detail,);
        $this->db->insert('user_details', $data);
      }
      else {
        echo "You cannot enter a detail which hasn't been predefined in the db";
      }
    }
    else {/* echo "Unable to add {$detail} : This detail already exists for this user / Is null !"; */
    }
  }

  function check_detail_exists($user_id, $detail) {
    $this->db->select('id');
    $this->db->from('user_details');
    $this->db->where('detail', $detail);
    $this->db->where('user_id', $user_id);
    $result = $this->db->count_all_results();
    if ($result == 0) {
      return false;
    }
    else {
      return true;
    }
  }

  function check_user_is_administrator($user) {
    $this->db->select('*');
    $this->db->from('usergroups');
    $this->db->where('group_id', '1');
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      if (Self::grab_userid_by_username($user) == $row['user_id']) {
        return true;
      }
    }
    return false;
  }

  function get_detail_types_set_for_user($user_id) {
    $this->db->select('detail_type');
    $this->db->from('user_details');
    $this->db->where('user_id', $user_id);
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row) {
      $return[] = $row['detail_type'];
    }
    return $return;
  }

  function check_detail_exists_of_type($user_id, $detail_type, $detail) {
    $exists = Self::check_detail_exists($user_id, $detail);
    if ($exists) {
      $already_set_details = Self::get_detail_types_set_for_user($user_id);
      if (in_array($detail_type, $already_set_details)) {
        return true;
      }
      else {
        return false;
      }
    }
    else {
      return false;
    }
  }

  //OLD VERSION YET
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

  function email_already_exists($email) {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('email', $email);
    $result = $this->db->count_all_results();
    if ($result == 0) {
      return false;
    }
    else {
      return true;
    }
  }

  function user_already_exists($name) {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('username', $name);
    $result = $this->db->count_all_results();
    if ($result == 0) {
      return false;
    }
    else {
      return true;
    }
  }

  function user_already_exists_by_id($id) {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('id', $id);
    $result = $this->db->count_all_results();
    if ($result == 0) {
      return false;
    }
    else {
      return true;
    }
  }

  function return_usercount() {
    $this->db->select('*');
    $this->db->from('users');
    $result = $this->db->count_all_results();
    return $result;
  }

  function get_number_of_groups_for_a_user($id) {
    $this->db->select('group_id');
    $this->db->from('usergroups');
    $this->db->where('user_id', $id);
    $result = $this->db->get();
    $groups_array = array();
    foreach ($result->result_array() as $row) {
      $groups_array[] = $this->get_group_name_by_id($row['group_id']);
    }
    return $groups_array;
  }

  function get_group_name_by_id($id) {
    $this->db->select('name');
    $this->db->from('groups');
    $this->db->where('id', $id);
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      return $row['name'];
    }
  }

  function get_user_name_by_user_id($id) {
    $this->db->select('username');
    $this->db->from('users');
    $this->db->where('id', $id);
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      return $row['username'];
    }
  }

  function grab_userid_by_username($name) {
    $this->db->select('id');
    $this->db->from('users');
    $this->db->where('username', $name);
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      return $row['id'];
    }
  }

  function grab_all_user_ids() {
    $this->db->select('id');
    $this->db->from('users');
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row) {
      $return[] = $row['id'];
    }
    return $return;
  }

  function get_userids_for_a_group($id) {
    $this->db->select('user_id');
    $this->db->from('usergroups');
    $this->db->where('group_id', $id);
    $return = array();
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      $return[] = $row['user_id'];
    }
    return $return;
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

  function get_total_logins($username){
    $this->db->select('total_logins');
    $this->db->from('users');
    $this->db->where('username',$username);
    $result = $this->db->get();
    foreach ($result->result_array() as $row){
      return $row['total_logins'];
    }
  }
  
  function update_total_logins($username,$old_logins_number){
    $data = array(
      'total_logins' => ($old_logins_number + 1),
    );
    $this->db->where('username',$username);
    $update = $this->db->update('users',$data);
    return $update;
  }
  
  
  function get_user_object($id) {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('id', $id);
    $result = $this->db->get();
    foreach ($result->result() as $user_object) {
      return $user_object;
    }
  }

  function get_user_object_by_username($username) {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('username', $username);
    $result = $this->db->get();
    foreach ($result->result() as $user_object) {
      return $user_object;
    }
  }

  function get_groups_checked_in_form() {
    //Grab an the array of all groups ind the db.
    $groups_from_db = Self::get_all_groups_in_db($_GET['id']);
    $names_of_groups_from_db = $groups_from_db['name'];
    $groups_selected = array();
    foreach ($names_of_groups_from_db as $group_name) {
      if (isset($_POST[$group_name])) {
        $groups_selected[] = $group_name;
      }
    }
    return $groups_selected;
  }

  function get_groupid_by_groupname($groupname) {
    $this->db->select('id');
    $this->db->from('groups');
    $this->db->where('name', $groupname);
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      return $row['id'];
    }
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

  function get_group_ids_checked_in_form() {
    $name_of_groups_array = Self::get_groups_checked_in_form();
    $array_of_group_ids_checked = array();
    foreach ($name_of_groups_array as $key => $value) {
      $array_of_group_ids_checked[] = Self::get_groupid_by_groupname($value);
    }
    return $array_of_group_ids_checked;
  }

  function get_detail_by_usr_and_type($user_id, $detail_type) {
    $this->db->select('detail');
    $this->db->from('user_details');
    $this->db->where('user_id', $user_id);
    $this->db->where('detail_type', $detail_type);
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      return $row['detail'];
    }
  }

  function get_all_groupnames_from_db() {
    $this->db->select('*');
    $this->db->from('groups');
    $result = $this->db->get();
    $group_names = array();
    foreach ($result->result_array() as $row) {
      $group_names[] = $row['name'];
    }
    return $group_names;
  }

  function get_all_groups_in_db() {
    $this->db->select('*');
    $this->db->from('groups');
    $result = $this->db->get();
    $groups_array = array();
    foreach ($result->result_array() as $row) {
      $groups_array['id'][] = $row['id'];
      $groups_array['name'][] = $row['name'];
    }
    return $groups_array;
  }

  function get_user_details_array($user_id) {
    $this->db->select('id');
    $this->db->from('user_details');
    $this->db->where('user_id', $user_id);
    $result = $this->db->get();
    $details_array = array();
    foreach ($result->result_array() as $row) {
      $details_array[] = $row['id'];
    }
    return $details_array;
  }

  function get_detail_data_by_detail_id($detail_id) {
    $this->db->select('*');
    $this->db->from('user_details');
    $this->db->where('id', $detail_id);
    $result = $this->db->get();
    $data = array();
    foreach ($result->result_array() as $row) {
      $data['type'] = $row['detail_type'];
      $data['value'] = $row['detail'];
    }
    return $data;
  }

  function get_userdata_details_availlable($user_id) {
    $already_set_details = array();
    $all_existing_detail_types = Self::get_all_user_detail_types();
    $user_details_ids = Self::get_user_details_array($user_id);
    foreach ($user_details_ids as $key => $value) {
      $already_set_details[$value] = Self::get_detail_data_by_detail_id($value)['type'];
    }
    foreach ($all_existing_detail_types as $individual_detail) {
      if (in_array($individual_detail, $already_set_details)) {
        $detail_value = Self::grab_detail_value_by_type_and_id($user_id, $individual_detail);
        Self::print_detail_inputs_with_value($individual_detail, $detail_value);
        $_POST[$individual_detail] = $detail_value;
      }
      else {
        Self::print_detail_inputs_without_value($individual_detail);
      }
    }
  }

  function grab_detail_value_by_type_and_id($id, $type) {
    $this->db->select('detail');
    $this->db->from('user_details');
    $this->db->where('user_id', $id);
    $this->db->where('detail_type', $type);
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      return $row['detail'];
    }
  }

  function print_detail_inputs_with_value($type, $detail) {
    echo '
			<label>' . $type . '</label></br>
			<input name="' . $type . '" type="text" placeholder="" value="' . $detail . '"></br>
			';
  }

  function print_detail_inputs_without_value($detail) {
    echo '
			<label>' . $detail . '</label></br>
			<input name="' . $detail . '" type="text" placeholder="" value=""></br>
			';
  }

  function verify_update_details_for_user($user_id) {
    // 1 . Grab all detail types array.
    // 2 . For each detail type , check POST [ that detail ] is set and is not null
    // 3 . Call the update function that UPDATES the values in the database with the values from the POST (input)
    $all_existing_detail_types = Self::get_all_user_detail_types();
    foreach ($all_existing_detail_types as $detail) {

      if (isset($_POST[$detail]) && (!empty($_POST[$detail]))) {
        $detail_pair_exists = Self::check_detail_pair_exists($user_id, $detail);
        if (!$detail_pair_exists) {
          $create_a_new = Self::add_user_detail_with_type($user_id, $detail, $_POST[$detail]);
        }
        else {
          
        }
        Self::update_user_details_for_user($user_id, $detail, $_POST[$detail]);
      }
      elseif (isset($_POST[$detail]) && (empty($_POST[$detail]))) {
        print_r($detail);
        Self::delete_user_detail_row($user_id, $detail);
      }
    }
  }

  function create_user_update_details_array($post_array) {
    $data = array(
      'id' => $post_array['id'],
      'username' => $post_array['username'],
      'password' => md5($post_array['password']),
    );
    return $data;
  }

  function delete_all_mapping_for_user($user_id) {
    $this->db->where('user_id', $user_id);
    $this->db->delete('usergroups');
  }

  function assign_user_to_group_by_name() {
    
  }

  function map_user_at_creation($user_name) {
    $this->load->model('group_model');
    $data = array(
      'user_id' => Self::grab_userid_by_username($user_name),
      'group_id' => $this->group_model->get_group_id_of_group_user(),
    );
    $this->db->insert('usergroups', $data);
  }

  function assign_user_to_group($user_id, $group_id) {
    $mapping_exists = Self::verify_existing_mapping($user_id, $group_id);
    if (!$mapping_exists) {
      Self::map_user_group($user_id, $group_id);
    }
    else {
      $username = Self::get_name_by_id($user_id, 'users');
      $groupname = Self::get_name_by_id($user_id, 'groups');
      die("'" . $username . "' is already into the '" . $groupname . "' Group!");
    }
  }

  function map_user_group($uid, $gid) {
    $data = array(
      'user_id' => $uid,
      'group_id' => $gid,
    );

    $this->db->insert('usergroups', $data);
  }

  function verify_existing_mapping($uid, $gid) {
    $this->db->select('*');
    $this->db->from('usergroups');
    $this->db->where('user_id', $uid);
    $this->db->where('group_id', $gid);
    $result = $this->db->count_all_results();
    if ($result >= 1) {
      return true;
    }
    else {
      return false;
    }
  }

  function check_detail_pair_exists($user_id, $detail_type) {
    $this->db->select('id');
    $this->db->from('user_details');
    $this->db->where('user_id', $user_id);
    $this->db->where('detail_type', $detail_type);
    $result = $this->db->count_all_results();
    if ($result >= 1) {
      return true;
    }
    else {
      return false;
    }
  }

  function get_table_of_users_and_number_of_detail_types() {
    $this->db->select('user_id', 'Count(user_id)');
    //$this->db->as('det_number');
    $this->db->from('user_details');
    $this->db->group_by('user_id');
    $this->db->order_by('Count(user_id)', 'DESC');
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      return $row['user_id'];
    }
  }

  /*   * ******************************************************************************* */
  /*   * *******************PRINT THE USER BASIC INFORMATION TABLE********************** */
  /*   * ******************************************************************************* */
  /*   * ******************************************************************************* */
  /*   * ******************************************************************************* */

  function print_user_information_table_html($user_id) {
    Self::print_user_information_table_header($user_id);
    $user = Self::get_user_object($user_id);
    $groups_array = Self::get_number_of_groups_for_a_user($user_id);
    Self::print_user_information_table_content($user, $groups_array);
    Self::print_user_information_table_footer();
  }

  function print_user_information_table_header($user_id) {
    //echo '<div class="col-xs-12 col-md-12">';
    echo '<h3> Userdata for user : ' . $user_id . '</h3>';
    echo '<table class="table table-bordered">';
    echo '<th class="col-xs-1 col-md-1" id="wordwrap">ID</th>';
    echo '<th class="col-xs-3 col-md-2" id="wordwrap">Name</th>';
    echo '<th class="col-xs-3 col-md-3" id="wordwrap">Password</th>';
    echo '<th class="col-xs-5 col-md-5" id="wordwrap">Is member of</th>';
  }

  function print_user_information_table_content($user, $groups_array) {
    echo '<tr>';
    echo '<td>' . $user->id . '</td>';
    echo '<td  id="wordwrap">' . $user->username . '</td>';
    echo '<td  id="wordwrap">' . $user->password . '</td>';
    echo' <td  id="wordwrap">' . implode(" / ", $groups_array) . '</td>';
    echo '</tr>';
  }

  function print_user_information_table_footer() {
    echo '</table>';
    //echo '</div>';
  }

  /*   * ******************************************************************************* */
  /*   * ******************************************************************************* */


  /*   * ******************************************************************************* */
  /*   * *******************PRINT THE USER DETAILS ATTACHED TABLE*********************** */
  /*   * **************************used into view_user.php****************************** */
  /*   * ******************************************************************************* */
  /*   * ******************************************************************************* */

  function print_user_details_information_table_html($user_id) {

    $user = new User();
    $user_details_ids = Self::get_user_details_array($user_id);
    if (!empty($user_details_ids)) {
      Self::print_user_details_information_table_header();
      Self::print_user_details_information_table_content($user_details_ids);
      Self::print_user_details_information_table_footer();
    }
    else {
      echo "<h3>This user has no details set.</h3>";
    }
  }

  function print_user_details_information_table_header() {
    echo "<h3>The details set for this user are :</h3>";
    echo "<br />";
    //echo '<div class="col-xs-2 col-md-2">';
    echo '<table class="table table-bordered">';
  }

  function print_user_details_information_table_content($user_details_ids) {
    foreach ($user_details_ids as $user_detail_id) {
      $detail = Self::get_detail_data_by_detail_id($user_detail_id);
      echo '<th class="col-xs-2 col-md-2">User ' . $_POST['id'] . '\'s ' . $detail['type'] . '</th>';
      echo '<tr><td class="col-xs-2 col-md-2">' . $detail['value'] . '</td></tr>';
    }
  }

  function print_user_details_information_table_footer() {
    echo '</table>';
    //echo '</div>'; 
  }

}
