<?php include('config/setup.php'); ?>
<?php include('config/connection.php'); ?>
<?php
	$message="";
	set_time_limit(24*60*60);
	if(isset($_GET['id']))
	{
		$savename=$_GET['id'];
		$fullpath = D_STORAGE.$savename;
		$message=$fullpath;
		if($fd = fopen($fu, "r"))
		{

		}
		fclose($fd);
		$message.="HI"
	}


?>
							
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
	<h3>Message:</h3>
	<?php
		echo "<p>".$message."</p>"
	?>	
  </body>
</html>

