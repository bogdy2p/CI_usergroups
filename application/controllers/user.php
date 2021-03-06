<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('user_model');
  }

  public function index() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('user/table');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function login() {
    if (!isset($this->session->userdata['is_logged_in'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('user/login_form');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      redirect('user', 'refresh');
    }
  }

  public function logout() {
    if ((isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in']))) {
      $this->session->sess_destroy();
      redirect('site', 'refresh');
    }
    else {
      show_404();
    }
  }

  public function validate_credentials_and_login() {

    $this->load->model('user_model');
    $query = $this->user_model->validate_login();

    if ($query) { // DACA S-A VALIDAT CU SUCCESS
      $username = $this->input->post('username');
      $data = array(
        'username' => $username,
        'user_id' => $this->user_model->grab_userid_by_username($username),
        'admin_status' => $this->user_model->check_user_is_administrator($username),
        'is_logged_in' => true,
      );
      $this->session->set_userdata($data);
      $this->user_model->update_access_at_login();
      $old_logins_number = $this->user_model->get_total_logins($username);
      $this->user_model->update_total_logins($username, $old_logins_number);
      redirect('site/index');
    }
    else { // Credentials INCORRECT
      $this->login_failed();
    }
  }

  public function register() {
    if (!isset($this->session->userdata['is_logged_in'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('user/register_form');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      redirect(index_page());
    }
  }

  public function forgot_password() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('templates/site_menu');
    $this->load->view('user/forgot_password');
    $this->load->view('templates/sitewide_footer');
  }

  public function validate_form_create_user() {
    //FORM VALIDATION
    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[18]');
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('email', 'Email Adress', 'trim|required|valid_email||min_length[6]|is_unique[users.email]');
    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|is_unique[users.username]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
    $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required|matches[password]');
    $detail_types = $this->user_model->get_all_user_detail_types();
    foreach ($detail_types as $detail_type) {
      $this->form_validation->set_rules($detail_type, ucfirst($detail_type), 'trim|min_length[2]');
    }

    if ($this->form_validation->run() == FALSE) { // validation failed
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('user/create');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      $this->load->model('user_model');

      if ($query = $this->user_model->create()) {

        $username = $_POST['username'];
        $this->user_model->map_user_at_creation($username);
        foreach ($detail_types as $fieldname) {
          $this->user_model->create_user_dynamic_fields($fieldname);
        }
        $data['account_created'] = 'Your account has been created.';
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('login/login_form', $data);
        $this->load->view('templates/sitewide_footer');
      }
      else {
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('user/create');
        $this->load->view('templates/sitewide_footer');
      }
    }
  }

  public function validate_form_change_password() {
    $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|min_length[4]');
    $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|matches[password]');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('my_account/change_password_form');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      $username = $this->session->userdata['username'];
      $old_pass = $this->input->post('password');
      $validated = $this->user_model->check_old_password_is_correct($username, $old_pass);
      if ($validated) {
        $this->user_model->update_password_for_username($username);
        $data['success_message'] = 'You have successfully updated your password.';
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('my_account/my_account_view', $data);
        $this->load->view('templates/sitewide_footer');
      }
      else {
        $data['custom_error'] = 'You entered the WRONG old password.';
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('my_account/change_password_form', $data);
        $this->load->view('templates/sitewide_footer');
      }
    }
  }

  public function validate_form_remove_account_picture() {
    // GRAB THE OLD PROFILE PICTURE LINK (OR AT LEAST THE NAME OF THE FILE)
    // DELETE FROM THE SERVER THE FILES STARTING WITH THE USER'S NAME , and CONTINUED BY an UNDERSCORE.
    $username = $this->session->userdata['username'];
    $valid_extensions_array = array('jpg', 'png', 'gif');
    $image_dir = 'uploads/account_pictures/';
    $thumb300_dir = 'uploads/account_pictures/thumbnails300/';
    $thumb75_dir = 'uploads/account_pictures/thumbnails75/';
    foreach ($valid_extensions_array as $extension) {
      $file_with_path_and_extension = $image_dir . $username . '_account_picture.' . $extension;
      if (file_exists($file_with_path_and_extension)) {
        unlink($image_dir . $username . '_account_picture.' . $extension);
        unlink($thumb300_dir . $username . '_account_picture.' . $extension);
        unlink($thumb75_dir . $username . '_account_picture.' . $extension);
      }
      else {
        //echo 'This file wasnt set.';
      }
    }

    $username = $this->session->userdata['username'];
    $link = '';
    if ($this->user_model->set_account_picture_link($username, $link)) {
      $data['success_message'] = 'You have successfully removed your Account Picture.';
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('my_account/my_account_view', $data);
      $this->load->view('templates/sitewide_footer');
    }
    else {
      $data['success_message'] = 'There was an error trying to remove your Account Picture.';
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('my_account/my_account_view', $data);
      $this->load->view('templates/sitewide_footer');
    }
  }

  public function validate_form_change_picture_by_file() {
    $custom_filename = $this->session->userdata['username'];
    $config['upload_path'] = 'uploads/account_pictures';
    $config['file_name'] = $custom_filename . '_account_picture';
    $config['overwrite'] = TRUE;
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '4048000';
    $config['max_width'] = '3000';
    $config['max_height'] = '3000';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);


    if (!$asd = $this->upload->do_upload()) {
      $error = array('error' => $this->upload->display_errors());
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('my_account/change_my_picture', $error);
      $this->load->view('templates/sitewide_footer');
    }
    else {
      // After upload succeded , resize the image to 300x300 (create thumbnail)
      $thumbnail['source_image'] = $this->upload->data()['full_path'];
      $thumbnail['image_library'] = 'gd2';
      $thumbnail['create_thumb'] = TRUE;
      $thumbnail['maintain_ratio'] = FALSE;
      $this->load->library('image_lib', $thumbnail);
      //300 THUMBNAIL

      $this->image_lib->width = 300;
      $this->image_lib->height = 300;
      $this->image_lib->full_dst_path = $this->upload->data()['file_path'] . 'thumbnails300/' . $this->upload->data()['raw_name'] . $this->upload->data()['file_ext'];
      $test = $this->image_lib->resize();

      //75 THUMBNAIL
      $this->image_lib->width = 75;
      $this->image_lib->height = 75;
      $this->image_lib->full_dst_path = $this->upload->data()['file_path'] . 'thumbnails75/' . $this->upload->data()['raw_name'] . $this->upload->data()['file_ext'];
      $test2 = $this->image_lib->resize();

      $username = $this->session->userdata['username'];
      $file = $this->upload->data()['raw_name'] . $this->upload->data()['file_ext'];
      $this->user_model->set_account_picture_link($username, $file);
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('my_account/my_account_view');
      $this->load->view('templates/sitewide_footer');
    }
  }

  function validate_form_update_details() {
    $this->form_validation->set_rules('first_name', 'First Name', 'trim|min_length[3]|max_length[18]');
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|min_length[3]|max_length[30]');
    $detail_types = $this->user_model->get_all_user_detail_types();
    foreach ($detail_types as $detail_type) {
      $this->form_validation->set_rules($detail_type, ucfirst($detail_type), 'trim|min_length[2]');
    }
    if ($this->form_validation->run() == FALSE) { // validation failed
    }
    else {
      if ($query = $this->user_model->update_user_by_session()) {
        $data['success_message'] = 'You have successfully updated user data.';
        foreach ($detail_types as $fieldname) {
          $this->user_model->update_user_fields_by_session($fieldname);
        }
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('my_account/my_account_view', $data);
        $this->load->view('templates/sitewide_footer');
      }
      else {
        $data['custom_error'] = 'Something went wrong.Contact Site Admin for this matter.';
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('my_account/update_account_details', $data);
        $this->load->view('templates/sitewide_footer');
      }
    }
  }

  function validate_form_update_user() {
    //FORM VALIDATION
    $this->form_validation->set_rules('first_name', 'First Name', 'trim|min_length[3]|max_length[18]');
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('password', 'Password', 'trim|min_length[4]');
    $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|matches[password]');
    $detail_types = $this->user_model->get_all_user_detail_types();
    foreach ($detail_types as $detail_type) {
      $this->form_validation->set_rules($detail_type, ucfirst($detail_type), 'trim|min_length[2]');
    }

    if ($this->form_validation->run() == FALSE) { // validation failed
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('user/edit');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      if ($query = $this->user_model->update()) {
        $all_groups = $this->user_model->get_all_groupnames_from_db();
        $this->user_model->delete_all_mapping_for_user($_POST['id']);
        foreach ($all_groups as $group) {
          if (in_array($group, $_POST)) {
            $group_id = $this->user_model->get_groupid_by_groupname($group);
            $this->user_model->map_user_group($_POST['id'], $group_id);
          }
        }
        $detail_types = $this->user_model->get_all_user_detail_types();
        foreach ($detail_types as $fieldname) {
          $this->user_model->update_user_dynamic_field($fieldname);
        }
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('user/table');
        $this->load->view('templates/sitewide_footer');
      }
      else {
        print_r("FAILED UPDATE FIRSTNAME & LASTNAME ");
        print_r("please contact site administrator about this.");
      }
    }
  }

  public function add() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('user/create');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function edit() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      // HERE WE SHOULD CHECK IF POST OR GET ['ID'] IS SET , OR ELSE , DIE TO 404.

      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('user/edit');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function delete() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('user/delete');
    }
    else {
      show_404();
    }
  }

  public function view_user() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('user/view_user');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function detail_types() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('user/detail_types');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function edit_detail_type() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('user/edit_detail_type');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function delete_detail_type() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('user/delete_detail_type');
    }
    else {
      show_404();
    }
  }

  public function ajax() {
    $this->load->view('user/ajax');
  }

  public function login_failed() {
    $data['account_created'] = 'Your login failed. Please Try Again';
    $this->load->view('templates/sitewide_header');
    $this->load->view('templates/site_menu');
    $this->load->view('login/login_form', $data);
    $this->load->view('templates/sitewide_footer');
  }

  public function my_account() {
    if (isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('my_account/my_account_view');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function my_account_password() {
    if (isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('my_account/change_password_form');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function my_account_update_details() {
    if (isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('my_account/update_account_details');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function my_account_change_picture() {
    if (isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('my_account/change_my_picture');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

}
