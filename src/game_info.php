<?php
session_start();
require 'database.php';
 $company_id = $_GET['company_id'];
 $game_name = $_GET['game_name'];
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
  <button onclick="history.go(-1);">Back </button>
	<h1>Game Profile</h1>



<div>

      

 <table align = "center">
   <thead>
        <th>Games</th><br />
        <th>Developer</th><br />
        <th>Description</th><br />
        <th>Release Date</th><br />
        <th>Category</th><br />
        <th>Company</th><br />
        <th>Price</th><br />
    </thead>
    <tbody>
        <?php
        $records = $conn->prepare('SELECT game_name, developer, description, published_date, category_name, company_id, price FROM game where company_id=:company_id and game_name=:game_name');
        $records->bindParam(':company_id', $company_id);
         $records->bindParam(':game_name', $game_name);
        $records->execute();
        $results = $records->fetchAll();

        foreach($results as $result)
        {
            echo "<tr>";
            echo "<td>" . $result['game_name'] . "</td>" . "<br>";
            echo "<td>" . $result['developer'] . "</td>" . "<br>";
            echo "<td>" . $result['description'] . "</td>" . "<br>";
            echo "<td>" . $result['published_date'] . "</td>" . "<br>";
            echo "<td>" . $result['category_name'] . "</td>" . "<br>";
            echo "<td>" . $result['company_id'] . "</td>" . "<br>";
            echo "<td>" . $result['price'] . "</td>" . "<br>";
            echo "</tr>";
        }
  ?>
 </tbody>
  </table>

 </div>




</body>
</html>