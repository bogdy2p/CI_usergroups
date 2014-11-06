<?php  //GROUP AJAX
    check_ajax();

function return_ajax_for_group($input){		
    $group = new Group_model();
    $exists = $group->group_already_exists($input);
		if ($exists){
			echo '1';
		}else{
			echo '0';
		}
	}
  
  function check_ajax(){
     if (isset($_GET['groupname'])){
      return_ajax_for_group($_GET['groupname']);
     }
     if (isset($_GET['edit_groupname'])){
      return_ajax_for_group($_GET['edit_groupname']);
    }
  }