<?php
#Start the session
session_start();
if(!isset($_SESSION['username']) or $_SESSION['category'] !='admin') {
	header('Location: login.php');
}

?>
<?php include('config/setup.php'); ?>

<?php
	$query = "SELECT file.*, user.* FROM file, user WHERE file.user_id = user.user_id;";
	$result = mysqli_query($dbc,$query);								
?>
							

<!DOCTYPE html>
<html>
	<head>
		<title>All Files</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<?php include('config/css.php'); ?>
		<?php include('config/js.php'); ?>		
</head>
<body class='indigo lighten-5'>
	<?php include(D_TEMPLATE.'/navigation.php'); ?>
	
	<div style='padding: 1% 1% 1% 1%;'>
		<div>
			<div class="row">
				<table class="responsive-table hightlight col s12">
					<thead>
						<tr>
							<th data-field="filename">File Name</th>
							<th data-field="uploadtime">Upload Time</th>					
							<th data-field="lastdownload">Last Download Time</th>
							<th data-field="user_id">Upload By</th>					
						</tr>
					</thead>
					<tbody>
						<?php
								while($table_file = mysqli_fetch_assoc($result)) {
									?>
									<tr>
										
										<td><?php echo '<a href="../handledownload.php?id='.$table_file['file_id'].'">'.$table_file['filename'].'</a>'; ?></td> 
										
										<td><?php echo $table_file['uploadtime']; ?></td>
										<td><?php echo $table_file['lastdownloadtime']; ?></td>
										<td><?php echo $user_id = $table_file['username']; ?></td>
										<td><?php echo '<a href="../delete_file.php?id='.$table_file['file_id'].'">Delete</a>' ?></td>
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