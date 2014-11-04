function confirm_delete_user(id) {
    if (confirm("Confirm deletion of user  " + id + " ? ") == true) {
        window.location.replace("/user_ci/user/delete?id="+id);return true;
    } else {
        window.location.replace("/user_ci/user");return false;
    }
}
function confirm_delete_group(id){
	if (confirm("Are you sure you want to delete group " + id + "? ") == true){
		window.location.replace("/user_ci/group/delete?id="+id);return true;
	}else{
		window.location.replace("/user_ci/group");return false;
	}
}
function confirm_delete_mapping(id){
	if (confirm("Are you sure?") == true){
		window.location.replace("../models/delete.php?id="+id+"&type=usergroups");return true;
	}else{
		window.location.replace("/user_ci/views/view_list.php");return false;
	}
}
function confirm_detail_type_delete(id){
	if (confirm("Are you sure you want to delete "+id+" ?") == true){
		window.location.replace("../models/delete.php?id="+id+"&type=detail");return true;
	}else{
		window.location.replace("/user_ci/views/view_detail_types.php");return false;
	}
}
function confirm_delete_todo(id){
	if (confirm("Remove task with id = "+ id +" ?") == true){
		window.location.replace("/user_ci/task/delete?id="+id); return true;
	}else{
		window.location.replace("/user_ci/task"); return false;
	}
}