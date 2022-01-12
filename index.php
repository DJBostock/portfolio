<?php

include("./includes/db_connection.php");

if (mysqli_connect_error()) {
    echo "connection error";
    exit;
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
    <?php if (empty($result)): ?>
        <p>No articles found</p>
    <?php else: ?>
        <dl>
            <?php foreach ($result as $article): ?>
                <dt><a href="article.php?id=<?= $article['id']; ?>"><?= $article['title']; ?></a></dt>
                <dd><?= $article['content']; ?></dd>
            <?php endforeach; ?>
        </dl>
    <?php endif; ?>
    
    <script src="./js/script.js"></script>
</body>
</html>