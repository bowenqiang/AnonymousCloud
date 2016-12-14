<?php
#Start the session
session_start();
if(!isset($_SESSION['username']) or $_SESSION['category'] !='admin') {
	header('Location: ../login.php');
}

?>
<?php include('config/setup.php'); ?>
							

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<?php include('config/css.php'); ?>
		<?php include('config/js.php'); ?>		
</head>
<body class='indigo lighten-5'>
	<?php include(D_TEMPLATE.'/navigation.php'); ?>
	
	<div>
		<h>Admin Dashboard</h>
		
		
	</div>
	
	<?php //include(D_TEMPLATE.'/footer.php'); ?>
  </body>
</html>