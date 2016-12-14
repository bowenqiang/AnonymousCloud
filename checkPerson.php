<?php
/* this function takes a first name and a last name, and queries the person database for it.
 * If that person exists, it returns the PID. If that person does not exist, it inserts them
 * into the database and then requeries for the PID, and returns the PID
 */

function checkPerson($dbc, $FirstName, $LastName){
//	echo "<script type='text/javascript'>alert('STARTING checkPerson function')</script>";
	$sql = "SELECT PID FROM person WHERE FirstName='$FirstName' AND LastName='$LastName'";

	if($result = mysqli_query($dbc, $sql)){
		if(mysqli_num_rows($result)){
//			echo "<script type='text/javascript'>alert('person found!')</script>";
			$data=mysqli_fetch_assoc($result);
			return $data['PID'];
		} else { /* the person does not exist, so we must insert them */
//			echo "<script type='text/javascript'>alert('person not found!')</script>";
			$sql_2 = "INSERT INTO person (PID, FirstName, LastName) VALUES (NULL, '$FirstName', '$LastName')";
//			echo $sql_2;
			if($result_2 = mysqli_query($dbc, $sql_2)){
				/* insert succeeded, query again to get PID */
//				echo "<script type='text/javascript'>alert('insert succeeded')</script>";
				if($result = mysqli_query($dbc, $sql)){
					if(mysqli_num_rows($result)){
						$data=mysqli_fetch_assoc($result);
//						echo "<script type='text/javascript'>alert('requery succeeded!')</script>";
						return $data['PID'];
					} else { /* requery failed */
						echo "<script type='text/javascript'>alert('requery failed')</script>";
					}
				}
			} else { /* insert failed */
				echo "<script type='text/javascript'>alert('insert failed')</script>";
			}
		}
	}
}
?>
