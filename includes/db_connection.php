<?php

function getDB() {
    include("./includes/db_credentials.php");

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    return $conn;
}

?>