<?php

session_start();

$_SESSION['is_logged_in'] = true;

include("./includes/article_functions.php");
redirect("/index.php");

?>