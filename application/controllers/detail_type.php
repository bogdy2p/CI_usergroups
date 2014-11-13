<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Detail_type extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('detail_type_model');
  }

  public function index() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('detailtype/index');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function add() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('detailtype/create');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function edit() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('detailtype/edit');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function delete() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('detailtype/delete');
    }
    else {
      show_404();
    }
  }

  public function ajax() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('detailtype/ajax');
    }
    else {
      show_404();
    }
  }

  public function validate_form_create_detail() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->form_validation->set_rules('detail_name', 'Detail Name', 'trim|required|min_length[2]|is_unique[user_detail_types.name]');
      if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('detailtype/create');
        $this->load->view('templates/sitewide_footer');
      }
      else {
        $this->detail_type_model->create();
        redirect('detail_type');
      }
    }
    else {
      show_404();
    }
  }

  public function validate_form_update_detail() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->form_validation->set_rules('detail_name', 'Detail Name', 'trim|required|min_length[2]|is_unique[user_detail_types.name]');
      if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('detailtype/edit');
        $this->load->view('templates/sitewide_footer');
      }
      else {
        $this->detail_type_model->update();
        $this->detail_type_model->update_detail_types_names_in_user_groups();
        redirect('detail_type');
      }
    }
    else {
      show_404();
    }
  }

}
