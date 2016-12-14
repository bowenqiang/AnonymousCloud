<?php
#Start the session
session_start();
if(!isset($_SESSION['username']) or $_SESSION['category'] != 'admin') {
	header('Location: ../login.php');
}
?>
<?php include('config/setup.php'); ?>
<?php
	if(isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = $_GET['id'];
		$query = "SELECT * FROM user_info WHERE user_id=$id";
		$result = mysqli_query($dbc,$query);
		$data = mysqli_fetch_assoc($result);
	}
?>
<?php
	if($_POST["updated"] == 1) {
		$id = $_GET['id'];
		if(isset($_POST['isactive']) && $_POST['isactive'] == 'Yes') {
			$isactive = 1;
		}else {
			$isactive = 0;
		}							
		$query = "UPDATE user_info SET UserName='$_POST[username]', AccountEmail='$_POST[email]', Hashword='$_POST[password]',isActive=$isactive,Category='$_POST[category]' WHERE user_id=$_POST[id]";
		$result = mysqli_query($dbc, $query);
		if($result) {
			echo '<p>User was Updated!</p>';
			header('Location: user.php');
		} else {
			echo '<p>Failed to Updated user:'.mysqli_error($dbc).'</p>';
			echo '<p>'.$query.'</p>';
		}
		
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>User Management | User Editing</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<?php include('config/css.php'); ?>
		<?php include('config/js.php'); ?>				
	</head>
	<body class='indigo lighten-5'>
		<div class="container">			
			<div class="wrap">
				<div class="row">
					<div class="col-md-4">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h5>Edit User</h5>
							</div>
							<div class="panel-body">
								<form action="edit_user.php" method="post" role="form">
									<div class="form-group">
										<label for="UserName">UserName</label>
										<input type="username" class="form-control" id="username" name="username" <?php echo 'value="'.$data['UserName'].'"'?>>
									</div>
									<div class="form-group">
										<label for="Email">Email address</label>
										<input type="email" class="form-control" id="Email" name="email" <?php echo 'value="'.$data['AccountEmail'].'"'?>>
									</div>
									<div class="form-group">
										<label for="Password">Password</label>
										<input type="password" class="form-control" id="Password" name="password" <?php echo 'value="'.$data['Hashword'].'"'?>>
									</div>
									<div class="form-group">
										<label for="Category">Category</label>
										<select class="form-control" id="Category" name="category" <?php echo 'value="'.$data['Category'].'"'?>>
											<option>admin</option>
											<option>other</option>
										</select>
									</div>								
									<div class="form-group">
										<label for="isActive">isActive</label>
										<select class="form-control" id="isActive" name="isactive">
											<option>Yes</option>
											<option>No</option>
										</select>
									</div>
									<button type="update" class="btn btn-default">Update</button>
									<input type="hidden" name="updated" value="1">
									<input type="hidden" name="id" value="<?php echo $id ?>">
								</form>
							</div><!--END panel body-->
						</div> <!--END panel-->
					</div><!--END col-->
				</div><!--END row-->
			</div>
		</div> <!--END container-->	
		<?php //include(D_TEMPLATE.'/footer.php'); ?>
	</body>
</html>