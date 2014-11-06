<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Detail_type extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('detail_type_model');
  }

  public function index() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('detailtype/index');
    $this->load->view('templates/sitewide_footer');
  }

  public function add() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('detailtype/create');
    $this->load->view('templates/sitewide_footer');
  }

  public function edit() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('detailtype/edit');
    $this->load->view('templates/sitewide_footer');
  }

  public function delete() {
    $this->load->view('detailtype/delete');
  }

  public function ajax() {
    $this->load->view('detailtype/ajax');
  }

}
