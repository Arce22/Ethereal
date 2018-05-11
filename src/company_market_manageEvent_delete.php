
<?php
session_start();
require 'database.php';
if( isset($_SESSION['company_id'])) {
	header("Location: ");
}
//including the database connection file

 
//getting id of the data from url
$event_id = $_GET['event_id'];
 
//deleting the row from table4
  $records = $conn->prepare('DELETE FROM discount WHERE event_id=:event_id and company_id=:company_id'); // = ' .$_SESSION['company_id'].);
            $records->bindParam(':company_id', $_SESSION['company_id']);
            $records->bindParam(':event_id',$event_id );
            $records->execute();


  $record = $conn->prepare('DELETE FROM event WHERE event_id=:event_id and company_id=:company_id'); // = ' .$_SESSION['company_id'].);
            $record->bindParam(':company_id', $_SESSION['company_id']);
            $record->bindParam(':event_id',$event_id );
            $record->execute();

//redirecting to the display page (index.php in our case)
header("Location:company_market_manageEvent.php");


?>