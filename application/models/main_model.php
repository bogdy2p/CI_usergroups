<?php

class Main_model extends CI_Model {
 
  function __construct()
    {
        parent::__construct();
    }
  
  function read($table_name){
    $this->db->select('*');
		$this->db->from($table_name);	
		$query = $this->db->get();
		return $query->result();
	 }
 
   //IN MODEL SUNT TREBURILE CU BAZA DE DATE.
 
   
   
   
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
//				  			$mappings_availlable = Self::get_number_of_rows('usergroups');
//				  			echo 'Total Mappings Set: <b>'.$mappings_availlable.'</b><br />';
//				  			$app_logs_availlable = Self::get_number_of_rows('function_call_log');
//				  			echo 'Total App Logs: <b>'.$app_logs_availlable.'</b><br />';
				  			$change_logs_availlable = $changelog->return_changelogcount();
				  			echo 'Total ChangeLogs: <b>'.$change_logs_availlable.'</b><br />';
                $tasks_pending = $task->return_taskcount();
				  			echo 'Total Tasks Pending: <b>'.$tasks_pending.'</b><br />';
//				  			$user_id_with_most_details_entered = Self::get_table_of_users_and_number_of_detail_types();
//				  			$username_most_detailed = Self::get_name_by_id($user_id_with_most_details_entered,'users');
//				  			echo 'Most details user :<b> '.$username_most_detailed.'</b> (userid <b>'.$user_id_with_most_details_entered.')</b>';

}
   
   
   
}