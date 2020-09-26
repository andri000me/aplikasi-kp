<!DOCTYPE html>
<html>
<head>
	<title>Delete Soon!</title>
</head>
<body>
	<h1>Login succed !</h1>
	<h2>Welcome, <?php echo $this->session->userdata("nama"); ?>
		
	</h2>
	<a href="<?php echo base_url().'login/logout'; ?>">Logout</a>
</body>
</html>