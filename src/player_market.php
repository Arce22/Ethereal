<?php
/**
 * Created by PhpStorm.
 * User: Nursonto
 * Date: 8.05.2018
 * Time: 04:32
 */
session_start();
require 'database.php';
/*
if( isset($_SESSION['user_id']) ){
header("Location: ");} */

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
    .PlayerInfo{
        float: top;
        position: relative;
        margin-right: 20px;
        color: deeppink;
    }

    .EventDisplaying{
        text_align : center;
        color : azure;
    }


</style>
<head>
    <title>Ethereal</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>
<h1>Market Page</h1>
<h1>CS 353 Project</h1>

<h2>These are categories </h2>
<div>
    <ul class="Categories" >
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
    </ul>
</div>

<div class="main">

    <h2>This is user information from sql</h2>
    <div>
        <ul class="PlayerInfo" >
            <?php

            $records = $conn->prepare('select balance from player where player_id = :player_id'); // = ' .$_SESSION['company_id'].);
            $records->bindParam(':player_id', $_SESSION['user_id']);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            echo $results['balance'];
            ?>
        </ul>
    </div>

    <h2>These are buttons </h2>

    <a href="./player_profile.php"><button id = "profile" type="button">Player Profile </button></a>
    <a href="./player_games.php"><button id="player_games" type="button">Player Games </button></a>
    <a href="./player_market.php"><button id="market_place" type="button">Market Place </button></a>


    <h2>These are events </h2>

    <div>
        <ul class=" EventDisplaying" >
            <?php
            //WHERE username = :player_id
            $records = $conn->prepare('SELECT event_name, description, event_id FROM event ');
            $records->execute();
            $results = $records->fetchAll();
           /* $newRecords = $conn->prepare('SELECT game_name(*) FROM event NATURAL JOIN discount GROUP BY event_id ');
            $newRecords->bindParam(':event_id', $result['event_id']);
            $newRecords->execute();
            $newRecords = $newRecords->fetchAll();
           " . $newRecords[' game_name '] .
*/
            foreach($results as $result)
            {

                echo "<li>". $result['event_name']. " : This is event name and : ". $result['description']. " : This is description and this is game name : </li> <br> ";
            }

            ?>
        </ul>
    </div>
    </div>
</body>
</html>