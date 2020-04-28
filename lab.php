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
          $db->closeDB();
      } else {
          $error = "An error occured!";
          $db->closeDB();
      }
  }
?>

<html>
<head>
<title>IAP-LAB</title>
<link rel="stylesheet" type="text/css" href="form.css">
<script type="text/javascript" src-"validate.js"></script>
</head>
<body>
    <header>
        <h1>LAB ASSIGNMENT</h1>
        <h1 id="error_msg"><?php echo $error; ?></h1>
    </header>
<div class="form">

<form class="myForm" method="POST" action="<?=$_SERVER['PHP_SELF'] ?>">
      <input type="text" id="first_name" name="first_name" placeholder="First Name"/>
      <input type="text" id="last_name" name="last_name" placeholder="Last Name" />
      <input type="text" id="city_name" name="city_name" placeholder="City Name" />
      <input type="submit" name="save" id="save" value="Save"/>
</form>

   <script src="./validate.js"></script>
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
   $allUsers = new User($fname,$lname,$cty);
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