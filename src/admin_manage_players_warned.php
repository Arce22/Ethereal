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

 $records2 = $conn->prepare('select * from warned where player_id = :player_id'); // = ' .$_SESSION['company_id'].);
             $records2->bindParam(':player_id',   $player_id);
            $records2->execute();
            $results2 = $records2->fetchAll(); //(PDO::FETCH_ASSOC)

        if(count( $results2)==3){
        	$records3 = $conn->prepare('insert into banned values (:player_id,:admin_id)'); // = ' .$_SESSION['company_id'].);
            $records3->bindParam(':player_id', $player_id);
          	 $records3->bindParam(':admin_id',$_SESSION['admin_id']);
            $records3->execute();


            	$records5 = $conn->prepare('delete from warned where player_id=:player_id');
            	 $records5->bindParam(':player_id', $player_id);
          	 	
           		 $records5->execute();

        }
//redirecting to the display page (index.php in our case)
header("Location:admin_manage_players.php");

?>