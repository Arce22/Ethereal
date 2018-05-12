<?php
/**
 * Created by PhpStorm.
 * User: Nursonto
 * Date: 10.05.2018
 * Time: 05:01
 */

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
    <a href="company_add_event.php">Add Event</a>
    <a href="company_manage_event.php">Manage Events</a>

</div>

<form action = "company_profile_accountSettings.php" method = "post" align = "center">
    <p>Account Settings</p>

    <label for="event_name"><b>Event Name : </b></label>
    <input type="text" placeholder="Event Name" name="event_name"  class = "box1"><br /><br />

    <label for="description"><b>Description</b></label>
    <input type="text" placeholder="Description" name="description"  class = "box1"><br /><br />

    <label for="end_date"><b>End Date</b></label>
    <input type="date" placeholder="End Date" name="end_date"  class = "box1"><br /><br />

    <label for="discount_percent"><b>Discount Percent</b></label>
    <input type="number" placeholder="Discount Percent" name="discount_percent" class = "box1"><br /><br />
    <input type = "submit" value = "Add Event"/><br />

    <form id="games" action="company_add_event.php" target="added_games" method="get">
        <p>Select Game</p>
        <select name="gameList" multiple>

            <option value ="Game Name">Nothing</option>
            <option value ="Game Name 2">Guava</option>
            <option value ="Game Name 3">Lychee</option>
            <option value ="Game Name 4">Papaya</option>
            <option value ="Game Name 5">Watermelon</option>
            <?php

            $records = $conn->prepare('select game_name from owns where company_id = :company_id'); // = ' .$_SESSION['company_id'].);
            $records->bindParam(':company_id', $_SESSION['company_id']);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            echo "<option value =\" " . $results['game_name'] . " \"> " . $results['game_name'] . "</option> ";
            ?>

        </select>

        <p><input type="submit" value="Add"></p>

    </form>

    <form id="added_games" action="company_add_event.php" target="games" method="get">
        <p>Select Game</p>
        <select name="gameList" multiple>

            <?php

            $records = $conn->prepare('select game_name from owns where company_id = :company_id'); // = ' .$_SESSION['company_id'].);
            $records->bindParam(':company_id', $_SESSION['company_id']);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            echo "<option value =\" " . $results['game_name'] . " \"> " . $results['game_name'] . "</option> ";
            ?>

        </select>

        <p><input type="submit" value="Add"></p>

    </form>
    <h3>Result:</h3>
    <iframe name="result2" style="height:100px;width:200px;"></iframe>

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