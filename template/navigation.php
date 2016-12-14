<?php
	if(!session_start()) {
		header("Location: error.php");
		exit;
	}
?>

<nav class="indigo" role="navigation">
	<div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">OCDX Repo - Group 6</a>
	  <ul class="right hide-on-med-and-down">
      <li><a href="https://github.com/OCDX/OCDX-Specification">OCDX Git Hub</a></li>
      <li><a href="https://github.com/JustinRenneke/CS4320-Semester-Final-Project/wiki">Repo Git Hub</a></li>
	    <li><a href="browseManifests.php">Search</a></li>
        <li><a href="createManifest.php">Upload Manifest</a></li>
        
        <?php
            if($_SESSION['category'] == 'admin'){
                echo '<li><a href="admin/user.php">Users</a></li>';
            }
            if(isset($_SESSION['username'])) {
                echo '<li><a href="logout.php">Log out</a></li>';
            }else{
                echo '<li><a href="login.php">Log in</a></li>';
            }
            
        ?>
          <!--        <li><a href="logout.php">Logout</a></li>-->
	<!--         <li><input id="search"><i class="material-icons">search</i></li> -->
	  </ul>
	
	  <ul id="nav-mobile" class="side-nav">
	    <li><a href="#">Navbar Link</a></li>
	  </ul>
	  <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
	</div>
</nav>
  
