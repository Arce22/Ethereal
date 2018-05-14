<?php
/**
 * Created by PhpStorm.
 * User: Nursonto
 * Date: 11.05.2018
 * Time: 23:17
 */
session_start();
require 'database.php';
if( isset($_SESSION['company_id'])) {
    header("Location: ");
}


if(!empty($_POST['game_name']) && !empty($_POST['change_log']) && !empty($_POST['update_date'])) {

    $records = $conn->prepare('insert into updates(company_id, game_name, update_date, change_log) values (?,?,?,?)');
    //$company =  $_SESSION['company_id'] ;
    $company = "a" ;
    $records->execute( array($company, $_POST['game_name'], $_POST['published_date'] , $_POST['change_log'] ));
    $sonuc = $records->errorInfo();
    print_r($sonuc);

    if($records)
    {
        echo '<script language="javascript">';
        echo 'alert("Successfully Game Updated ")';
        echo '</script>';
    }
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
    <a href="company_games_manageGame.php">Manage Games</a>
    <a href="company_games_updateGame.php">Update Games</a>

</div>

<form method = "post" align = "center">
    <p>Update Game </p>

     <p id="game_name" method="post">
        <p>Game Name :
        <select name="game_name">

            <?php

            $records = $conn->prepare('select game_name from game where company_id = :company_id'); // = ' .$_SESSION['company_id'].);
            //$company = $_SESSION['company_id'] ;
            $company = "a";
            $records->bindParam(':company_id',$company );
            $records->execute();
            $results = $records->fetchAll();
            foreach($results as $result){
                echo "<option value =\"" . $result['game_name'] . "\"> " . $result['game_name'] . "</option> ";
            }
            ?>

        </select>
    </p></p>

    <label for="published_date"><b>Update Date : </b></label>
    <input type="date" placeholder="Date" name="published_date"  class = "box1"><br /><br />

    <label for="change_log"><b>Change Log : </b></label>
    <textarea datatype="text" name ="change_log" placeholder="Change Log" cols = "40" rows="5"></textarea><br /><br />

    <label for="code"><b>Code : </b></label>
    <input type="file" placeholder="code" ><br /><br /><br />

    <input type = "submit" value = "Update Game" /><br />

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