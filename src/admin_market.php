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
h2 {
    color: white;
    text-align: center;
}
h3 {
    color: white;
    text-align: left;
}
p {
    font-family: verdana;
    font-size: 20px;
}
th,td {
    border: 1px solid black;
	   padding: 15px;
}
.btn_name{
    margin-right:10px;
	margin-left:10px;
}
.topright {
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 18px;
}
.topright1 {
    position: absolute;
    top: 30px;
    right: 16px;
    font-size: 18px;
}
.Events{
    height: 100px;
    width: 400px;

    position: fixed;
    top: 50%;
    left: 50%;
    margin-top: -50px;
    margin-left: -200px;
}
.btn-group button {
    background-color: #4CAF50; /* Green background */
    border: 1px solid green; /* Green border */
    margin-top:10px;
	margin-bottom:10px;
    color: white; /* White text */
    padding: 5px 12px; /* Some padding */
    cursor: pointer; /* Pointer/hand icon */
    width:10%; /* Set a width if needed */
    display: block; /* Make the buttons appear below each other */
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
	<h1>Welcome to Admin Market</h1>
    <table align = "center">
            <thead>
				<tr>
                    <td><a href="admin_market.php"><button type="button" style="float: right;" class="btn_name">Market Place</button></td>
	                <td><a href="admin_games.php"><button type="button" style="float: right;" class="btn_name">Games</button></td>
	                <td><a href="admin_profile.php"><button type="button" style="float: right;" class="btn_name">Profile</button></td>
				</tr>
			</thead>
	</table>

  <h2>Events of the week:</h2><br />
  
      <ul class="Events" align = "center">
        <?php

        $records1 = $conn->prepare('SELECT event_name FROM Event');
        $records1->execute();
        $results = $records1->fetchAll();

        foreach($results as $result)
        {
            echo "<tr>";
            echo $result['event_name'] . "<br>" ;
            echo "</tr>";
        }
        ?>
       <table align = "center">
            <tr>
             <td><a href="admin_market_manageEvent.php"><button type="button">Manage Events</button></td>
             
            </tr>
       </table>
    </ul>
         
       
    
   
 <div>   
   <table align = "left">
      <ul class="Categories" >
        <h3>Categories:</h3><br />
        <?php

        $records = $conn->prepare('SELECT category_name FROM Game_Category');
        $records->execute();
        $results = $records->fetchAll();

        foreach($results as $result)
        {
            echo "<tr>";
            echo $result['category_name'] . "<br>" ;
            echo "</tr>";
        }
        ?>
         <thead>
         <tr>
        <td><a href="admin_manage_category.php"><button type="button">Manage Categories</button></td>
      
       </tr>
        </thead>
     </ul>
  </table>

 </div>



 <div>  
    <span style="float:top" class = "topright"

      <label>Admin ID: </label>
      <label><?php echo $_SESSION['admin_id'];?></label> </span>

  </div>
 
</body>
</html>