<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('user_model');
  }

  public function index() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('user/index');
    $this->load->view('user/table');
    $this->load->view('templates/sitewide_footer');
  }

  public function login() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('login/login_form');
    $this->load->view('templates/sitewide_footer');
  }

  public function validate_login_credentials() {
    $this->load->view('templates/sitewide_header');
    //$this->load->view('login/login_form');
    $this->load->view('templates/sitewide_footer');
  }

  public function register() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('login/register_form');
    $this->load->view('templates/sitewide_footer');
  }

  public function validate_form_create_user() {


    $this->load->helper('form');
    //FORM VALIDATION
    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]|max_length[18]');
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]|max_length[30]');
    $this->form_validation->set_rules('email', 'Email Adress', 'trim|required|valid_email||min_length[6]|is_unique[users.email]');
    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|is_unique[users.name]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
    $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required|matches[password]');


    if ($this->form_validation->run() == FALSE) { // validation failed
      $this->load->view('templates/sitewide_header');
      $this->load->view('login/register_form');
      $this->load->view('templates/sitewide_footer');
    }
    else {
      $this->load->model('user_model');

      if ($query = $this->user_model->create_user()) {

        $data['account_created'] = 'Your account has been created.';
        $this->load->view('templates/sitewide_header');
        $this->load->view('login/login_form', $data);
        $this->load->view('templates/sitewide_footer');
      }
      else {
        $this->load->view('templates/sitewide_header');
        $this->load->view('login/register_form');
        $this->load->view('templates/sitewide_footer');
      }
    }
  }

  public function add() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('user/create');
    $this->load->view('templates/sitewide_footer');
  }

  public function edit() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('user/edit');
    $this->load->view('templates/sitewide_footer');
  }

  public function delete() {
    $this->load->view('user/delete');
  }

  public function view_user() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('user/view_user');
    $this->load->view('templates/sitewide_footer');
  }

  public function detail_types() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('user/detail_types');
    $this->load->view('templates/sitewide_footer');
  }

  public function edit_detail_type() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('user/edit_detail_type');
    $this->load->view('templates/sitewide_footer');
  }

  public function delete_detail_type() {
    $this->load->view('user/delete_detail_type');
  }

  public function ajax() {
    $this->load->view('user/ajax');
  }

}
