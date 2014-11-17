<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Post extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('post_model');
  }

  public function index() {
    if ((isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in']))) {
      $this->load->model('user_model');
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('post/latest');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      $this->load->model('user_model');
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('post/sessionless_latest');
      $this->load->view('templates/sitewide_footer');
    }
  }

  public function add() {
    $this->load->model('user_model');
    if ((isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in']))) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('post/create');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function delete() {
    if ((isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in']))) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('post/delete');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function my_posts() {
    if ((isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in']))) {
      $this->load->view('templates/sitewide_header');
      $this->load->view('templates/site_menu');
      $this->load->view('post/my_posts');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      show_404();
    }
  }

  public function validate_add_new_post() {
    if ((isset($this->session->userdata['is_logged_in']) && ($this->session->userdata['is_logged_in']))) {
      $this->form_validation->set_rules('post_title', 'Post Title', 'required|min_length[3]|max_length[200]');
      $this->form_validation->set_rules('post_content', 'Post Content', 'required|min_length[2]');

      if ($this->form_validation->run() == FALSE) { // validation failed
        $this->load->view('templates/sitewide_header');
        $this->load->view('templates/site_menu');
        $this->load->view('post/create');
        $this->load->view('templates/sitewide_footer');
      }
      else {
        $this->load->model('user_model');
        $username = $this->session->userdata['username'];
        $user_id = $this->session->userdata['user_id'];
        $title = $this->input->post('post_title');
        $content = $this->input->post('post_content');
        if ($this->post_model->create()) {
          $this->load->view('templates/sitewide_header');
          $this->load->view('templates/site_menu');
          $this->load->view('post/latest');
          $this->load->view('templates/sitewide_footer');
        }
        else {
          $data['error'] = 'Unable to post !';
          $this->load->view('templates/sitewide_header');
          $this->load->view('templates/site_menu');
          $this->load->view('post/create', $data);
          $this->load->view('templates/sitewide_footer');
        }
      }
    }
    else {
      show_404();
    }
  }

}
