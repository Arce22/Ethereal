<?php
session_start();
require 'database.php';
if( isset($_SESSION['company_id'])) {
	header("Location: ");
}


if(  !empty($_POST['e_mail_change'])):
   
       

    // adding to player table
     $records1 = $conn->prepare('UPDATE company_info SET company_email = :new_company_email WHERE company_id = :company_id');
     $records1->bindParam(':company_id', $_SESSION['company_id']); 
     $records1->bindParam(':new_company_email',  $_POST['e_mail_change']);
   //  $records1->bindParam(':new_company_name',  $_POST['company_name_change']);
     $records1->execute();

endif;

if(  !empty($_POST['company_name_change'])):
   
       

    // adding to player table
     $records1 = $conn->prepare('UPDATE company SET company_name = :new_company_name WHERE company_id = :company_id');
     $records1->bindParam(':company_id', $_SESSION['company_id']); 
     $records1->bindParam(':new_company_name',  $_POST['company_name_change']);
   //  $records1->bindParam(':new_company_name',  $_POST['company_name_change']);
     $records1->execute();  

endif;


if(  !empty($_POST['webpage_change'])):
   
       

    // adding to player table
     $records1 = $conn->prepare('UPDATE company_info SET webpage = :new_company_webpage WHERE company_id = :company_id');
     $records1->bindParam(':company_id', $_SESSION['company_id']); 
     $records1->bindParam(':new_company_webpage',  $_POST['webpage_change']);
   //  $records1->bindParam(':new_company_name',  $_POST['company_name_change']);
     $records1->execute();  

endif;

if(  !empty($_POST['zipcode_change'])):
     $records1 = $conn->prepare('UPDATE company_info SET zip= :new_zip WHERE company_id = :company_id');
     $records1->bindParam(':company_id', $_SESSION['company_id']); 
     $records1->bindParam(':new_zip',  $_POST['zipcode_change']);   
     $records1->execute();  
endif;


if(  !empty($_POST['district_change'])):
     $records1 = $conn->prepare('UPDATE company_info SET district= :new_district WHERE company_id = :company_id');
     $records1->bindParam(':company_id', $_SESSION['company_id']); 
     $records1->bindParam(':new_district',  $_POST['district_change']);   
     $records1->execute();  
endif;


if(  !empty($_POST['description_change'])):
     $records1 = $conn->prepare('UPDATE company_info SET description = :new_description WHERE company_id = :company_id');
     $records1->bindParam(':company_id', $_SESSION['company_id']); 
     $records1->bindParam(':new_description',  $_POST['description_change']);   
     $records1->execute();  
endif;

if(  !empty($_POST['state_change'])):
     $records1 = $conn->prepare('UPDATE company_info SET state = :new_state WHERE company_id = :company_id');
     $records1->bindParam(':company_id', $_SESSION['company_id']); 
     $records1->bindParam(':new_state',  $_POST['state_change']);   
     $records1->execute();  
endif;


if(  !empty($_POST['country_change'])):
     $records1 = $conn->prepare('UPDATE company_info SET city= :new_country  WHERE company_id = :company_id');
     $records1->bindParam(':company_id', $_SESSION['company_id']); 
     $records1->bindParam(':new_country',  $_POST['country_change']);   
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
    <a href="company_profile_information.php">Information</a>
  <a href="company_profile_eventHistory.php">Event History</a>
  <a href="company_profile_accountSettings.php">Acount Settings</a>
</div>

 <div>   
   <table align = "right">
   <thead>
        <th>Event</th><br />
        <th>Start Date</th><br />
        <th>End Date</th><br />
    </thead>
    <tbody>
        <?php

        $records1 = $conn->prepare('SELECT distinct event_id, start_date, end_date from discount natural join event where company_id = :company_id');
        $records1->bindParam(':company_id', $_SESSION['company_id']);
        $records1->execute();
        $results1 = $records1->fetchAll();

        foreach($results1 as $result)
        {
            echo "<tr>";
            echo "<td>" . $result['event_id'] . "</td>" . "<br>";
            echo "<td>" . $result['start_date'] . "</td>" . "<br>";
            echo "<td>" . $result['end_date'] . "</td>" . "<br>";
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