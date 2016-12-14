<?php
#Start the session
session_start();
if(!isset($_SESSION['username']) or $_SESSION['category'] != 'admin') {
	header('Location: ../login.php');
}
?>
<?php include('config/setup.php'); ?>
<?php
	if($_POST["submitted"] == 1) {
		if(isset($_POST['isactive']) && $_POST['isactive'] == 'Yes') {
			$isactive = 1;
		}else {
			$isactive = 0;
		}							
		$query = "INSERT INTO user_info(UserName, AccountEmail, Hashword, isActive, Category) VALUES ('$_POST[username]', '$_POST[email]', '$_POST[password]', $isactive,'$_POST[category]')";
		$result = mysqli_query($dbc, $query);
		if($result) {
			echo '<p>User was added!</p>';
		} else {
			echo '<p>Failed to add a new user:'.mysqli_error($dbc).'</p>';
			echo '<p>'.$query.'</p>';
		}
		//header('Location: user.php');
	}
?>


<?php
if(isset($_POST['search']))
{
	$ValueToSearch = $_POST['ValueToSearch'];
	$query = "SELECT * From user_info WHERE CONCAT(UserName,AccountEmail,Category) LIKE '%".$ValueToSearch."%'";
}else{
	$query = "SELECT * From user_info";
}

if ($_GET['sort'] == 'userid') {
	$query .= " ORDER BY user_id";
}
elseif ($_GET['sort'] == 'username') {
	$query .= " ORDER BY UserName";
}
elseif ($_GET['sort'] == 'pid') {
	$query .= " ORDER BY PID";
}
elseif ($_GET['sort'] == 'accountemail') {
	$query .= " ORDER BY AccountEmail";
}
elseif ($_GET['sort'] == 'isactive') {
	$query .= " ORDER BY isActive";
}
elseif ($_GET['sort'] == 'category') {
	$query .= " ORDER BY Category";
}
$result = mysqli_query($dbc, $query);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>User Management</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<?php include('config/css.php'); ?>
		<?php include('config/js.php'); ?>
				
	</head>
	<body>
		<div id="wrap">
		<?php include(D_TEMPLATE.'/navigation.php'); ?>
		<div class="container">
			<h1>All users:</h1>
			<form action="user.php" method="post">
				<input type="text" name="ValueToSearch" placeholder="Value To Search"><br><br>
				<input type="submit" name="search" value="Search"><br><br>
				<table class="table able-bordered" >
					<tr>
						<th><a href="user.php?sort=userid">user_id</a></th>
						<th><a href="user.php?sort=username">UserName</a>></th>
						<th><a href="user.php?sort=pid">PID</a></th>
						<th><a href="user.php?sort=accountemail">AccountEmail</a>></th>
						<th>Hashword</th>
						<th><a href="user.php?sort=isactive">isActive</a></th>
						<th><a href="user.php?sort=category">Category</a>></th>
					</tr>
						<?php
						while($table_user = mysqli_fetch_assoc($result)) {
							?>
							<tr>
								<td><?php echo $table_user['user_id']; ?></td>
								<td><?php echo $table_user['UserName']; ?></td>
								<td><?php echo $table_user['PID']; ?></td>
								<td><?php echo $table_user['AccountEmail']; ?></td>
								<td><?php echo $table_user['Hashword']; ?></td>
								<td><?php echo $table_user['isActive']; ?></td>
								<td><?php echo $table_user['Category']; ?></td>
								<td><?php echo '<a href="edit_user.php?id='.$table_user['user_id'].'">Edit</a>' ?></td>
								<td><?php echo '<a href="delete_user.php?id='.$table_user['user_id'].'">Delete</a>' ?></td>
								
							</tr>				
							<?php
						}				
					?>				
				</table>	
				
			</form>			
			<!--<div class="row">
				<div class="col-md-4">

					<div class="panel panel-info">
						<div class="panel-heading">
							<h5>Create New User</h5>
						</div>
						<div class="panel-body">
							<form action="user.php" method="post" role="form">
								<div class="form-group">
									<label for="UserName">UserName</label>
									<input type="username" class="form-control" id="username" name="username" placeholder="Username">
								</div>
								<div class="form-group">
									<label for="Email">Email address</label>
									<input type="email" class="form-control" id="Email" name="email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="Password">Password</label>
									<input type="password" class="form-control" id="Password" name="password" placeholder="Password">
								</div>
								<div class="form-group">
									<label for="Category">Category</label>
									  <select class="form-control" id="Category" name="category">
									    <option>admin</option>
									    <option>other</option>
									    <option>3</option>
									    <option>4</option>
									  </select>
								</div>								
								<div class="form-group">
									<label for="isActive">isActive</label>
									  <select class="form-control" id="isActive" name="isactive">
									    <option>Yes</option>
									    <option>No</option>
									  </select>
								</div>
								<button type="submit" class="btn btn-default">Submit</button>
								<input type="hidden" name="submitted" value="1">
							</form>
						</div>
					</div> 
				</div>
			</div>
			
			
			
			<button>Create New User</button>
			<button>Disable User</button>
			<button>Delete User</button>
		</div> -->
	
		<?php //include(D_TEMPLATE.'/footer.php'); ?>
		</div>
	</body>
</html>
