<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Task extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('task_model');
  }

  public function index() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('task/index');
      $this->load->view('task/table');
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
      $this->load->view('task/create');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function delete() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->load->view('task/delete');
    }
    else {
      show_404();
    }
  }

  public function validate_form_create_task() {
    if (isset($this->session->userdata['admin_status']) && ($this->session->userdata['admin_status'])) {
      $this->form_validation->set_rules('todo_text', 'Task Text', 'required|min_length[2]');
      if ($this->form_validation->run() == FALSE) {
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('task/create');
        $this->load->view('templates/sitewide_footer');
      }
      else {
        $this->task_model->create();
        redirect('task');
      }
    }
    else {
      show_404();
    }
  }

}
