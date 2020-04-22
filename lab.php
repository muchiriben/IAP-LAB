<?php
  $error = null;

  include 'includes/autoloader.inc.php';

  $db = new DBConnector();
  $conn = $db->connect();


  if(isset($_POST['save'])){
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $city = $_POST['city_name'];

      $user = new User($first_name,$last_name,$city);
      $save_user = $user->save($conn);

      if($save_user){
          $error = "Save operation was successful";
      } else {
          $error = "An error occured!";
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
        <h1><?php echo $error; ?></h1>
    </header>
<div class="form">
<form method="POST" action="lab.php">
      <table>
      <tr>
         <td><input type="text" name="first_name" placeholder="First Name" /></td>
      </tr>

      <tr>
      <td><input type="text" name="last_name" placeholder="Last Name" /></td>
      </tr>
      
      <tr>
      <td><input type="text" name="city_name" placeholder="City Name" /></td>
      </tr>
      
      <tr>
      <td><input type="submit" name="save" value="Save" /></td>
      </tr>
      </table>
   </form>
</div>   
</body>
</html>