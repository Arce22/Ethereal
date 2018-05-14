<?php
/**
 * Created by PhpStorm.
 * User: Nursonto
 * Date: 10.05.2018
 * Time: 04:33
 */
session_start();
require 'database.php';
if( isset($_SESSION['company_id'])) {
    header("Location: ");
}

if(!empty($_POST['game_name']) && !empty($_POST['price'])  ) {

    $records = $conn->prepare('UPDATE game SET  price = :price  WHERE game_name = :game_name');
    $records->bindParam(':game_name', $_POST['game_name']);
    $records->bindParam(':price', $_POST['price']);
    $records->execute();

    echo '<script language="javascript">';
    echo 'alert("Successfully Game Updated Price ")';
    echo '</script>';
}
if(!empty($_POST['game_name']) && !empty($_POST['description']) )
{
    $records = $conn->prepare('UPDATE game SET  description = :description WHERE game_name = :game_name');
    $records->bindParam(':description' , $_POST['description']);
    $records->bindParam(':game_name' , $_POST['game_name']);

    $records->execute();

    echo '<script language="javascript">';
    echo 'alert("Successfully Game Updated Description")';
    echo '</script>';

}

 if(!empty($_POST['game_name']) && !empty($_POST['developer']) )
{
    $records = $conn->prepare('UPDATE game SET developer = :developer WHERE game_name = :game_name');
    $records->bindParam(':developer' , $_POST['developer']);
    $records->bindParam(':game_name' , $_POST['game_name']);
    $records->execute();

    echo '<script language="javascript">';
    echo 'alert("Successfully Game Updated Developer")';
    echo '</script>';

}
if(!empty($_POST['game_name']) && !empty($_POST['category']) )
{
    $records = $conn->prepare('UPDATE game SET category = :category WHERE game_name = :game_name');
    $records->bindParam(':game_name' , $_POST['game_name']);
    $records->bindParam(':category' , $_POST['category']);
    $records->execute();

    echo '<script language="javascript">';
    echo 'alert("Successfully Game Updated Category ")';
    echo '</script>';

}

if(!empty($_POST['game_name']) && !empty($_POST['updated_date']) )
{
    $records = $conn->prepare('UPDATE game SET published_date = :published_date WHERE game_name = :game_name');
    $records->bindParam(':game_name' , $_POST['game_name']);
    $records->bindParam(':published_date' , $_POST['published_date']);
    $records->execute();


    echo '<script language="javascript">';
    echo 'alert("Successfully Game Updated Date ")';
    echo '</script>';

}
if(!empty($_POST['game_name']) && !empty($_POST['delete_game']) )
{
    $records = $conn->prepare('delete from game where company_id = :company_id and game_name = :game_name'); // = ' .$_SESSION['company_id'].);
    $company = $_SESSION['company_id'];
    //$company = "a" ;
    $records->bindParam(':company_id',$company );
    $records->bindParam(':game_name' ,$_POST['game_name']);
    $records->execute();


    echo '<script language="javascript">';
    echo 'alert("Successfully Game Deleted")';
    echo '</script>';
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

<form action = "company_games_manageGame.php" method = "POST" align = "center">
    <p>Manage Game </p>

    <label for="game_name"><b>Game Name Select: </b></label>
   <p id="game_name" method="post">
        <p><select name="game_name">

            <?php

            $records = $conn->prepare('select game_name from game where company_id = :company_id'); // = ' .$_SESSION['company_id'].);
            $company = $_SESSION['company_id'] ;
            //$company = "a";
            $records->bindParam(':company_id',$company );
            $records->execute();
            $results = $records->fetchAll();
            foreach($results as $result){
                echo "<option value =\"" . $result['game_name'] . "\"> " . $result['game_name'] . "</option> ";
            }
            ?>

        </select>
    </p></p>
    <label for="published_date"><b>Publish Date : </b></label>
    <input type="date" placeholder="New Publish Date" name="published_date"  class = "box1"><br /><br />

    <label for="price"><b>Price : </b></label>
    <input type="number" placeholder="Price" name="price"  class = "box1"><br /><br />

    <label for="developer"><b>Developer : </b></label>
    <input type="text" placeholder="Developer" name="developer"  class = "box1"><br /><br />

    <label for="category"><b>Category : </b></label>
    <input type="text" placeholder="Category" name="category_name"  class = "box1"><br /><br />

    <label for="description"><b>Description : </b></label>
    <textarea name ="description" placeholder="Description" cols = "40" rows="5"></textarea><br /><br />

    <input type="submit" name="delete_game" value=" Delete Game "/><br /><br />
    <input type = "submit" value = "Save Changes"/>

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