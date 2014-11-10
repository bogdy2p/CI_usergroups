check_email_availlability_on_user_creation();
check_detail_type_availlability_on_edit();
check_group_availlability();
check_username_availlability();
check_detail_type_availlability();
check_password_matching();
check_username_availlability_on_edit();
check_group_availlability_on_edit();


function check_email_availlability_on_user_creation(){
  $(document).ready(function() {
    $('#email_field').blur(function(){
      $.ajax({
        url : 'ajax',
        data: {'email_field':$('#email_field').val()},
        success: success,
        dataType: 'json'
      })
        .done(function(data) {
          if (data == 0){
            $('#email_field_error').html("");
            $('#submit').show();
          }else {
            $('#submit').hide();
            $('#email_field_error').html("<h4><spanred>There already is an account on this adress.</spanred><spangre> Please use forgot password to recover your password!</spangre></h4>");
          }
      })
    });
    function success(){
      console.log("CHECK EMAIL AVAILLABILITY called.");
    }
  });
}



function check_group_availlability_on_edit() {
  $(document).ready(function() {
    $('#edit_groupname').blur(function() {
      $.ajax({
        url: 'ajax',
        data: {'edit_groupname': $('#edit_groupname').val()},
        success: success,
        dataType: 'json'
      })
        .done(function(data) {
          if (data == 0) {
            $('#edit_group_error').html("");//Aici setezi textul in div-ul de langa name
            $('#submit').show();
          } else {
            $('#submit').hide();
            $('#edit_group_error').html("<h4><spanred><spangre>" + $('#edit_groupname').val() + "</spangre> group already exists!</spanred></h4>");
          }
        })
    });
    function success() {
      console.log("Ajax Success Called check_group_availlability");
    }
  });
}

function check_detail_type_availlability_on_edit() {
  $(document).ready(function() {
    $('#detail_name').blur(function() {
      $.ajax({
        url: 'ajax',
        data: {'edit_detail': $('#detail_name').val()},
        success: success,
        dataType: 'json'
      })
        .done(function(data) {
          if (data == 0) {
            $('#edit_detail_type_error').html("");
            $('#submit').show();
          } else {
            $('#edit_detail_type_error').html("<h5><spanred>Can't rename to : <spangre><b>" + $('#detail_name').val() + "</b></spangre> <br /> Another DETAIL named like that already exists!</spanred></h5>");
            $('#submit').hide();

          }
        })
    });
    function success() {
      console.log("Ajax Success Called Detail Type on EDIT");
    }
  });
}


function check_username_availlability_on_edit() {
  $(document).ready(function() {
    $('#edit_username').blur(function() {
      $.ajax({
        url: 'ajax',
        data: {'edit_username': $('#edit_username').val()},
        success: success,
        dataType: 'json'
      })
        .done(function(data) {
          if (data == 0) {
            $('#edit_username_error').html("");
            $('#submit').show();
          } else {
            $('#submit').hide();
            $('#edit_username_error').html("THAT NAME IS ALREADY TAKEN. Please choose another one");
          }
        })
    });
    function success() {
      console.log("Ajax Success Called check_username_availlability_on_edit");
    }
  });
}


function check_username_availlability() {
  $(document).ready(function() {
    $('#username').blur(function() {
      $.ajax({
        url: 'ajax',
        data: {'username': $('#username').val()},
        success: success,
        dataType: 'json'
      })
        .done(function(data) {
          // alert( "Returning " + data );
          if (data == 0) {
            $('#username_error').html("");//Aici setezi textul in div-ul de langa name
            $('#submit').show();
          }
          else {
            $('#submit').hide();
            $('#username_error').html("<h5><spanred><spangre>" + $('#username').val() + "</spangre> already taken ! Get another one</spanred></h5>");
          }
        });
    });
    function success() {
      console.log("Ajax Success Called check_username_availlability");
    }
  });
}

function check_group_availlability() {
  $(document).ready(function() {
    $('#groupname').blur(function() {
      $.ajax({
        url: 'ajax',
        data: {'groupname': $('#groupname').val()},
        success: success,
        dataType: 'json'
      })
        .done(function(data) {
          if (data == 0) {
            $('#group_error').html("");//Aici setezi textul in div-ul de langa name
            $('#submit').show();

          } else {
            $('#submit').hide();
            $('#group_error').html("<h4><spanred><spangre>" + $('#groupname').val() + "</spangre> group already exists!</spanred></h4>");
          }
        })
    });
    function success() {
      console.log("Ajax Success Called check_group_availlability");
    }
  });

}

function check_detail_type_availlability() {
  $(document).ready(function() {
    $('#detail_name').blur(function() {
      $.ajax({
        url: 'ajax',
        data: {'detail_name': $('#detail_name').val()},
        success: success,
        dataType: 'json'
      })
        .done(function(data) {
          if (data == 0) {
            $('#detail_type_error').html("");
            $('#submit').show();
          } else {
            $('#submit').hide();
            $('#detail_type_error').html("<h4><spanred><spangre>" + $('#detail_name').val() + "</spangre> already exists!</spanred></h4>");
          }
        })
    });
    function success() {
      console.log("Ajax Success Called check_detail_type_availlability");
    }
  });
}

function check_password_matching() {
  $(document).ready(function() {
    //Grab the input for password
    $('#pass_conf').blur(function() {
      password = $('#password').val();
      pass_conf = $('#pass_conf').val();
      if (password == pass_conf) {
        $('#submit').show();
        $('#password_error').html("");
      } else {
        $('#submit').hide();
        $('#password_error').html("<h4><spanred>Can't you just type the same password twice !?!?</spanred></h4>");
      }
    });
  });
}