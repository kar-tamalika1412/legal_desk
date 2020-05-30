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
	#login_modal a{
		font-size: small;
		color: #56a3e6;
	}
	#sign-up-mod{
		float: left;
		margin-right: 129px;
	}
</style>
<!-- Modal HTML -->
<div id="login_modal" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<form action="" method="post" id="login_form">
				<div class="modal-header">				
					<h4 class="modal-title">Sign In</h4>
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
						<input type="text" class="form-control" name = "user_email" id= "user_email" required="required" placeholder="Email">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name = "user_password" id= "user_password" required="required" placeholder="Password"><br>
						<p id="invalid_credential" style="color: red;"></p>
					</div>

				</div>
				<div class="modal-footer">
					<label class="checkbox-inline pull-left" id="sign-up-mod">Not Registered us yet? <a href="javascript:void(0);" id="sign_up_id">Sign Up</a></label>
					<label class="checkbox-inline pull-right"><a href="">Forgot Password?</a></label>
					<input type="submit" class="btn btn-primary pull-right" value="Login">
				</div>
			</form>
		</div>
	</div>
</div>     

<script type="text/javascript">
	$('#sign_up_id').click(function(){
    	$('#login_modal').modal('hide');
    	$('#signup_modal').modal('show');
    	$('#signup_modal').css('overflow','auto');
    	$('body').css('overflow','hidden');
  	});   

		// Sign up // 
 	$('#login_form').submit(function (event) {
 		event.preventDefault();
 		var user_email = $('#login_form #user_email').val();
		var user_password = $('#login_form #user_password').val();
		var postdata = {
		  	user_email:user_email,
		  	user_password:user_password
		};
		var url = "<?php echo base_url('login/do_login'); ?>";
		$.ajax({
		    url: url,
		    type: "POST",
		    data: postdata,
		    success: function(response) {
		      if(response === 'true'){
		      	location.reload();
		      }else if(response === 'false'){
		      	$('#invalid_credential').text('Invalid email-id/password');
		      }
		    }
		});
 	});
</script>