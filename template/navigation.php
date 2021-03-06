<?php
  if(!session_start()) {
    header("Location: error.php");
    exit;
  }
?>

<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
	<li><a href="#">Setting</a></li>
	<li><a href="logout.php">Logout</a></li>	
</ul>

<ul id="dropdown2" class="dropdown-content">
	<li><a href="#">Setting</a></li>
	<li><a href="logout.php">Logout</a></li>	
</ul>

<nav class="blue-grey darken-1">
	<div class="nav-wrapper">
		<a href="#" class="brand-logo"><i class="material-icons">cloud</i>AnonymousCloud</a>
		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		<ul class="right hide-on-med-and-down">
		<?php
			if(isset($_SESSION['username'])) {
				if($_SESSION['category'] == 'admin') {
					echo '<li><a href="admin/index.php">Home</a></li>';
					echo '<li><a href="admin/StuffManage.php">File Manage</a></li>';
					echo '<li><a href="admin/UserManage.php">User Manage</a></li>';
				} else {
					echo '<li><a href="index.php">Home</a></li>';
					echo '<li><a href="inventory.php">My Stuffs</a></li>';
				}
				
			}
		?>
		    <li><a href="UploadFile.php">Upload File</a></li>
	        <li><a href="DownloadFile.php">Download File</a></li>       
        <?php
            if(isset($_SESSION['username'])) { 

                echo '<li><a class="dropdown-button" href="#" data-activates="dropdown1">'.$_SESSION['username'].'<i class="material-icons right">arrow_drop_down</i></a></li>';    
            }else{
                echo '<li><a href="login.php">Log in</a></li>';
            }
            
        ?>
	  </ul>
	
		<ul id="mobile-demo" class="side-nav">
		<?php
			if(isset($_SESSION['username'])) {
				if($_SESSION['category'] == 'admin') {
					echo '<li><a href="admin/index.php">Home</a></li>';
					echo '<li><a href="admin/StuffManage.php">File Manage</a></li>';
					echo '<li><a href="admin/UserManage.php">User Manage</a></li>';
				} else {
					echo '<li><a href="index.php">Home</a></li>';
					echo '<li><a href="inventory.php">My Stuffs</a></li>';
				}
			}
		?>
			<li><a href="UploadFile.php">Upload File</a></li>
			<li><a href="DownloadFile.php">Download File</a></li>
		 <?php
            if(isset($_SESSION['username'])) { 

                echo '<li><a class="dropdown-button" href="#" data-activates="dropdown2">'.$_SESSION['username'].'<i class="material-icons right">arrow_drop_down</i></a></li>';    
            }else{
                echo '<li><a href="login.php">Log in</a></li>';
            }
            
        ?>

		</ul>
	</div>
</nav>
  
