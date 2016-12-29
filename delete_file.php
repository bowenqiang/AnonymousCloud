<?php
include('config/setup.php');
$message = "";
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id=$_GET['id'];
    $query = "SELECT * FROM file WHERE file_id=$id";
    $result = mysqli_query($dbc,$query);
    $message.=$query."<br>";
    if(mysqli_num_rows($result) == 1)
    {
    	$file_data = mysqli_fetch_assoc($result);
    	$savename= D_STORAGE.$file_data['savename'];
    	if(file_exists($savename))
    	{
	    	if(unlink($savename))
	    	{
	    		$message.="Deleted file: ".$savename;
	    	}
	    	else
	    	{
	    		$message.="Error deleting file: ".$savename;
	    	}
    	}
    	else
    	{
    		$message.="File does not exit!".$savename;
    	}
 
    	$query = "DELETE FROM file WHERE file_id=$id";
    	$result = mysqli_query($dbc,$query);
    }
    else
    {
    	$message.="Error file name";
    }
}
else
{
	$message.="Error ID";
}
header("Location: inventory.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h4>Message:</h4>
	<?php echo '<p>'.$message.'</p>' ?>

</body>
</html>