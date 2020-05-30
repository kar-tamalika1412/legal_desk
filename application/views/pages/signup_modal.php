<style type="text/css">
    body {
		font-family: 'Varela Round', sans-serif;
	}
	.modal-login {
		width: 500px;
	}
	.modal-login .modal-content {
		border-radius: 1px;
		border: none;
	}
	.modal-login .modal-header {
        position: relative;
		justify-content: center;
        background: #f2f2f2;
	}
    .modal-login .modal-body {
        padding: 30px;
    }
    .modal-login .modal-footer {
        background: #f2f2f2;
    }
	.modal-login h4 {
		text-align: center;
		font-size: 26px;
	}
    .modal-login label {
        font-weight: normal;
        font-size: 13px;
    }
	.modal-login .form-control, .modal-login .btn {
		min-height: 38px;
		border-radius: 2px; 
	}
	.modal-login .hint-text {
		text-align: center;
	}
	.modal-login .close {
        position: absolute;
		top: 15px;
		right: 15px;
	}
    .modal-login .checkbox-inline {
        margin-top: 12px;
    }
    .modal-login input[type="checkbox"]{
        margin-top: 2px;
    }
	.modal-login .btn {
        min-width: 100px;
		background: #3498db;
		border: none;
		line-height: normal;
	}
	.modal-login .btn:hover, .modal-login .btn:focus {
		background: #248bd0;
	}
	.modal-login .hint-text a {
		color: #999;
	}
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}
	#signup_modal a{
		font-size: small;
		color: #56a3e6;
	}

</style>
<!-- Modal HTML -->
<div id="signup_modal" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<form action="" method="post" id = "signup_form">
				<div class="modal-header">				
					<h4 class="modal-title">Sign Up</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="popUpCLose();">&times;</button>
				</div>
				<div class="modal-body">	
					<div>
						<p style="margin-left: 142px;">With your social network</p>
						<button type="button" class="btn btn-gplus waves-effect waves-light" style="    margin-left: 100px;"><i class="fab fa-google-plus-g pr-1"></i> Google +</button>
						<button type="button" class="btn btn-fb"><i class="fab fa-facebook-f pr-1"></i> Facebook</button>
					</div>
					<p style="margin-left: 162px;">Or with your email</p>
					<div class="form-group">
						<input type="text" class="form-control" name ="user_name" id ="user_name" required="required" placeholder="Name">
					</div>
				
					<div class="form-group">
						<input type="text" class="form-control" name ="user_email" id ="user_email" required="required" placeholder="Email">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name ="user_phone" id ="user_phone" required="required" placeholder="Phone No.">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name ="user_password" id ="user_password" required="required" placeholder="Password">
					</div>
				</div>
				<div class="modal-footer">
					<label class="checkbox-inline pull-left" id="sign-up-mod">Already Registered? <a href="javascript:void(0);" id="sign_in_id" >Sign In</a></label>
					<input type="submit" class="btn btn-primary pull-right" value="Sign Up">
				</div>
			</form>
		</div>
	</div>
</div>     

<div class="modal" tabindex="-1" role="dialog" id="verify_email">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div class="modal-header">				
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="popUpCLose();">&times;</button>
		</div>
      <div class="modal-body">
        <p>An email is sent to your mail-id. Please check that and verify your account.</p>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$('#sign_in_id').click(function(){
	    $('#signup_modal').modal('hide');
	    $('#login_modal').modal('show');

 	});   
 	// Sign up // 
 	$('#signup_form').submit(function (event) {
 		event.preventDefault();
 		var user_name = $('#signup_form #user_name').val();
		var user_email = $('#signup_form #user_email').val();
		var user_phone = $('#signup_form #user_phone').val();
		var user_password = $('#signup_form #user_password').val();
		var login_type = 1;
		var postdata = {
		  	user_name:user_name,
		  	user_email:user_email,
		  	user_phone:user_phone,
		  	user_password:user_password,
		  	login_type:login_type
		};
		var url = "<?php echo base_url('login/signup'); ?>";
		$.ajax({
		    url: url,
		    type: "POST",
		    data: postdata,
		    success: function(response) {console.log(response);
		      if(response === 'true'){console.log('a');
		      	$('#signup_modal').modal('hide');
		      	$('#verify_email').modal('show');
		      }else if(response === 'false'){
		      	location.reload();
		      }
		    }
		});
 	});
</script>                             		