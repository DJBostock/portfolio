<?php

function getArticle($conn, $id) {
    $sql = "SELECT * FROM article WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt !== false) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}



?>