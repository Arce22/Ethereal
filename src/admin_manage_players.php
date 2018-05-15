<?php
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
.topright {
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 18px;
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

.topright1 {
    position: absolute;
    top: 30px;
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
	               
	                <td><a href="admin_profile.php"><button type="button" style="float: right;" class="btn_name">Profile</button></td>
				</tr>
			 <thead>
	</table>


<div class="vertical-menu">
  <a href="admin_manage_companies.php">Manage Companies</a>
    <a href="admin_manage_players.php">Manage Players</a>
   
    <a href="admin_manage_comments.php">Manage Comments</a>
     <a href="admin_manage_category.php">Manage Categories</a>
  <a href="admin_profile_accountSettings.php">Acount Settings</a>
 
</div>
 
  <div>
     <span style="float:top" class = "topright"

      <label>Admin ID: </label>
      <label><?php echo $_SESSION['admin_id'];?></label> </span>

   </div>




    <div>   
   <table align = "center">
   <thead>
        <th>Player Name</th><br />
        <th>Information</th><br />
        <th>Ban</th><br />
        <th>Warn</th><br /
    </thead>
    <tbody>
     
      <label> Player List: </label></br>
         <?php
         
            $records = $conn->prepare('select * from player'); // = ' .$_SESSION['company_id'].);
            $records->execute();
            $results = $records->fetchAll(); //(PDO::FETCH_ASSOC)

            foreach($results as $result) {

   
              echo "<tr>";
              echo "<td>" . $result['player_id']."</td>" . "<br>";
             echo "<td><a href =\"./admin_player_profile_sideView.php?player_id=" . $result['player_id']. "\"><input type=\"submit\"  value=\"Information\" /></a></form></td>";
             echo "<td><a href =\"./admin_manage_players_ban.php?player_id="  . $result['player_id']. "\"><input type=\"submit\"  value=\"Ban\" /></a></form></td>";
              echo "<td><a href =\"./admin_manage_players_warned.php?player_id="  . $result['player_id']. "\"><input type=\"submit\"  value=\"Warn\" /></a></form></td>";
             echo "</tr>";
            }

         ?>
      
      
        </tbody>
  </table>
 </div>
 




</body>
</html>