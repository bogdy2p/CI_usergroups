function confirm_delete_user(id) {
  if (confirm("Confirm deletion of user  " + id + " ? ") == true) {
    window.location.replace("/user_ci/user/delete?id=" + id);
    return true;
  } else {
    window.location.replace("/user_ci/user");
    return false;
  }
}
function confirm_delete_group(id) {
  if (confirm("Are you sure you want to delete group " + id + " ? ") == true) {
    window.location.replace("/user_ci/group/delete?id=" + id);
    return true;
  } else {
    window.location.replace("/user_ci/group");
    return false;
  }
}
function confirm_delete_mapping(id) {
  if (confirm("Delete mapping " + id + " ?") == true) {
    window.location.replace("/user_ci/main/delete?id=" + id + "&type=usergroups");
    return true;
  } else {
    window.location.replace("/user_ci/main/tables");
    return false;
  }
}
function confirm_detail_type_delete(id) {
  if (confirm("Are you sure you want to delete " + id + " ? ") == true) {
    window.location.replace("/user_ci/detail_type/delete?id=" + id + "&type=detail");
    return true;
  } else {
    window.location.replace("/user_ci/detail_type");
    return false;
  }
}
function confirm_delete_todo(id) {
  if (confirm("Remove task with id = " + id + " ? ") == true) {
    window.location.replace("/user_ci/task/delete?id=" + id);
    return true;
  } else {
    window.location.replace("/user_ci/task");
    return false;
  }
}

function confirm_delete_post(id) {
  if (confirm() == true) {
    window.location.replace("/user_ci/post/delete?post_id=" + id);
    return true;
  } else {
    window.location.replace("/user_ci/post");
    return false
  }
}
