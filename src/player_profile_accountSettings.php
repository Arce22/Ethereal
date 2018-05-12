<?php
session_start();
require 'database.php';
if( isset($_SESSION['user_id'])) {
	header("Location: ");
}

       $records = $conn->prepare('select password from player where player_id = :player_id'); // = ' .$_SESSION['company_id'].);
            $records->bindParam(':player_id', $_SESSION['user_id']);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
if($results['password']==  $_POST['password_old']){

if(  !empty($_POST['password_new'])&& !empty($_POST['password_r_new'])&& ($_POST['password_new']==$_POST['password_r_new'])):
  
    // adding to player table
     $records1 = $conn->prepare('UPDATE player SET password = :new_password WHERE player_id = :player_id');
     $records1->bindParam(':player_id', $_SESSION['user_id']); 
     $records1->bindParam(':new_password',  $_POST['password_new']);
   //  $records1->bindParam(':new_company_name',  $_POST['company_name_change']);
     $records1->execute();

endif;


if(($_POST['password_new'])!=($_POST['password_r_new'])){
  echo '<script language="javascript">';
  echo 'alert("New password and repeat password does not match!")';
  echo '</script>';
  
}
}

else if(($results['password']!=  $_POST['password_old'])&& !empty($_POST['password_old'])){
   echo '<script language="javascript">';
  echo 'alert("Old password is incorrect!")';
  echo '</script>';
  
}

if( ($results['password']!=  $_POST['password_old'])&& !empty($_POST['e_mail_change'])):
  
    // adding to player table
     $records1 = $conn->prepare('UPDATE information SET player_email = :new_company_email WHERE player_id = :player_id');
     $records1->bindParam(':player_id', $_SESSION['user_id']); 
     $records1->bindParam(':new_company_email',  $_POST['e_mail_change']);
   //  $records1->bindParam(':new_company_name',  $_POST['company_name_change']);
     $records1->execute();

endif;


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
	<h1>Company Profile</h1>
    <table align = "center">
            <thead>
				<tr>
                <td><a href="player_market.php"><button type="button" style="float: right;" class="btn_name">Market Place</button></td>
	                <td><a href="player_games.php"><button type="button" style="float: right;" class="btn_name">Games</button></td>
	                <td><a href="player_profile.php"><button type="button" style="float: right;" class="btn_name">Profile</button></td>
				</tr>
			 <thead>
	</table>


<div class="vertical-menu">
<a href="player_profile_information.php">Information</a>
        <a href="player_profile_gameHistory.php">Game History</a>
        <a href="player_profile_addFund.php">Add Funds to Wallet</a>
        <a href="player_profile_accountSettings.php">Account Settings</a>
 
</div>
 
  <form action = "player_profile_accountSettings.php" method = "post" align = "center">
                <p>Account Settings</p>
                 
                   <label for="e_mail_change"><b>New Email</b></label>
                  <input type="text" placeholder="Enter Email" name="e_mail_change"  class = "box1"><br /><br />
                   <label for="password_signup"><b>Old Password</b></label>
                  <input type="password" placeholder="Enter Password" name="password_old"  class = "box1"><br /><br />

                  <label for="password_signup"><b>Password</b></label>
                  <input type="password" placeholder="Enter Password" name="password_new"  class = "box1"><br /><br />

                  <label for="psw-repeat"><b>Repeat Password</b></label>
                  <input type="password" placeholder="Repeat Password" name="password_r_new" class = "box1"><br /><br />
                 <input type = "submit" value = "Save"/><br />
         
               </form>

<div>
<span style="float:top" class = "topright"

<label>Player ID: </label>
<label><?php echo $_SESSION['user_id'];?></label> </span>

<span style="float:right" class = "topright1"
    <?php

     $records = $conn->prepare('select balance from player where player_id = :player_id'); // = ' .$_SESSION['company_id'].);
     $records->bindParam(':player_id', $_SESSION['user_id']);
     $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    ?>
<label>Balance: $ </label>
    <label><?php echo $results['balance'];?></label>
</span>
   </div>


</body>
</html>