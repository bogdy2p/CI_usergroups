<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Changelog_model extends CI_Model {

  //Constructor function for class Changelog.
  function __construct() {
    parent::__construct();
  }

  function create() {
    $size = $this->input->post('size');
    $text = $this->input->post('changelog_text');
    $colour = $this->input->post('colour');
    $name = '<' . $size . '>' . $text . '</' . $size . '>';
    $data = array(
      'name' => $name,
      'colour' => $colour,
    );
    $this->db->set('date', 'NOW()', FALSE);
    $this->db->insert('app_changelog', $data);
  }

  function read($table_name = 'app_changelog') {
    $this->db->select('*');
    $this->db->from($table_name);
    $this->db->order_by('date', 'desc');
    $return = array();
    $result = $this->db->get();
    foreach ($result->result_array() as $row) {
      $return[] = $row;
    }
    return $return;
  }

  function read_for_last_x_days($days) {
    $this->db->select('*');
    $this->db->from('app_changelog');
    $this->db->where('date >= NOW() - INTERVAL ' . $days . ' DAY', '', false);
    $this->db->order_by('date', 'desc');
    $result = $this->db->get();
    $return = array();
    foreach ($result->result_array() as $row) {
      $return[] = $row;
    }
    return $return;
  }

  function return_changelogcount() {
    $this->db->select('*');
    $this->db->from('app_changelog');
    $result = $this->db->count_all_results();
    return $result;
  }

  /*   * ********************************************************************* */
  /*   * ********************************************************************* */
  /*   * ********************************************************************* */

  function export_query() {
    $days = $_POST['days'];
    $query = $this->db->query('SELECT * FROM app_changelog WHERE date >= NOW() - INTERVAL ' . $days . ' DAY ORDER BY date DESC');
    return $query;
  }

  /*   * ********************************************************************* */
  /*   * ********************************************************************* */
  /*   * ********************************************************************* */
  /*   * ********************************************************************* */

  function generate_changelog_table_html($days) {
    Self::generate_changelog_table_header($days);
    Self::generate_changelog_table_content($days);
    Self::generate_changelog_table_footer();
  }

  function generate_changelog_table_header($days) {
    //echo '<div class="col-xs-12 col-md-12">';
    if ($days == 1) {
      echo "<h3>TODAY'S CHANGE LOGS: </h3>";
    }
    elseif ($days == 2) {
      echo '<h3>CHANGELOGS SINCE YESTERDAY:</h3>';
    }
    elseif ($days > 2 && $days <= 10) {
      echo '<h3>LAST ' . ($days - 1) . ' DAYS CHANGE LOGS :</h3>';
    }
    else {
      echo '<h3> ALL CHANGELOGS AVAILLABLE :</h3>';
    }


    echo '<table class="table table-bordered">';
    echo '<th class="success">Name</th>';
    echo '<th class="success">Created</th>';
  }

  function generate_changelog_table_content($days) {
    $changelog = new Changelog();
    $changelogs = Self::read_for_last_x_days($days);
    foreach ($changelogs as $individual_changelog) {
      $type = 'changelogs';
      echo '<tr>';
      echo '<td><' . $individual_changelog['colour'] . '>' . $individual_changelog['name'] . '</' . $individual_changelog['colour'] . '></td>';
      echo '<td>' . $individual_changelog['date'] . '</td>';
      echo '</tr>';
    }
  }

  function generate_changelog_table_footer() {
    echo '</table>';
    echo '</div>';
  }

  function generate_select_day_form() {
    echo '
    <br /><br /><br />
    <form class="form" id="day_form" action="#" method="post">
          <select name="day" id="day" form="day_form">
            <option value="100">All period</option>
            <option value="1">Today</option>
            <option value="2">Yesterday</option>
            <option value="3">Two Days Ago</option>
            <option value="4">Three Days Ago</option>
            <option value="5">Four Days Ago</option>
            <option value="6">Five Days Ago</option>
            <option value="7">Six Days Ago</option>
            <option value="8">Last Week</option>
            
            <!--BREAK THIS INTO OPTIONS -->
          </select> 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="submit" class="btn btn-success">Change Chosen Period</button>
    </form>
    <br /><br />
    ';
  }

  function generate_select_export_form() {
    echo '
    <br /><br /><br />
    <form class="form" id="export_form" action="changelog/download" method="post">

          <input name="filename"  type="hidden" value="' . date("D-M-Y_:H:m:s") . '_Changelogs"> 
          <select name="days" id="days" form="export_form">
            <option value="100">All period</option>
            <option value="1">Today</option>
            <option value="2">Yesterday</option>
            <option value="3">Two Days Ago</option>
            <option value="4">Three Days Ago</option>
            <option value="5">Four Days Ago</option>
            <option value="6">Five Days Ago</option>
            <option value="7">Six Days Ago</option>
            <option value="8">Last Week</option>
          </select> 
          &nbsp;&nbsp;&nbsp;
        <button type="submit" class="btn btn-success">Export as CSV</button>
    </form>
    <br /><br />
    ';
  }

  function generate_changelog_table_by_post() {
    if ((isset($_POST['day'])) && !empty($_POST['day'])) {
      Self::generate_changelog_table_html($_POST['day']);
    }
    else {
      Self::generate_changelog_table_html('100');
    }
  }

}
