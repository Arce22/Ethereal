<?php
session_start();
require 'database.php';
if( isset($_SESSION['user_id'])) {
	header("Location: ");
}
$game_name = $_POST['game_name'];



 $records2 = $conn->prepare('INSERT INTO written VALUES (:comment_id, :player_id, :game_name))');
 $records2->bindParam(':comment_id', $_POST['comment_id']);
   $records2->bindParam(':player_id', $_SESSION['user_id']);
   $records2->bindParam(':game_name', $game_name);
        $records2->execute();
        $results2 = $records2->fetchAll();




  $records = $conn->prepare('INSERT INTO comment VALUES (:comment_id, TRUE, :comment_text, :comment_date, FALSE, FALSE))');
  $records->bindParam(':comment_id', $_POST['comment_id']);
  $records->bindParam(':comment_text', $_POST['comment_text']);
  $records->bindParam(':comment_date', $_POST['comment_date']);
        $records->execute();
        $results = $records->fetchAll();


 
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
	<h1>Player Market</h1>
    <table align = "center">
            <thead>
				<tr>
                <td><a href="player_market.php"><button type="button" style="float: right;" class="btn_name">Market Place</button></td>
	                <td><a href="player_games.php"><button type="button" style="float: right;" class="btn_name">Games</button></td>
	                <td><a href="player_profile.php"><button type="button" style="float: right;" class="btn_name">Profile</button></td>
				</tr>
			 <thead>
	</table>



<div>   
   <table align = "left">
   <thead>
        <th>Categories:</th><br />
    </thead>
    <tbody>
        <?php

        $records = $conn->prepare('SELECT category_name FROM game_category');
        $records->execute();
        $results = $records->fetchAll();

        foreach($results as $result)
        {
            echo "<tr>";
            echo "<td>" . $result['category_name'] . "</td>" . "<br>";
            echo "</tr>";
        }
        ?>
        </tbody>
  </table>
 
  <form action = "player_makeComment.php" method = "post" align = "center">
                <p>Comment</p>
                 


           <p id="game_name" method="post">
        <p>Choose Game</p>
        <select name="game_name" multiple>

                  

                      <?php

                      $records = $conn->prepare('select distinct game_name from bought where player_id = :player_id'); // = ' .$_SESSION['company_id'].);

                      $records->bindParam(':player_id',$_SESSION['user_id'] );
                      $records->execute();
                      $results = $records->fetchAll();
                      foreach($results as $result){
                          echo "<option value =\"" . $result['game_name'] . "\">" . $result['game_name'] . "</option>";
                      }
                      ?>
                    
        </select>
    </p>

                   <label for="comment_id"><b>comment id</b></label>
                  <input type="text" placeholder="Enter Comment Name" name="comment_id"  class = "box1"><br /><br />
                  <label for="comment_text"><b>comment text</b></label>
                  <input type="text" placeholder="Enter your comment" name="comment_text"  class = "box1"><br /><br />
                 

                  <label for="comment_date"><b>Date</b></label>
                  <input id="date" type="date"  name="comment_date"><br /><br />

                 <input type = "submit" value = "Submit Comment"/><br />
         
               </form>


<div>
<span style="float:top" class = "topright"

<label>Player ID: </label>
<label><?php echo $_SESSION['user_id'];?></label> </span>

<span style="float:right" class = "topright1"
<?php
      
      $records = $conn->prepare('select balance from player where player_id = :player_id'); // = ' .$_SESSION['company_id'].);
      $records->bindParam(':player_id', $_SESSION['user_id']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);
?>
<label>Balance: $ </label>
<label><?php echo $results['balance'];?></label>
</span>
   </div>


</body>
</html>