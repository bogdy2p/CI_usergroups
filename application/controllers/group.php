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
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('group/index');
      $this->load->view('group/table');
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
      $this->load->view('group/create');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function validate_form_create_group() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->form_validation->set_rules('name', 'Group Name', 'trim|required|min_length[2]|is_unique[groups.name]');
      if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('group/create');
        $this->load->view('templates/sitewide_footer');
      }
      else {
        $this->group_model->create();
        redirect('group');
      }
    }
    else {
      show_404();
    }
  }

  public function validate_form_update_group() { //|is_unique[groups.name]
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->form_validation->set_rules('name', 'Group Name', 'min_length[2]');
      if ($this->form_validation->run() == FALSE) {

        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('group/edit');
        $this->load->view('templates/sitewide_footer');
      }
      else {
        $this->group_model->update();
        redirect('group');
      }
    }
    else {
      show_404();
    }
  }

  public function edit() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('group/edit');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function delete() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('group/delete');
    }
    else {
      show_404();
    }
  }

  public function ajax() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('group/ajax');
    }
    else {
      show_404();
    }
  }

}

// END OF CLASS

