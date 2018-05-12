<?php
/**
 * Created by PhpStorm.
 * User: Nursonto
 * Date: 9.05.2018
 * Time: 17:54
 */
session_start();
require 'database.php';
if( isset($_SESSION['admin_id'])) {
	header("Location: ");
}
?>

<!DOCTYPE html>
<html>
<style>
body {
    background-color: lightblue;
}
h1 {
    color: white;
    text-align: center;
}
p {
    font-family: verdana;
    font-size: 20px;
}
th,td {
    border: 1px solid black;
	   padding: 15px;
}
.vertical-menu {
    width: 200px; /* Set a width if you like */
}
.vertical-menu a {
    background-color: #eee; /* Grey background color */
    color: black; /* Black text color */
    display: block; /* Make the links appear below each other */
    padding: 12px; /* Add some padding */
    text-decoration: none; /* Remove underline from links */
}
.vertical-menu a:hover {
    background-color: #ccc; /* Dark grey background on mouse-over */
}
.vertical-menu a.active {
    background-color: #4CAF50; /* Add a green color to the "active/current" link */
    color: white;
}
.btn_name{
    margin-right:10px;
	margin-left:10px;
}
.btn-group button {
    background-color: #4CAF50; /* Green background */
    border: 1px solid green; /* Green border */
    margin-top:10px;
	margin-bottom:10px;
    color: white; /* White text */
    padding: 10px 24px; /* Some padding */
    cursor: pointer; /* Pointer/hand icon */
    width: 10%; /* Set a width if needed */
    display: block; /* Make the buttons appear below each other */
}
.center {
    height: 200px;
    width: 400px;
    position: fixed;
    top: 50%;
    left: 50%;
    margin-top: -100px;
    margin-left: -200px;
}
.topright {
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 18px;
}
.name-group label {
    margin-top:10px;
	margin-bottom:10px;
    color: black; /* White text */
}
.btn-group button:not(:last-child) {
    border-bottom: none; /* Prevent double borders */
}
/* Add a background color on hover */
.btn-group button:hover {
    background-color: #3e8e41;
}
</style>
<head>
	<title>Ethereal</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>
	<h1>Admin Profile</h1>
    <table align = "center">
            <thead>
				<tr>
                    <td><a href="admin_market.php"><button type="button" style="float: right;" class="btn_name">Market Place</button></td>
	                <td><a href="admin_games.php"><button type="button" style="float: right;" class="btn_name">Games</button></td>
	                <td><a href="admin_profile.php"><button type="button" style="float: right;" class="btn_name">Profile</button></td>
				</tr>
			 <thead>
	</table>


<div>

      <span style="float:center" allign= "center" class = "center"

      <?php
            $records = $conn->prepare('select admin_id from admin where  admin_id = :admin_id');
            $records->bindParam(':admin_id', $_SESSION['admin_id']);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Admin Name: </label>
      <label><?php echo $results['admin_id'];?></label><br />

       <?php
            $records = $conn->prepare('select admin_email from admin where admin_id = :admin_id');
            $records->bindParam(':admin_id', $_SESSION['admin_id']);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Admin Email: </label>
      <label><?php echo $results['admin_email'];?></label><br />


      </span>
   </div>


<div class="vertical-menu">
    <a href="admin_manage_companies.php">Manage Companies</a>
    <a href="admin_manage_users.php">Manage Users</a>
    <a href="admin_manage_comments.php">Manage Comments</a>
  <a href="admin_profile_accountSettings.php">Acount Settings</a>


</div>

<div>
     <span style="float:top" class = "topright"

      <label>Admin ID: </label>
      <label><?php echo $_SESSION['admin_id'];?></label> </span>

   </div>


</body>
</html>