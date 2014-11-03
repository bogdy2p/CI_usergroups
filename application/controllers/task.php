<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Task extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('task_model');
  }
  
  public function index()
	{
    $this->load->view('templates/sitewide_header');
		$this->load->view('index');
    $this->load->view('templates/sitewide_footer');
	}
  
}