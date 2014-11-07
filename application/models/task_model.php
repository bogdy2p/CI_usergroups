<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Task_model extends CI_Model {

  //Constructor function for class Changelog.
  function __construct() {
    parent::__construct();
  }

  function create() {
    $size = $this->input->post('size');
    $text = $this->input->post('todo_text');
    $colour = $this->input->post('colour');
    $name = '<' . $size . '>' . $text . '</' . $size . '>';
    $data = array(
      'name' => $name,
      'colour' => $colour,
    );
    $this->db->set('date', 'NOW()', FALSE);
    $this->db->insert('todo_list', $data);
  }

  function read($table_name = 'todo_list') {
    $this->db->select('*');
    $this->db->from('todo_list');
    $this->db->order_by('date', 'desc');
    $return = array();
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      $return[] = $row;
    }
    return $return;
  }

  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('todo_list');
  }

  function generate_todo_list_html_admin() {
    $tasks = Self::read();
    $lines = $this->db->count_all('todo_list');
    if ($lines > 0) {
      echo "<ol>";
      foreach ($tasks as $individual_task) {
        echo '<li>';
        echo '<' . $individual_task["colour"] . '>' . $individual_task["name"] . '</' . $individual_task["colour"] . '/>';
        echo '<a><span onclick="confirm_delete_todo(' . $individual_task["id"] . ')" class="glyphicon glyphicon-remove spanred pointer"></span></a>';
        echo'</li>';
      }
      echo "</ol>";
      echo '';
    }
    else {
      echo "nothing to do yet.";
    }
  }

  function generate_todo_list_for_main() {
    $tasks = Self::read();
    echo "<ol>";
    foreach ($tasks as $individual_todo) {
      echo '<li><' . $individual_todo['colour'] . '>' . $individual_todo['name'] . '</' . $individual_todo['colour'] . '></li>';
    }
    echo "</ol>";
  }

  function return_taskcount() {
    $this->db->select('*');
    $this->db->from('todo_list');
    $result = $this->db->count_all_results();
    return $result;
  }

}
