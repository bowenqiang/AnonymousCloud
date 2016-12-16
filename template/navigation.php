<?php
	if(!session_start()) {
		header("Location: error.php");
		exit;
	}
?>

<nav class="indigo" role="navigation">
	<div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">AnonymousCloud Created By WBQ</a>
	  <ul class="right hide-on-med-and-down">
	    <li><a href="UploadFile.php">Upload File</a></li>
        <li><a href="DownloadFile.php">Download File</a></li>       
        <?php
            if($_SESSION['category'] == 'admin'){
                echo '<li><a href="admin/user.php">Users Management</a></li>';
            }
            if(isset($_SESSION['username'])) {
                echo '<li><a href="logout.php">Log out</a></li>';
            }else{
                echo '<li><a href="login.php">Log in</a></li>';
            }
            
        ?>
	  </ul>
	
	  <ul id="nav-mobile" class="side-nav">
	    <li><a href="#">Navbar Link</a></li>
	  </ul>
	  <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
	</div>
</nav>
  
