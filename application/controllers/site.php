<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Site extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('site_model');
  }

  public function index() {
    if ((isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in']))) {
      $this->load->model('task_model');
      $this->load->model('user_model');
      $this->load->model('post_model');
      $this->load->model('group_model');
      $this->load->model('detail_type_model');
      $this->load->model('changelog_model');
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      
      $this->load->view('site/index');
      $this->load->view('post/latest');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      $this->load->model('task_model');
      $this->load->model('user_model');
      $this->load->model('post_model');
      $this->load->model('group_model');
      $this->load->model('detail_type_model');
      $this->load->model('changelog_model');
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('site/index');
      $this->load->view('post/sessionless_latest');
      $this->load->view('templates/sitewide_footer');
    }
  }

  public function view_user() {

    if ((isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in']))) {
      $this->load->model('user_model');
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('site/view_another_user');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

}
