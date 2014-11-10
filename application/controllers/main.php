<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Main extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('main_model');
  }

  public function index() {
    if(isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])){
    $this->load->model('task_model');
    $this->load->model('user_model');
    $this->load->model('group_model');
    $this->load->model('detail_type_model');
    $this->load->model('changelog_model');
    $this->load->view('templates/sitewide_header');
    $this->load->view('templates/site_menu');
    $this->load->view('main/index');
    $this->load->view('templates/sitewide_footer');
  }
  else {
      $this->load->view('templates/unauthorized');
    }
  }

  public function tables() {  // VIEW-UL cu tabele
    if(isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])){
    $this->load->model('user_model');
    $this->load->model('group_model');
    $this->load->view('templates/sitewide_header');
    $this->load->view('templates/site_menu');

    $this->load->view('user/table');

    $this->load->view('group/table');
    $this->load->view('main/mappingtable');
    $this->load->view('main/usersbygroups');
    $this->load->view('templates/sitewide_footer');
  }else{
    $this->load->view('templates/unauthorized');
    }
}

  public function view_list() {
    if(isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])){
    $this->load->view('templates/sitewide_header');
    $this->load->view('templates/site_menu');
    $this->load->view('main/list');
    $this->load->view('templates/sitewide_footer');
  }else{
    $this->load->view('templates/unauthorized');
    }
}

  public function delete() {
    if(isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])){
    $this->load->view('main/delete');
  }else{
    $this->load->view('templates/unauthorized');
    }
}

} // END OF CLASS
