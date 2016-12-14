<?php
  #Start the session
  session_start();  
?>
<?php include('config/setup.php'); ?>
<?php
  if($_POST["submitted"] == 1) {
    $fNameErr =$lNameErr = $emailErr = $phoneErr = $passwordErr = $addressErr = "";
    $fName = $lName = $email = $phone = $password = $address = "";
    $hasErr = 0;
# first name validation
  if (empty($_POST['fName'])) {
    $fNameErr = "First Name is required";
    $hasErr = 1;
  } else {
    $fName = test_input($_POST['fName']);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$fName)) {
      $fNameErr = "Only letters and white space allowed"; 
      $hasErr = 1;
    }
  }
# last name validation
  if (empty($_POST["lName"])) {
    $lNameErr = "Last Name is required";
    $hasErr = 1;
  } else {
    $lName = test_input($_POST["lName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lName)) {
      $lNameErr = "Only letters and white space allowed"; 
      $hasErr = 1;
    }
  }
#email validation
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $hasErr = 1;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $hasErr = 1; 
      } else {
          $query = "SELECT * FROM user WHERE email='$email' ";
          $result = mysqli_query($dbc,$query);
          if(mysqli_num_rows($result) > 0){
            $emailErr = "Email has been used, try another one";
            $hasErr = 1;
          }


      }
  }
#address validation
  if (empty($_POST["address"])) {
    $emailErr = "Address is required";
    $hasErr = 1;
  } else {
    $address = test_input($_POST["address"]);
    // check if e-mail address is well-formed
  }


#phone validation
  if(empty($_POST["phone"])) {

  } else {
    $phone = test_input($_POST["phone"]);
    if(!preg_match("/^[0-9]*$/", $phone)) {
      $phoneErr = "Only Numbers";
      $hasErr = 1;
    }
  }
#password validation
  if(empty($_POST["password"])){
    $passwordErr = "Password is required";
    $hasErr = 1;
  }else{
    $password = $_POST["password"];
  }






if($hasErr == 0)
{

    $query = "INSERT INTO person(lastname, firstname, email, phone,address) VALUES ('$lName', '$fName', '$email', '$phone', '$address')";
    $result = mysqli_query($dbc, $query);
    if($result) {
      $name = $fName. ' ' . $lName;
      $query = "INSERT INTO user(username, persion_id, email, password) VALUES ('$name', LAST_INSERT_ID(), '$email', SHA1('$password'))";
      $result = mysqli_query($dbc,$query);
      if($result) { 
        if(isset($_SESSION['username']) and $_SESSION['category'] == 'admin') {
          header('Location: admin/user.php');
        }else{
          header('Location: login.php');
        }
      }else {
        echo '<p>Failed to add a new user:'.mysqli_error($dbc).'</p>';
        echo '<p>'.$query.'</p>';
      }
    } else {
      echo '<p>Failed to add a new user:'.mysqli_error($dbc).'</p>';
      echo '<p>'.$query.'</p>';
    }
  }
}

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Create New User</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <?php include('config/css.php'); ?>
  <?php include('config/js.php'); ?>
  <style>
    .error {color: #FF0000;}
  </style>    
</head>
<body class='indigo lighten-5'>
  <?php include(D_TEMPLATE.'/navigation.php'); ?>
  <div>
    <div class="section" id="index-banner">
      <div class="white z-depth-1 container" style='padding: 1% 1% 1% 1%;'>
        <br><br>
        <div class="row">
          <div class="col s12">
           <h3>User Creation</h3>
         </div>
         <form action="createUser.php" method="post" role="form">
          <div class="input-field col s12">
            <input id="fName" name="fName" type="text" class="validate">
            <label for="fName">First Name</label>
          </div>
          <span class="error col s12">* <?php echo $fNameErr; ?> </span>
          <div class="input-field col s12">
            <input id="lName" name="lName" type="text" class="validate">
            <label for="lName">Last Name</label>
          </div>
          <span class="error col s12">* <?php echo $lNameErr; ?> </span>
          <div class="input-field col s12">
            <input id="phone" name="phone" type="tel" class="validate">
            <label for="phone">Phone</label>
          </div>
          <span class="error col s12">* <?php echo $phoneErr; ?> </span>

          <div class="input-field col s12">
            <input id="email" name="email" type="email" class="validate">
            <label for="email">Email</label>
          </div>
          <span class="error col s12">* <?php echo $emailErr; ?> </span>

          <div class="input-field col s12">
            <input id="address" name="address" type="text" class="validate">
            <label for="address">Address</label>
          </div>
          <span class="error col s12">* <?php echo $addressErr; ?> </span>

          <div class="input-field col s12">
            <input id="password" name="password" type="password" class="validate">
            <label for="password">Password</label>
          </div>
          <span class="error col s12">* <?php echo $passwordErr; ?> </span>
          <div class="col s4">
            <button type="submit" class="waves-effect waves-light btn">Create</button>
            <input type="hidden" name="submitted" value="1">
            <a href='login.php' class="waves-effect waves-light btn">Cancel</a>
          </div>          
         </form>
      </div>
      <div class="row center">
      </div>
      <br><br>
    </div>
  </div>


</div>

<?php include(D_TEMPLATE.'/footer.php'); ?>
</body>
</html>