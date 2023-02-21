<!DOCTYPE>
<html>
<head>
	<title>GREEN HIGHRANGE</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bootstrap/css/login_css/style.css">
</head>
<body style="background: url('<?php echo base_url();?>Images/back4.jpg'); background-size:  cover;">

	<div class="login-page">
	
		<div class="form" style="background: white;border-radius: 10px;font-weight:bold;">
				<div class="alert alert-success" align="center" style="opacity: 0.7;  padding:0px;">
					<img src="<?php echo base_url();?>Images/logo.png" style="width: 100%;">
				</div>
				<br>
				
				<form class="login-form" method='post' style="font-weight:bold;">
					<input type="text" name="username" placeholder="Username" style="border:1px solid #d6cece;"/>
					<span style="color:#b30000"><?php echo form_error('username'); ?></span>
					<input type="password" name="password" placeholder="Password" style="border:1px solid #d6cece;"/>
					<span style="color:#b30000"><?php echo form_error('password'); ?></span>
					<button style="font-weight:bold;background:#d26b53;">login</button>
					<span style="color:#f8f9f9"><?php if (isset($message)) echo $message; ?><span>
				</form>
		

				<br><br><br>
				<div class="alert alert-success" align="center" style="opacity: 0.7;  padding:0px;">
				<img src="<?php echo base_url();?>Images/nab1.png" style="width: 100%;height:15%;">
				</div>
		</div>
	</div>
	<script src='<?php echo base_url(); ?>/assets/js/jquery.min.js'></script>
	<script src="<?php echo base_url(); ?>/assets/js/login_js/index.js"></script>
</body>
</html>

<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>