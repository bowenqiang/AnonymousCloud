<?php
#Start the session
session_start();
if(!isset($_SESSION['username']) or $_SESSION['category'] !='other') {
	header('Location: login.php');
}
//header('Location: browseManifests.php');
?>
<?php include('config/setup.php'); ?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $page['title'].' | '.$site_title; ?></title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<?php include('config/css.php'); ?>
		<?php include('config/js.php'); ?>				
	</head>
	<body>
		<?php include(D_TEMPLATE.'/navigation.php'); ?>		
		<div class="container">
			<h1>This is the page for General User</h1>			
		</div>				
		<?php include(D_TEMPLATE.'/footer.php'); ?>
	</body>
</html>