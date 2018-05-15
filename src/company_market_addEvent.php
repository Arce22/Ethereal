<?php
/**
 * Created by PhpStorm.
 * User: Nursonto
 * Date: 13.05.2018
 * Time: 04:19
 */
session_start();
require 'database.php';
if( isset($_SESSION['company_id'])) {
    header("Location: ");
}

if(!empty($_POST['game_name']) && !empty($_POST['event_id']) && !empty($_POST['percent']) && !empty($_POST['description']) && !empty($_POST['end_date'])):
echo $_POST['start_date'] ;

    $game_name =  $_POST['game_name'];
    $company_id =   $_SESSION['company_id'] ;
    $event_id =  $_POST['event_id'];
    $percent =  $_POST['percent'];
//:event_id, :event_name, :start_date, :end_date, :description
//':event_id ' => $_POST['event_id'], ':event_name' => $_POST['event_name'], ':start_date' => $_POST['start_date'], ':end_date' => $_POST['end_date'], ':description' => $_POST['description'])
    $records = $conn->prepare('insert into event (event_id, event_name, start_date, end_date, description) values (?,?,?,?,?)');
    $records->execute(array($_POST['event_id'],  $_POST['event_name'], $_POST['start_date'],  $_POST['end_date'],  $_POST['description']));


    $records1 = $conn->prepare('insert into discount (company_id, game_name, event_id, percent )values (?,?,?,?)');
  
   // $records1->bindParam('company_id',$_SESSION['company_id']);
   // $records1->bindParam('game_name' , $_POST['game_name']);
    //$records1->bindParam('event_id' , $_POST['event_id']);
    //$records1->bindParam('percent' , $_POST['percent']); $_SESSION['company_id']
    $records1->execute(array( $_SESSION['company_id'] ,  $game_name, $event_id,  $percent));
   echo  $_POST['game_name'];
        
     $records4 = $conn->prepare('select * from game where game_name= :game_name');   
            $records4->bindParam(':game_name', $_POST['game_name']);
             $records4->execute();
                $results4 = $records4->fetch(PDO::FETCH_ASSOC);

              $price= $results4['price'];
              echo   "price".$price;
              $price=  $price-(($price* $percent)/100);
                echo   "percent".$percent;

        $records3 = $conn->prepare('update game set price=:new_price where game_name= :game_name');
                echo  $_POST['game_name'];
               
                $records3->bindParam(':game_name',$game_name);
                $records3->bindParam(':new_price' ,  $price);
                 $records3->execute();
                    $results3 = $records3->fetch(PDO::FETCH_ASSOC);
                      



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
        <td><a href="company_market.php"><button type="button" style="float: right;" class="btn_name">Market Place</button></td>
        <td><a href="company_games.php"><button type="button" style="float: right;" class="btn_name">Games</button></td>
        <td><a href="company_profile.php"><button type="button" style="float: right;" class="btn_name">Profile</button></td>
    </tr>
    <thead>
</table>


<div class="vertical-menu">
    <a href="company_market_addEvent.php">Add Event</a>
    <a href="company_market_manageEvent.php">Manage Events</a>

</div>

<form action = "company_market_addEvent.php" method = "post" align = "center">
    <p>Add Event</p>

    <label for="event_id"><b>Event ID : </b></label>
    <input type="text" placeholder="Event ID" name="event_id"  class = "box1"><br /><br />

    <label for="event_name"><b>Event Name : </b></label>
    <input type="text" placeholder="Event Name" name="event_name"  class = "box1"><br /><br />

    <label for="description"><b>Description : </b></label>
    <input type="text" placeholder="Description" name="description"  class = "box1"><br /><br />

    <label for="start_date"><b>Start Date : </b></label>
    <input type="date" placeholder="Start Date" name="start_date"  class = "box1"><br /><br />

    <label for="end_date"><b>End Date : </b></label>
    <input type="date" placeholder="End Date" name="end_date"  class = "box1"><br /><br />

    <label for="discount_percent"><b>Discount Percent : </b></label>
    <input type="number" placeholder="Discount Percent" name="percent" class = "box1"><br /><br />


    <p id="game_name" method="post">
        <p>Select Game</p>
        <select name="game_name" multiple>

            <?php

            $records = $conn->prepare('select game_name from game where company_id = :company_id'); // = ' .$_SESSION['company_id'].);
            //
            $company =  $_SESSION['company_id'];
            $records->bindParam(':company_id',$company );
            $records->execute();
            $results = $records->fetchAll();
            foreach($results as $result){
                echo "<option value =\"" . $result['game_name'] . "\">" . $result['game_name'] . "</option>";
            }
            ?>

        </select>
    </p>

    <input type = "submit" value = "Add Event"/><br />

</form>

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