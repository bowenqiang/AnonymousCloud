<?php include('config/setup.php'); ?>
<?php
	$message = "";
	if($_POST['submitted'] == 1)
	{
		$query = "SELECT * FROM file WHERE fetchcode='$_POST[retrievingcode]'";
		$result = mysqli_query($dbc,$query);
		$message.=$query."<br>";
		$message.=mysqli_error($dbc)."<br>";
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
	
	<div>		
		<div class="row">
			<form class="col s12" action="DownloadFile.php" method="post" role="form">
				<div class="row">
					<div class="input-field col s12">
						<input type="text" id="retrievingcode" name="retrievingcode" class="validate">
						<label for="retrievingcode">Retrieving Code: </label>						
					</div>					
				</div>
				<button type="submit" class="waves-effect waves-light btn">Submit</button>
            	<input type="hidden" name="submitted" value="1">				
			</form>
		</div>
	</div>

	<div>
		<div class="row">
			<table class="responsive-table hightlight col s12">
				<thead>
					<tr>
						<th data-field="filename">File Name</th>
						<th data-field="uploadtime">Uploadt Time</th>					
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
	<h3>Message:</h3>
	<?php
		//echo "<p>".$message."</p>"
	?>	

		
		
	
	
	<?php include(D_TEMPLATE.'/footer.php'); ?>
  </body>
</html>