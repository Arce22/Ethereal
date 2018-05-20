<?php
require("./_connect.php");

//connect to db
$db = new mysqli($db_host,$db_user, $db_password, $db_name); 
if ($db->connect_errno) {
	//if the connection to the db failed
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}


//get userinput from url
$username=substr($_GET["username"], 0, 32);
$friendUsername=substr($_GET["friendUsername"], 0, 32);
//escaping is extremely important to avoid injections!
$nameEscaped = htmlentities(mysqli_real_escape_string($db,$username)); //escape username and limit it to 32 chars
$friendNameEscaped = htmlentities(mysqli_real_escape_string($db,$friendUsername)); //escape username and limit it to 32 chars


$query="SELECT * FROM chat WHERE (username = '$nameEscaped' AND friendUsername = '$friendNameEscaped') OR (friendUsername='$nameEscaped' AND username = '$friendNameEscaped') ORDER BY id ASC";
//$query="SELECT * FROM chat ORDER BY id ASC";
//execute query
if ($db->real_query($query)) {
	//If the query was successful
	$res = $db->use_result();

    while ($row = $res->fetch_assoc()) {
        $username=$row["username"];
        $friendUsername=$row["friendUsername"];
        $text=$row["text"];
        $time=date('G:i', strtotime($row["time"])); //outputs date as # #Hour#:#Minute#
        
        if($username == $_GET["username"])
            echo "<p>$time | $username to $friendUsername: <font color=\"red\">$text</font></p>\n";
        else
            echo "<p>$time | $username to $friendUsername: $text</p>\n";
    }
}else{
	//If the query was NOT successful
	echo "An error occured";
	echo $db->errno;
}

$db->close();
?>
