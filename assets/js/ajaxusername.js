check_detail_type_availlability_on_edit();
check_group_availlability();
check_username_availlability();
check_detail_type_availlability();
check_password_matching();
check_username_availlability_on_edit();
check_group_availlability_on_edit();

function check_group_availlability_on_edit(){
$(document).ready(function(){
		$('#edit_groupname').blur(function(){
			$.ajax({
				url: '../models/ajax.php',
				data: {'edit_groupname' : $('#edit_groupname').val()},
				success: success,
				dataType: 'json'
				})
			.done(function(data){
				if (data==0){
					$('#edit_group_error').html("");//Aici setezi textul in div-ul de langa name
					$('#submit').show();
				}else{
					$('#submit').hide();
					$('#edit_group_error').html("<h4><spanred><spangre>"+$('#edit_groupname').val()+"</spangre> group already exists!</spanred></h4>");
				}
			})
		});
		function success(){
				console.log("Ajax Success Called check_group_availlability");
			  				}
	});
}

function check_detail_type_availlability_on_edit(){
	$(document).ready(function(){
		$('#edit_detail').blur(function(){
			$.ajax({
				url: '../models/ajax.php',
				data: {'edit_detail' : $('#edit_detail').val()},
				success: success,
				dataType: 'json'
			})
			.done(function(data){
				if(data==0){
					$('#edit_detail_type_error').html("");
					$('#submit').show();
				}else{
					$('#submit').hide();
					$('#edit_detail_type_error').html("<h5><spanred>Can't rename to : <spangre>"+$('#edit_detail').val()+"</spangre> <br /> Another group named like that already exists!</spanred></h5>");
				}
			})
		});
		function success(){
			console.log("Ajax Success Called Detail Type on EDIT");
			}
	});
}


function check_username_availlability_on_edit(){
	$(document).ready(function(){
		$('#edit_username').blur(function(){
			$.ajax({
				url: '../models/ajax.php',
				data: {'edit_username': $('#edit_username').val()},
				success: success,
				dataType: 'json'
				})
			.done(function(data){
				if(data==0){
					$('#edit_username_error').html("");
					$('#submit').show();
				}else{
					$('#submit').hide();
					$('#edit_username_error').html("THAT NAME IS ALREADY TAKEN. Please choose another one");
				}
			})
		});
		function success(){
				console.log("Ajax Success Called check_username_availlability_on_edit");
			  	}
	});
}


function check_username_availlability(){
	$(document).ready(function(){
			$('#name').blur(function(){
				$.ajax({
						url: '../models/ajax.php', 
						data: {'name' : $('#name').val()},
						success: success,
						dataType: 'json'
				  		})
				.done(function(data){
	   						 // alert( "Returning " + data );
	   				 	if (data==0){
	   				 		$('#name_error').html("");//Aici setezi textul in div-ul de langa name
	   				 		$('#submit').show();
	   				 	}
	   					else{
	   						$('#submit').hide();
	   						$('#name_error').html("<h4><spanred><spangre>"+$('#name').val()+ "</spangre> is already taken ! Please choose another one</spanred></h4>");
	   					}
	  			});
			});
			function success(){
				console.log("Ajax Success Called check_username_availlability");
			  				}
		});
}

function check_group_availlability(){
	$(document).ready(function(){
		$('#groupname').blur(function(){
			$.ajax({
				url: '../models/ajax.php',
				data: {'groupname' : $('#groupname').val()},
				success: success,
				dataType: 'json'
				})
			.done(function(data){
				if (data==0){
					$('#group_error').html("");//Aici setezi textul in div-ul de langa name
					$('#submit').show();
				}else{
					$('#submit').hide();
					$('#group_error').html("<h4><spanred><spangre>"+$('#groupname').val()+"</spangre> group already exists!</spanred></h4>");
				}
			})
		});
		function success(){
				console.log("Ajax Success Called check_group_availlability");
			  				}
	});

}

function check_detail_type_availlability(){
	$(document).ready(function(){
		$('#detail_name').blur(function(){
			$.ajax({
				url: '../models/ajax.php',
				data: {'detail_name' : $('#detail_name').val()},
				success: success,
				dataType: 'json'
			})
			.done(function(data){
				if(data==0){
					$('#detail_type_error').html("");
					$('#submit').show();
				}else{
					$('#submit').hide();
					$('#detail_type_error').html("<h4><spanred><spangre>"+$('#detail_name').val()+"</spangre> already exists!</spanred></h4>");
				}
			})
		});
		function success(){
			console.log("Ajax Success Called check_detail_type_availlability");
			}
	});
}

function check_password_matching(){
	$(document).ready(function(){
		//Grab the input for password
		$('#pass_conf').blur(function(){
			password = $('#password').val();
			pass_conf = $('#pass_conf').val();
			if (password == pass_conf){
				$('#submit').show();
				$('#password_error').html("");
			}else{
				$('#submit').hide();
				$('#password_error').html("<h4><spanred>Can't you just type the same password twice !?!?</spanred></h4>");
			}
		});		
	});
}