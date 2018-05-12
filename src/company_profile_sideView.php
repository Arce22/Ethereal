<?php
session_start();
require 'database.php';
 $company_id = $_GET['company_id'];
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
table, th, td {
   border: 1px solid black;
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
.right {
    position: absolute;
    right: 0px;
    width: 300px;
    padding: 10px;
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
	<h1>Company Profile</h1>



<div>

      <span style="float:center" allign= "center" class = "center"


      <label>Company ID: </label>
      <label><?php echo $_GET['company_id'];?></label> <br />
    
      <?php
       
        $records = $conn->prepare('select company_name from company where company_id = :company_id'); 
            $records->bindParam(':company_id', $company_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Company Name: </label> 
      <label><?php echo $results['company_name'];?></label><br />

       <?php
            
            $records = $conn->prepare('select webpage from company_info where company_id = :company_id'); 
            $records->bindParam(':company_id', $company_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Company Webpage: </label>
      <label><?php echo $results['webpage'];?></label><br />

         <?php
            
            $records = $conn->prepare('select company_email from company_info where company_id = :company_id'); 
             
            $records->bindParam(':company_id', $company_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Company E-Mail: </label>
      <label><?php echo $results['company_email'];?></label><br />
 
       <?php
            
            $records = $conn->prepare('select zip from company_info where company_id = :company_id'); 
              $records->bindParam(':company_id', $company_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Zipcode: </label>
      <label><?php echo $results['zip'];?></label><br />

        <?php
            
            $records = $conn->prepare('select state from company_info where company_id = :company_id'); 
            $records->bindParam(':company_id', $company_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>State: </label>
      <label><?php echo $results['state'];?></label><br />
        <?php
            
            $records = $conn->prepare('select city from company_info where company_id = :company_id'); 
            $records->bindParam(':company_id', $company_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>City: </label>
      <label><?php echo $results['city'];?></label><br />

        <?php
            
            $records = $conn->prepare('select district from company_info where company_id = :company_id'); 
            $records->bindParam(':company_id', $company_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>District: </label>
      <label><?php echo $results['district'];?></label><br />


        <?php
            
            $records = $conn->prepare('select description from company_info where company_id = :company_id'); 
            $records->bindParam(':company_id', $company_id);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
      ?>
      <label>Description: </label>
      <label><?php echo $results['description'];?></label><br />


      </span>
   </div>


<table align = "right" class="right">
   <thead>
     
        <th>Game name</th><br />
        <th>Information </th><br />
        
       
    </thead>
    <tbody>
        <?php
       $records = $conn->prepare('SELECT game_name FROM game where company_id=:company_id');
        $records->bindParam(':company_id', $company_id);
        $records->execute();
        $results = $records->fetchAll();

        foreach($results as $result)
        {
           
            echo "<td>" . $result['game_name']. "</td>" . "<br>";
            echo "<td>" ."&nbsp&nbsp<a href =\"./game_info.php?company_id="  . $company_id."&game_name=". $result['game_name']. "\"><input type=\"submit\"  value=\"Information\" /></a></form></td>"."<br>";
              echo "</tr>";
             
        }
  ?>

 </tbody>
  </table>
 

 <table align = "left">
   <thead>
     
        
        <th>Event id</th><br />
        <th>Game name</th><br />
        <th>Percent</th><br />
         <th>Information </th><br />
       
    </thead>
    <tbody>
        <?php
        $records = $conn->prepare('SELECT game_name, event_id ,percent FROM discount where company_id=:company_id');
        $records->bindParam(':company_id', $company_id);
        $records->execute();
        $results = $records->fetchAll();

        foreach($results as $result)
        {
            echo "<tr>";
           
            
            echo "<td>" . $result['event_id'] . "</td>" . "<br>";
            echo "<td>" . $result['game_name'] . "</td>" . "<br>";
            echo "<td>" . $result['percent'] . "</td>" . "<br>";
             echo "<td>" ."&nbsp&nbsp<a href =\"./event_info.php?company_id="  . $company_id."&event_id=". $result['event_id']. "\"><input type=\"submit\"  value=\"Information\" /></a></form></td>"."<br>";
          
            echo "</tr>";
        }
  ?>
 </tbody>
  </table>
</body>
</html>