<?php 
    check_ajax_at_group_adding();
    check_ajax_at_group_editing();

function return_ajax_for_group($input){		
    $group = new Group_model();
    $exists = $group->group_already_exists($input);
		if ($exists){
			echo '1';
		}else{
			echo '0';
		}
	}
  
  function check_ajax_at_group_adding(){
    if (isset($_GET['groupname'])){
      return_ajax_for_group($_GET['groupname']);
    }
  }
  function check_ajax_at_group_editing(){
    if (isset($_GET['edit_groupname'])){
      return_ajax_for_group($_GET['edit_groupname']);
    }
  }