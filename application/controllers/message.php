<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Message extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('message_model');
  }

  public function index() {
    if (isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('message/index');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function create() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('templates/site_menu');
    $this->load->view('message/create');
    $this->load->view('templates/sitewide_footer');
  }

}
