"use strict";

$(document).ready(function () {
    var chatInterval = 250; //refresh interval in ms
    var $userName = $("#userName");
    var $friendUserName = $("#friendUserName");
    var $chatOutput = $("#chatOutput");
    var $chatInput = $("#chatInput");
    var $chatSend = $("#chatSend");

    function sendMessage() {
        var userNameString = $userName.val();
        var friendUserNameString = $friendUserName.val();
        var chatInputString = $chatInput.val();

        $.get("./write.php", {
            username: userNameString,
            friendUsername: friendUserNameString,
            text: chatInputString
        });

        $chatInput.val("");
        retrieveMessages();
    }

    function retrieveMessages() {
        var userNameString = $userName.val();
        var friendUserNameString = $friendUserName.val();


        $.get("./read.php", { username: userNameString, friendUsername: friendUserNameString},
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