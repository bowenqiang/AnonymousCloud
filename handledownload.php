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
    	$filename = $file_data['filename'];
    	if(file_exists($savename))
    	{
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($savename));
		    readfile($savename);
            $date = date('Y-m-d H:i:s');
            $query = "UPDATE file SET lastdownloadtime='$date' WHERE file_id = $id";
            $result = mysqli_query($dbc,$query);
            exit;
            header("Location: inventory.php");

    	}
    	else
    	{
    		$message.="File does not exit!".$filename;
    	}
 
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