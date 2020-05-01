<?php
  $error = null;

  include 'includes/autoloader.inc.php';

  $db = new DBConnector();
  $conn = $db->connect();


  if(isset($_POST['save'])){
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $city = $_POST['city_name'];
      $uname = $_POST['uname'];
      $pass = $_POST['pass'];

      $user = new User($first_name,$last_name,$city,$uname,$pass);
      
      //server side form validation
      if(!$user->validateForm()) {
          $user->createFormErrorSessions();
          header("Refresh:0");
          die();
      }
      
      //check if user exists
      if($user->isUserExist($conn)){
          $error = "Username already exists";
      } else {
          
       //save user to db
       $save_user = $user->save($conn);
       //confirmation message
       if($save_user){
        $error = "Save operation was successful";
        $db->closeDB();
       } else {
        $error = "An error occured!";
        $db->closeDB();
       }

      }
      
      
  }
?>

<html>
<head>
<title>IAP-LAB</title>
<link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>
    <header>
        <h1>LAB ASSIGNMENT</h1>
        <h1 id="error_msg"><?php echo $error; ?></h1>
        <div class="form-errors">
        <?php 
        session_start();
        if(!empty($_SESSION['form_errors'])){
           echo " " .$_SESSION['form_errors'];
           unset($_SESSION['form_errors']);
        }
        ?>
      </div> 
    </header>
<div class="form">

<form class="myForm" method="POST" action="<?=$_SERVER['PHP_SELF'] ?>">     
      <input type="text" id="first_name" name="first_name" placeholder="First Name required"/>
      <input type="text" id="last_name" name="last_name" placeholder="Last Name" />
      <input type="text" id="city_name" name="city_name" placeholder="City Name" />
      <input type="text" id="uname" name="uname" placeholder="User Name" />
      <input type="password" id="pass" name="pass" placeholder="Password" />
      <input type="submit" name="save" id="save" value="Save"/>
      <a href="login.php">Login</a>
</form>

<!--- <script src="./validate.js"></script> --->
</div>   

<div class="users">
    <table class="userstab">
    <table>
  <thead>
    <tr>
    <th scope="col">First Name</th>
    <th scope="col">Last Name</th>
    <th scope="col">City Name</th>
    </tr>
  </thead> 

<?php
   $db2 = new DBConnector();
   $conn2 = $db->connect();

   $fname = $lname = $cty = null; 
   $allUsers = new User($fname,$lname,$cty,null,null);
   $result = $allUsers->readAll($conn2);
   while($row = mysqli_fetch_assoc($result)) {
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $city_name = $row['user_city'];
?>

        <tbody>
            <tr>
                <td><?php echo $first_name; ?></td>
                <td><?php echo $last_name; ?></td>
                <td><?php echo $city_name; ?></td>
            </tr>
        </tbody>
   <?php  } ?>
    </table>
</div>
</body>
</html>