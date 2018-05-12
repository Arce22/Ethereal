
<?php
session_start();
require 'database.php';
if( isset($_SESSION['company_id'])) {
	header("Location: ");
}
//including the database connection file

if(isset($_GET['event_id'])){
    $event_id = $_GET['event_id'];
    echo $event_id;
  } else {
    $event_id = $_GET['event_id'];
    echo $event_id;
  }
//getting id of the data from url
//$event_id = $_COOKIE['event_id'];
//$event_id =  $_GET['event_id'];
$company_id = $_SESSION['company_id'];

echo $event_id;
echo $company_id;
/*
if( !empty($_POST['event_name_change'])):
echo "event :".$event_id. "";
 	$records1 = $conn->prepare('UPDATE event SET event_name = :new_event_name WHERE event_id = :event_id');
    $records1->bindParam(':new_event_name',  $_POST['event_name_change']);
    $records1->bindParam(':event_id',$event_id);
    $records1->execute();

endif;
if( !empty($_POST['end_date_change'])):
 	 $records1 = $conn->prepare('UPDATE event SET end_date = :new_end_date WHERE event_id = :event_id');
     $records1->bindParam(':event_id',$event_id);
     $records1->bindParam(':new_end_date',  $_POST['end_date_change']);
     $records1->execute();

endif;
if( !empty($_POST['description_change'])):
 	$records1 = $conn->prepare('UPDATE event SET description = :new_description WHERE event_id = :event_id');
      $records1->bindParam(':event_id',$event_id );
     $records1->bindParam(':new_description',  $_POST['description_change']);
     $records1->execute();
endif;*/

if( !empty($_POST['discount_change'])):
 	$records1 = $conn->prepare('UPDATE discount SET percent = :new_percent WHERE event_id = :event_id');
     $records1->bindParam(':event_id', $event_id);
     $records1->bindParam(':new_percent',  $_POST['discount_change']);
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
	<h1>Welcome to Market</h1>
    <table align = "center">
            <thead>
				<tr>
                    <td><a href="company_market.php"><button type="button" style="float: right;" class="btn_name">Market Place</button></td>
	                <td><a href="company_games.php"><button type="button" style="float: right;" class="btn_name">Games</button></td>
	                <td><a href="company_profile.php"><button type="button" style="float: right;" class="btn_name">Profile</button></td>
				</tr>
			</thead>
	</table>


<div class="vertical-menu">
    <a href="company_market_addEvent.php">Add Event</a>
    <a href="company_market_manageEvent.php">Manage Events</a>
</div>



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



   <div>
     <form action="company_market_manageEvent_edit.php" method="GET" align = "center">

        <?php $event_id = $_GET['event_id'];?>
                    
                   <label for="event_name_change"><b>Change Event name</b></label>
                  <input type="text" placeholder="Enter event name" name="event_name_change"  class = "box1"><br /><br />

                   <label for="description_change"><b>Change Description</b></label>
                  <input type="text" placeholder="Enter description" name="description_change"  class = "box1"><br /><br />

                  <label for="password_signup"><b>Change End Date</b></label>
                  <input type="text" placeholder="Enter new end date" name="end_date_change"  class = "box1"><br /><br />

                  <label for="discount_percent"><b>Change Discount percent</b></label>
                  <input type="text" placeholder="Enter new discount" name="discount_change" class = "box1"><br /><br />
                  
                 <input type = "submit" value = "Save Changes"/><br />
         
        </form>
  
 
   </div>


</body>
</html>