<?php include('config/setup.php'); ?>
<?php
	if($_POST["submitted"] == 1)
	{
		$max_file_size = 1024*1024*10; //10mb
		$uploadOk = 0;
		$message = "";
		$retrievingcode = uniqid();
		$total = count($_FILES['upload']['name']);
		foreach ($_FILES['upload']['tmp_name'] as $key => $tmp_name) 
		{
			$tmpFilePath = $_FILES['upload']['tmp_name'][$key];
			//check size
			if($_FILES['upload']['size'][$key] < $max_file_size)
			{
				//make sure each file has a unique name
				$originname=$_FILES['upload']['name'][$key];
				$temp = explode(".",$originname);
				do
				{
					$newname = round(microtime(true)).uniqid().'.'.end($temp);
					$newFilePath = D_STORAGE.$newname;
				}while(file_exists(newFilePath));

				if(move_uploaded_file($tmpFilePath, $newFilePath))
				{

					$message.=$originname."---Upload Successfully<br>";
					$uploadOk = 1;
					//update databse
					$date = date('Y-m-d H:i:s');

					$query = "INSERT INTO file(fetchcode, filename, savename,uploadtime) VALUES ('$retrievingcode','$originname', '$newname','$date')";
					$result = mysqli_query($dbc,$query);
					if(!$result)
					{
						$message.=mysqli_error($dbc).": ".$query."<br>";
					}

				}
				else
				{
					$message.=$originname."---Upload Failed: ".$_FILES['upload']['error'][$key]."<br>";
				}
			}
			else
			{
				$message.=$originname."---File size too large,Upload Failed: ".$_FILES['upload']['error'][$key]."<br>";
			}			
		} 
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Upload</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<?php include('config/css.php'); ?>
		<?php include('config/js.php'); ?>		
</head>
<body class='indigo lighten-5'>
	<?php include(D_TEMPLATE.'/navigation.php'); ?>
	
	<div>
		<form action="UploadFile.php" method="post" role="form" enctype="multipart/form-data">
			<div class="file-field input-field">
				<div class="btn">
					<span>File</span>
					<input name="upload[]" type="file" multiple="multiple">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text" placeholder="Upload one or more files">
				</div>
			</div>
			<button type="submit" class="waves-effect waves-light btn">Upload</button>
            <input type="hidden" name="submitted" value="1">
		</form>
		<?php
			echo '<h3>Message:</h3>';
			echo '<p>'.$message.'</p>';
			echo '<h3>Your Retrieving Code is Here: </h3>';
			if($uploadOk == 1){
				echo '<p>'.$retrievingcode.'</p>';
			}			
		?>

		
		
	</div>
	
	<?php include(D_TEMPLATE.'/footer.php'); ?>
  </body>
</html>