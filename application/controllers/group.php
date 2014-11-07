<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Group extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('group_model');
  }

  public function index() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('group/index');
    $this->load->view('group/table');
    $this->load->view('templates/sitewide_footer');
  }

  public function add() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('group/create');
    $this->load->view('templates/sitewide_footer');
  }

  public function validate_form_create_group() {
    $this->form_validation->set_rules('name', 'Group Name', 'required|min_length[2]|is_unique[groups.name]');
    if ($this->form_validation->run() == FALSE) {
      
        $this->load->view('templates/sitewide_header');
        $this->load->view('group/create');
        $this->load->view('templates/sitewide_footer');
    }
    else {
      $this->group_model->create();
      redirect('group');
    }
  }

  public function edit() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('group/edit');
    $this->load->view('templates/sitewide_footer');
  }

  public function delete() {
    $this->load->view('group/delete');
  }

  public function ajax() {
    $this->load->view('group/ajax');
  }

}
