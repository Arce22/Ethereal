<?php
session_start();
require 'database.php';

$user_id = $_GET["user_id"];

$records = $conn->prepare('SELECT added_id FROM friended WHERE adder_id = :user_id');
$records->bindParam(':user_id', $_GET['user_id']);
$records->execute();
$results = $records->fetchAll();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" type="text/css" media="screen"
    />
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><?= $_GET['user_id'] ?></h1>
            <h2>Welcome to Chat</h2>
            <a href="./player_market.php">Go to Market</a>
        </header>
        <main>
            <div class="userSettings">
                    <select id="friend" name="friend">
<?php
foreach($results as $result)
{
    echo '<option value="' . $result['added_id'] . '">' . strtoupper($result['added_id']) . '</option>';
}
?>
                    </select>
            </div>
            <div class="chat">
                <div id="chatOutput"></div>
                <input id="chatInput" type="text" placeholder="Input Text here" maxlength="128">
                <button id="chatSend">Send</button>
            </div>
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script>
        "use strict";

        $(document).ready(function () {
            var chatInterval = 750; //refresh interval in ms
            var $friendUserName = $("#friend");
            var $chatOutput = $("#chatOutput");
            var $chatInput = $("#chatInput");
            var $chatSend = $("#chatSend");
            
            function sendMessage() {
                var friendUserNameString = $friendUserName.val();
                var chatInputString = $chatInput.val();
                $.get("./write.php", {
                    username: '<?= $_GET['user_id'] ?>',
                    friendUsername: friendUserNameString,
                    text: chatInputString
                });

                $chatInput.val("");
                retrieveMessages();
            }

            function retrieveMessages() {
                var userNameString = '<?= $_GET['user_id'] ?>';
                var friendUserNameString = $friendUserName.val();


                $.get("./read.php", { username: '<?= $_GET['user_id'] ?>', friendUsername: friendUserNameString},
                    function (data) {
                        $chatOutput.html(data); //Paste content into chat output
                    }
                );
            }


            $chatSend.click(function () {
                sendMessage();
            });

            setInterval(function () {
                retrieveMessages();
            }, chatInterval);
        });
    </script>
</body>
</html>