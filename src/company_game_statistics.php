<?php
session_start();
require 'database.php';
if( isset($_SESSION['company_id'])) {
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
	<h1>Company Profile</h1>
    <table align = "center">
            <thead>
				<tr>
                    <td><a href="company_market.php"><button type="button" style="float: right;" class="btn_name">Market Place</button></td>
	                <td><a href="company_games.php"><button type="button" style="float: right;" class="btn_name">Games</button></td>
	                <td><a href="company_profile.php"><button type="button" style="float: right;" class="btn_name">Profile</button></td>
				</tr>
			 <thead>
	</table>



<div class="vertical-menu">
    <a href="company_games_addGame.php">Add Game</a>
    <a href="company_games_manageGame.php">Manage Game</a>
    <a href="company_games_updateGame.php">Update Game</a>
    <a href="company_game_statistics.php">Game Statistics</a>
    
</div>


<div>

<span allign= "center" class = "center"

<?php
      
      $records = $conn->prepare('select count(distinct player_id) as number from played natural join game where company_id = :company_id'); 
      $records->bindParam(':company_id', $_SESSION['company_id']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);
?>
<label>Number of Players Playing Your Games: </label> 
<label><?php echo $results['number'];?></label><br />

 <?php
      
      $records = $conn->prepare('select count(distinct player_id) as number from bought where game_name in (select game_name from game where company_id =:company_id)'); 
      $records->bindParam(':company_id', $_SESSION['company_id']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);
?>
<label>Number of Players Bought Your Games: </label>
<label><?php echo $results['number'];?></label><br />


   <?php
      
      $records = $conn->prepare('select count(distinct player_id) as females from information natural join played where gender = \'female\' and game_name in (select game_name from game where company_id =:company_id)'); 
      $records->bindParam(':company_id', $_SESSION['company_id']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);
?>
<label>Female Players: </label>
<label><?php echo $results['females'];?></label><br />


 <?php
      
      $records = $conn->prepare('select count(distinct player_id) as males from information natural join played where gender = \'male\' and game_name in (select game_name from game where company_id =:company_id)'); 
      $records->bindParam(':company_id', $_SESSION['company_id']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);
?>
<label>Male Players: </label>
<label><?php echo $results['males'];?></label><br />


<table align = "center">

   <thead>
        <th>Countries</th><br />
    </thead>
    <tbody>
        <?php

        $records = $conn->prepare('SELECT distinct country from information natural join played WHERE game_name in (select game_name from game where company_id =:company_id)');
        $records->bindParam(':company_id', $_SESSION['company_id']);
        $records->execute();
        $results = $records->fetchAll();

        foreach($results as $result)
        {
            echo "<tr>";
            echo "<td>" . $result['country'] . "</td>" . "<br>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

</span>
</div>




<div>
<table align = "right">

   <thead>
        <th>Games</th><br />
        <th>See More!</th><br />
    </thead>
    <tbody>
        <?php

        $records = $conn->prepare('SELECT game_name, developer, description, published_date, category_name, price FROM game WHERE company_id = :company_id');
        $records->bindParam(':company_id', $_SESSION['company_id']);
        $records->execute();
        $results = $records->fetchAll();

        foreach($results as $result)
        {
            echo "<tr>";
            echo "<td>" . $result['game_name'] . "</td>" . "<br>";
            echo "<td><a href =\"./game_market_extraInfo.php?game_name="  . $result['game_name']. "\"><input type=\"submit\"  value=\"Information\" /></form></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <table align = "right">

<thead>
    <th>Game Name</th><br />
    <th>Age</th><br />
    <th>Count of Players</th><br />
</thead>
<tbody>
    <?php
  

    $records = $conn->prepare('SELECT game_name, age, number from (SELECT game_name, (played_date - birth_date) as age, count(player_id) as number from Player natural join Information natural join Played group by game_name) as T where game_name = :game_name');
    $records->bindParam(':game_name', $game_name);
    $records->execute();
    $results = $records->fetchAll();

    foreach($results as $result)
    {
        echo "<tr>";
        echo "<td>" . $result['game_name'] . "</td>" . "<br>";
        echo "<td>" . $result['age'] . "</td>" . "<br>";
        echo "<td>" . $result['number'] . "</td>" . "<br>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

   </div>




 
 

<div>
     <span style="float:top" class = "topright"

      <label>Company ID: </label>
      <label><?php echo $_SESSION['company_id'];?></label> </span>

      <span style="float:right" class = "topright1"
      <?php
            
            $records = $conn->prepare('select company_name from company where company_id = :company_id'); // = ' .$_SESSION['company_id'].);
            $records->bindParam(':company_id', $_SESSION['company_id']);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Company Name: </label>
      <label><?php echo $results['company_name'];?></label>
      </span>
   </div>


</body>
</html>