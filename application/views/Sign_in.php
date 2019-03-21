<!DOCTYPE html>
<html lang="en">
<head>
	<title>Gracehaven</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url()?>assets/images/sa-logo.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/Login/css/main.css">
<!--===============================================================================================-->
	<link href="<?php echo base_url()?>assets/Dashboard/assets/notifications/notification.css" rel="stylesheet" />
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo base_url()?>assets/images/sa-logo.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="<?= base_url('Auth_user/check_auth')?>" method="post">
					<span class="login100-form-title">
						Gracehaven
					</span>
					<input type="hidden" name="<?= $csrf['name'];?>" value="<?= $csrf['hash'];?>" />

					<div class="wrap-input100 validate-input" data-validate = "Email / NIS is required">
						<input class="input100" type="text" name="email" placeholder="Email / NIS">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user-md" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100" id="show">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							
						</span>
						<a class="txt2" href="#">
							
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#" >
							
							<!-- <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> -->
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="<?php echo base_url()?>assets/Login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/Login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url()?>assets/Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/Login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/Login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			<?php if ($this->session->flashdata('msg')=='try_again') { ?>
			$.Notification.notify('error', 'top right', 'Failed','Please try again ...!');
			<?php } elseif ($this->session->userdata('msg')=='invalid') {?>
			$.Notification.notify('error', 'top right', 'Failed','Password and username invalid  ...!');
			<?php } elseif ($this->session->userdata('msg')=='wrong') {?>
			$.Notification.notify('error', 'top right', 'Failed','There is something wrong. ...!');
			<?php } elseif ($this->session->userdata('msg')=='not_found') {?>
			$.Notification.notify('error', 'top right', 'Failed','Account not found ...!');
			<?php } elseif ($this->session->userdata('msg')=='must_sign') {?>
			$.Notification.notify('error', 'top right', 'Failed','You Must Sign ...!');
			<?php } else {}?>

		});
	</script>
<!--===============================================================================================-->
	<script src="<?php echo base_url()?>assets/Login/js/main.js"></script>
	<script src="<?php echo base_url()?>assets/Dashboard/assets/notifications/notify.min.js"></script>
    <script src="<?php echo base_url()?>assets/Dashboard/assets/notifications/notify-metro.js"></script>
    <script src="<?php echo base_url()?>assets/Dashboard/assets/notifications/notifications.js"></script>
<!--===============================================================================================-->

</body>
</html>