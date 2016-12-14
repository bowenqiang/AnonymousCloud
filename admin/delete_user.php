<?php
/*
delete_user.php
Delete a specific entry from the user_info table
*/

include('config/connection.php');
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id=$_GET['id'];
    $query = "DELETE FROM user_info WHERE user_id=$id";
    $result = mysqli_query($dbc,$query);
    header("Location: user.php");
}else {
    header("Location: user.php");
}



?>