<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Changelog extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('changelog_model');
  }

  public function index() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('changelog/index');
      $this->load->view('changelog/latest_changes');
      $this->load->view('changelog/table');
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
      $this->load->view('changelog/create');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function download() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->dbutil();
      $this->load->helper('file');
      $this->load->view('changelog/download');
    }
    else {
      show_404();
    }
  }

  public function validate_form_create_changelog() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->form_validation->set_rules('changelog_text', 'Changelog Text', 'required|min_length[2]');
      if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('changelog/create');
        $this->load->view('templates/sitewide_footer');
      }
      else {
        $this->changelog_model->create();
        redirect('changelog');
      }
    }
    else {
      show_404();
    }
  }

}
