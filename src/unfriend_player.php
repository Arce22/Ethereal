<?php


// if a player is unfriended then you don't see it's profile in olayer_profile
session_start();
require 'database.php';
if( isset($_SESSION['user_id'])) {
	header("Location: ");
}

$added_id = $_GET['added_id'];
$player_id = $_SESSION['user_id'];

//SELECT added_id from friended where adder_id = :player_id union select adder_id from friended where added_id = :player_id
$records1 = $conn->prepare('delete from friended where (added_id = :id and adder_id = :player_id) or (adder_id = :id and added_id = :player_id)'); // = ' .$_SESSION['company_id'].);
$records1->bindParam(':id', $added_id);
$records1->bindParam(':player_id', $player_id);
$records1->execute();
$results1 = $records1->fetch(PDO::FETCH_ASSOC);

header("Location: ./player_profile.php");

?>