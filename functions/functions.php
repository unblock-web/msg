<?php
    $mysqli = false;
    function connectDB () {
        global $mysqli;
        $mysqli = new mysqli("localhost", "root", "", "FormBase1");
        $mysqli->qwery("SET NAMES 'utf-16'");
    }

    function closeDB () {
        global $mysqli;
        $mysqli->close ();
    }
?>
