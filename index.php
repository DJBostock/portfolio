<?php

include("./includes/db_credentials.php");

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_error()) {
    $result = "connection error";
} else {
    $sql = "SELECT * FROM article ORDER BY published_at;";
    $response = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($response, MYSQLI_ASSOC);
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
    <dl>
        <?php foreach ($result as $article): ?>
            <dt><?= $article['title']; ?></dt>
            <dd><?= $article['content']; ?></dd>
        <?php endforeach; ?>
    </dl>
    <script src="./js/script.js"></script>
</body>
</html>