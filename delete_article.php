<?php

include("./includes/article_functions.php");

if(isset($_GET['id'])) {
    include("./includes/db_connection.php");
    $id = $_GET['id'];
    $conn = getDB();
    $sql = "DELETE FROM article WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt !== false) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        redirect("/blog.php");
    }
} else {
    redirect("/blog.php");
}