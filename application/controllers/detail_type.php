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
    $this->load->view('templates/sitewide_header');
    $this->load->view('detailtype/index');
    $this->load->view('templates/sitewide_footer');
  }

  public function add() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('detailtype/create');
    $this->load->view('templates/sitewide_footer');
  }

  public function edit() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('detailtype/edit');
    $this->load->view('templates/sitewide_footer');
  }

  public function delete() {
    $this->load->view('detailtype/delete');
  }

  public function ajax() {
    $this->load->view('detailtype/ajax');
  }

  public function validate_form_create_detail() {
    $this->form_validation->set_rules('detail_name', 'Detail Name', 'required|min_length[2]|is_unique[user_detail_types.name]');
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('detail_type/create');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      $this->detail_type_model->create();
      redirect('detail_type');
    }
  }

  
  public function validate_form_update_detail(){
   $this->form_validation->set_rules('detail_name', 'Detail Name', 'required|min_length[2]|is_unique[user_detail_types.name]');
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('detail_type/edit');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      $this->detail_type_model->update();
      $this->detail_type_model->update_detail_types_names_in_user_groups();
      redirect('detail_type');
    }
  }
  
  
}