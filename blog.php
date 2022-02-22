<?php

$title = "Blog";

include("./includes/db_connection.php");

$conn = getDB();
$sql = "SELECT * FROM article ORDER BY published_at DESC;";
$response = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($response, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("./includes/head.php"); ?>
</head>
<body>
    <header>
        <?php include("./includes/header.php"); ?>
    </header>

    <nav>
        <?php include("./includes/nav.php"); ?>
    </nav>

    <article>
        <?php if (empty($result)): ?>
            <p>No articles found</p>
        <?php else: ?>
            <dl>
                <?php foreach ($result as $article): ?>
                    <dt><a href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a></dt>
                    <dd><?= htmlspecialchars($article['content']); ?></dd>
                <?php endforeach; ?>
            </dl>
        <?php endif; ?>
    </article>

    <footer>
        <?php include("./includes/footer.php"); ?>
    </footer>
    
    <script src="./js/script.js"></script>
</body>
</html>