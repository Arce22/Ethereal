<?php
session_start();
require 'database.php';
if( isset($_SESSION['admin_id'])) {
  header("Location: ");
}
//including the database connection file

 
//getting id of the data from url
$player_id = $_GET['player_id'];
 
//deleting the row from table4
  $records = $conn->prepare('insert into warned values (:player_id,:admin_id)'); // = ' .$_SESSION['company_id'].);
            $records->bindParam(':player_id', $player_id);
          	 $records->bindParam(':admin_id',$_SESSION['admin_id']);
            $records->execute();


//redirecting to the display page (index.php in our case)
header("Location:admin_manage_players.php");

?>