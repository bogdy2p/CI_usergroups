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
  
  public function login(){
    $this->load->view('templates/sitewide_header');
    $this->load->view('login/login_form');
    $this->load->view('templates/sitewide_footer');
  }
  
  public function register(){
    $this->load->view('templates/sitewide_header');
    $this->load->view('login/register_form');
    $this->load->view('templates/sitewide_footer');
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
