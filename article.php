<?php

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}

include("./includes/db_connection.php");

if (mysqli_connect_error()) {
    echo "connection error";
    exit;
} else {
    $sql = "SELECT * FROM article WHERE id={$id};";
    $response = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($response);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php if ($result === null): ?>
        <p>Article not found.</p>
    <?php else: ?>
        <?= $result['title']; ?>
        <br>
        <?= $result['content']; ?>
    <?php endif; ?>
    
    <script src="./js/script.js"></script>
</body>
</html>