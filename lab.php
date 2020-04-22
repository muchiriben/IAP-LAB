<?php
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
          echo "Save operation was successful";
      } else {
          echo "An error occured!";
      }
  }
?>

<html>
<head>
<title>IAP-LAB</title>
</head>
<body>
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
</body>
</html>