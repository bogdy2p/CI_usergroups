<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Site extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('site_model');
  }

  public function index() {
    $this->load->model('task_model');
    $this->load->model('user_model');
    $this->load->model('group_model');
    $this->load->model('detail_type_model');
    $this->load->model('changelog_model');
    $this->load->view('templates/sitewide_header');
    $this->load->view('templates/site_menu');
    $this->load->view('site/index');
    $this->load->view('templates/sitewide_footer');
  }

}
