<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Post extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('post_model');
  }

  public function index() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('templates/site_menu');
    $this->load->view('post/latest');
    $this->load->view('templates/sitewide_footer');
  }

  public function add() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('templates/site_menu');
    $this->load->view('post/create');
    $this->load->view('templates/sitewide_footer');
  }

  public function delete() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('templates/site_menu');
    $this->load->view('post/delete');
    $this->load->view('templates/sitewide_footer');
  }

  public function my_posts() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('templates/site_menu');
    $this->load->view('post/my_posts');
    $this->load->view('templates/sitewide_footer');
  }

}
