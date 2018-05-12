<?php
session_start();
require 'database.php';
if( isset($_SESSION['admin_id'])) {
  header("Location: ");
}
//including the database connection file

 
//getting id of the data from url
$company_id = $_GET['company_id'];
 
//deleting the row from table4
  $records = $conn->prepare('update company set approval_status= 0 WHERE company_id=:company_id'); // = ' .$_SESSION['company_id'].);
            $records->bindParam(':company_id', $company_id);
           // $records->bindParam(':event_id',$event_id );
            $records->execute();


  $record = $conn->prepare('update approves set status= 0 WHERE company_id=:company_id and admin_id=:admin_id'); // = ' .$_SESSION['company_id'].);
            $record->bindParam(':company_id', $company_id);
            $record->bindParam(':admin_id',$_SESSION['admin_id']);
            $record->execute();

//redirecting to the display page (index.php in our case)
header("Location:admin_manage_companies.php");

?>