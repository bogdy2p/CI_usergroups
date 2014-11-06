<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Changelog extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('changelog_model');
  }

  public function index() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('changelog/index');
    $this->load->view('changelog/latest_changes');
    $this->load->view('changelog/table');
    $this->load->view('templates/sitewide_footer');
  }

  public function add() {
    $this->load->view('templates/sitewide_header');
    $this->load->view('changelog/create');
    $this->load->view('templates/sitewide_footer');
  }

  public function download() {


    $this->load->dbutil();
    $this->load->helper('file');
    //$this->load->view('templates/sitewide_header');
    $this->load->view('changelog/download');
    //$this->load->view('templates/sitewide_footer');
  }

}
