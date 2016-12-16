<?php
#Start the session
session_start();
if(!isset($_SESSION['username']) or $_SESSION['category'] !='other') {
	header('Location: login.php');
}

?>
<?php include('config/setup.php'); ?>

<?php
	$query = "SELECT * FROM file WHERE user_id=$_SESSION[userid]";
	$result = mysqli_query($dbc,$query);
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
	
	<div style='padding: 1% 1% 1% 1%;'>
		<h>This is the page for MyStuff</h>
		<div>
			<div class="row">
				<table class="responsive-table hightlight col s12">
					<thead>
						<tr>
							<th data-field="filename">File Name</th>
							<th data-field="uploadtime">Upload Time</th>					
							<th data-field="lastdownload">Last Download Time</th>					
						</tr>
					</thead>
					<tbody>
						<?php
								while($table_user = mysqli_fetch_assoc($result)) {
									?>
									<tr>
										<!--
										<td><?php echo '<a href="handledownload.php?id='.$table_user['savename'].'">'.$table_user['filename'].'</a>'; ?></td> -->
										<td><?php echo '<a href="storage/'.$table_user['savename'].'">'.$table_user['filename'].'</a>'; ?></td>
										<td><?php echo $table_user['uploadtime']; ?></td>
										<td><?php echo $table_user['lastdownloadtime']; ?></td>
										<!--
										<td><?php echo '<a href="delete_user.php?id='.$table_user['user_id'].'">Delete</a>' ?></td>
										-->
									</tr>				
									<?php
								}				
							?>
						
					</tbody>
				</table>
				
			</div>
		</div>

		
		
	</div>
	
	<?php include(D_TEMPLATE.'/footer.php'); ?>
  </body>
</html>