<?php


// if a player is unfriended then you don't see it's profile in olayer_profile
session_start();
require 'database.php';
if( isset($_SESSION['user_id'])) {
	header("Location: ");
}

if(isset($_GET['added_id'])){
    $added_id = $_GET['added_id'];
    echo $added_id;
  } else {
    $added_id = $_GET['added_id'];
    echo $added_id;
  }

$player_id = $_SESSION['user_id'];

//SELECT added_id from friended where adder_id = :player_id union select adder_id from friended where added_id = :player_id
$records1 = $conn->prepare('insert into blocked values(:blocker_id, :blocked_id)'); // = ' .$_SESSION['company_id'].);
$records1->bindParam(':blocked_id', $added_id);
$records1->bindParam(':blocker_id', $player_id);
$records1->execute();
$results1 = $records1->fetch(PDO::FETCH_ASSOC);

header("Location: ./player_profile.php");

?>