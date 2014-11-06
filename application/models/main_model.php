<?php

class Main_model extends CI_Model {
 
  function __construct()
    {
        parent::__construct();
    }
  
  function read(){
    $this->db->select('*');
    $this->db->from('usergroups');
    $result = $this->db->get();
    $return = array();
    foreach($result->result_array() as $row){
      $return[] = $row;
    }
    return $return;
 }  
    
    
 function delete_mapping($id){
   $this->db->where('id',$id);
   $this->db->delete('usergroups');
 }
   
   
   function print_colour_meanings(){
    echo '
                <hr>
                <div class="col-xs-12 col-md-2"><h3>Colours meaning</h3></div>
                <div class="col-xs-12 col-md-7">
                    <ul>
                        <li><spanred><h5><b>RED</b></h5></spanred> = HIGH PRIORITY / HIGH DIFFICULTY</li>
                        <li><spanyel><h5><b>YELLOW</b></h5></spanyel> = NORMAL PRIORITY / NORMAL DIFFICULTY</li>
                        <li><spangre><h5><b>GREEN</b></h5></spangre> = LOW PRIORITY / LOW DIFFICULTY</li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-3"></div>
    ';
}
   
  function print_database_statistics(){
              $user = new User_model();
              $group = new Group_model();
              $detail = new Detail_type_model();
              $changelog = new Changelog_model();
              $task = new Task_model();
							echo '<h4>Database Statistics</h4>';
				  			$users_availlable = $user->return_usercount();
				  			echo 'Total Users : <b>'.$users_availlable.'</b><br />';
				  			$groups_availlable = $group->return_groupcount();
				  			echo 'Total Groups : <b>'.$groups_availlable.'</b><br />';
                $user_details_set = $detail->return_detailcount();
				  			echo 'Total User Detail Types: <b>'.$user_details_set.'</b><br />';
				  			$mappings_availlable = Self::return_mappingcount();
				  			echo 'Total Mappings Set: <b>'.$mappings_availlable.'</b><br />';
				  			$change_logs_availlable = $changelog->return_changelogcount();
				  			echo 'Total ChangeLogs: <b>'.$change_logs_availlable.'</b><br />';
                $tasks_pending = $task->return_taskcount();
				  			echo 'Total Tasks Pending: <b>'.$tasks_pending.'</b><br />';
				  			$most_details_user = $user->get_table_of_users_and_number_of_detail_types();
                echo 'Most detailed user_id :<b> '.$most_details_user.'</b><br />';
                $username_most_detailed = $user->get_user_name_by_user_id($most_details_user);
				  			echo 'Most details user :<b> '.$username_most_detailed.'</b> (userid <b>'.$most_details_user.')</b>';

}
   
  function return_mappingcount(){
      $this->db->select('*');
      $this->db->from('usergroups');
      $result = $this->db->count_all_results();
      return $result;
  }
  
  
  
    function generate_mapping_table_html(){
    Self::generate_mapping_table_header();
    Self::generate_mapping_table_content();
    Self::generate_mapping_table_footer();
  }
  function generate_mapping_table_header(){
    //echo '<div class="col-xs-12 col-md-4">';
    echo "<h3>MAPPING TABLE :</h3>";
    echo '<table class="table table-bordered">';
    echo '<th class="warning">Id</th>';
    echo '<th class="warning">User ID</th>';
    echo '<th class="warning">Group ID</th>';
    echo '<th class="warning">Remove</th>';
  }
  function generate_mapping_table_content(){
    
    $user = new User_model();
    $group = new Group_model();
    $mapping_table = Self::read();
    foreach ($mapping_table as $table) {
    $map_id = $table['id'];
    $type='usergroups';
    echo '<tr>';
    echo '<td class="info">'.$table['id'].'</td>';
    echo '<td>' . $table['user_id'] . ' - ' . $user->get_user_name_by_user_id($table['user_id']) .'</td>';
    echo '<td>' . $table['group_id'] . ' - ' . $group->get_group_name_by_group_id($table['group_id']) .'</td>';
    echo '<td><a><span onclick="confirm_delete_mapping('.$map_id.')" class="glyphicon glyphicon-remove spanred pointer"></span></a></td>';
    echo '</tr>';
    }
  }
  function generate_mapping_table_footer(){
    echo "</table>";
    //echo "</div>";
  }
   
  function generate_groups_users_table_html(){
    Self::generate_groups_users_table_header();
    Self::generate_groups_users_table_content();
  	Self::generate_groups_users_table_footer();
  }

  function generate_groups_users_table_header(){
    //echo '<div class="col-xs-12 col-md-3">';
    echo '<h3>Users by group</h3>';
    echo '<table class="table table-bordered" name="groups_users">';
  }



  function generate_groups_users_table_content(){
    $user = new User_model();
    $group = new Group_model();
    $groups = $group->read();
    foreach ($groups as $group) 
      {
        $userids_array = $user->get_userids_for_a_group($group['id']);	
        echo '<th class="info">'.$group["name"].'\'s</th>';
        echo '<th class="info">User ID</th>';
                  foreach ($userids_array as $key => $value) {
                    echo "<tr>";
                        print_r("<td>".$user->get_user_name_by_user_id($value)."</td>");
                        print_r("<td>".$value."</td>");
                    echo "</tr>";
                  }
      }
  }

  function generate_groups_users_table_footer(){
    echo "</table>";
    //echo "</div>";
  }

  
  
  
}