<?php
session_start();
require 'database.php';
if( isset($_SESSION['user_id'])) {
	header("Location: ");
}

$added_id = $_GET['added_id'];
$player_id = $_SESSION['user_id'];


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
	<h1>Player Profile</h1>
    <table align = "center">
            <thead>
				<tr>
                    <td><a href="player_market.php"><button type="button" style="float: right;" class="btn_name">Market Place</button></td>
	                <td><a href="player_games.php"><button type="button" style="float: right;" class="btn_name">Games</button></td>
	                <td><a href="player_profile.php"><button type="button" style="float: right;" class="btn_name">Profile</button></td>
				</tr>
			 <thead>
	</table>


<div>

      <span style="float:center" allign= "center" class = "center"
    
      <?php
            
            $records = $conn->prepare('select full_name from information where player_id = :player_id'); 
            $records->bindParam(':player_id', $added_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Full Name: </label> 
      <label><?php echo $results['full_name'];?></label><br />

       <?php
            
            $records = $conn->prepare('select player_id from information where player_id = :player_id'); 
            $records->bindParam(':player_id', $added_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Player ID: </label>
      <label><?php echo $results['player_id'];?></label><br />

         <?php
            
            $records = $conn->prepare('select player_email from information where player_id = :player_id'); 
            $records->bindParam(':player_id', $added_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Player E-Mail: </label>
      <label><?php echo $results['player_email'];?></label><br />
 
       <?php
            
            $records = $conn->prepare('select country from information where player_id = :player_id'); 
            $records->bindParam(':player_id', $added_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Country: </label>
      <label><?php echo $results['country'];?></label><br />

        <?php
            
            $records = $conn->prepare('select gender from information where player_id = :player_id'); 
            $records->bindParam(':player_id', $added_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Gender: </label>
      <label><?php echo $results['gender'];?></label><br />
        <?php
            
            $records = $conn->prepare('select birth_date from information where player_id = :player_id'); 
            $records->bindParam(':player_id', $added_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Birth Date: </label>
      <label><?php echo $results['birth_date'];?></label><br />

        <?php
            
            $records = $conn->prepare('select biography from information where player_id = :player_id'); 
            $records->bindParam(':player_id', $added_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Biography: </label>
      <label><?php echo $results['biography'];?></label><br />

      </span>
   </div>

    <div>   
   <table align = "right">
   <thead>
        <th>Bought Games</th><br />
    </thead>
    <tbody>
        <?php

        $records1 = $conn->prepare('SELECT game_name from bought where player_id = :player_id');
        $records1->bindParam(':player_id', $added_id);
        $records1->execute();
        $results1 = $records1->fetchAll();

        foreach($results1 as $result)
        {
            echo "<tr>";
            echo "<td>" . $result['game_name'] . "</td>" . "<br>";
            echo "</tr>";
        }
        ?>
        </tbody>
  </table>

 </div>

  <div>   
   <table align = "right">
   <thead>
        <th>Lastly Played Games</th><br />
        <th>Date</th><br />
    </thead>
    <tbody>
        <?php

        $records1 = $conn->prepare('SELECT game_name, played_date from played where player_id = :player_id');
        $records1->bindParam(':player_id', $added_id);
        $records1->execute();
        $results1 = $records1->fetchAll();

        foreach($results1 as $result)
        {
            echo "<tr>";
            echo "<td>" . $result['game_name'] . "</td>" . "<br>";
            echo "<td>" . $result['played_date'] . "</td>" . "<br>";
            echo "</tr>";
        }
        ?>
        </tbody>
  </table>

 </div>




<div class="vertical-menu">
        <a href="player_profile_information.php">Information</a>
        <a href="player_profile_gameHistory.php">Game History</a>
        <a href="player_profile_addFund.php">Add Funds to Wallet</a>
        <a href="player_profile_accountSettings.php">Account Settings</a>
 
</div>
 
 

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