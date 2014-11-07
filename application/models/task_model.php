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

  function create($name, $colour) {
    $data = array(
      'name' => $name,
      'colour' => $colour,
    );
    $this->db->set('date', 'NOW()', FALSE);
    $this->db->insert('todo_list', $data);
  }
  
  function create_task(){
    $data = array(
      'name'=>'',
      'colour'=>'',
    );
    $this->db->set('date','NOW()',FALSE);
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

  function validate_insert_new_task() {
    if (isset($_POST) && !empty($_POST)) {

      if (isset($_POST['colour'])) {
        print_r($_POST);
        if (!empty($_POST['todo_text'])) {
          $name_with_heading = '<' . $_POST['size'] . '>' . $_POST['todo_text'] . '</' . $_POST['size'] . '>';
          $colour = $_POST['colour'];
          Self::create($name_with_heading, $colour);
        }
        header("Location: #");
        die();
      }
      elseif (isset($_POST['day'])) {/* print_r($_POST); */
      }
    }
    else {
      
    }
  }

  function generate_todo_add_new_form() {
    echo '		<form class="form" id="add_new_todo_form" action="index" method="post">
              <label>Add New Task</label><br />
                <input name="todo_text"  type="text"  placeholder="Todo text"> <br />
                <br />
                <select name="colour" id="colour" form="add_new_todo_form">
                  <option selected="null" value="spanred">Red (hard)</option>
                  <option value="spanyel">Yellow (normal)</option>
                  <option value="spangre">Green (easy)</option>
                </select><br /><br />
                <select name="heading_type" id="heading_type" form="add_new_todo_form">
                  <option selected="null" value="h5">H5</option>
      ';
    Self::generate_todo_select_heading_options();
    echo '
                </select><br /><br />
                <button type="submit" class="btn btn-success">Add New Task</button>
          </form> 
      ';
  }

  function generate_todo_select_heading_options() {
    for ($i = 1; $i <= 6; $i++) {
      echo '<option value="h' . $i . '">H' . $i . '</option>';
    }
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
