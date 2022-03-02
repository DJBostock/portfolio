<?php

session_start();

if(isset($_GET['id'])) {
    include("./includes/db_connection.php");
    include("./includes/article_functions.php");
    $id = $_GET['id'];
    $conn = getDB();
    $result = getArticle($conn, $id);
    $title = $result['title'];
} else {
    $id = 0;
    $result = null;
    $title = "Article not found.";
}

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
        <?php if ($result === null): ?>
            <p>Article not found.</p>
        <?php else: ?>
            <?= htmlspecialchars($result['title']); ?>
            <br>
            <?= htmlspecialchars($result['content']); ?>
        <?php endif; ?>
    </article>

    <?php if($_SESSION['is_logged_in']): ?>
    <section>
        <ul>
            <li><a href="edit_article.php?id=<?= $id; ?>">Edit Article</a></li>
            <li><a href="delete_article.php?id=<?= $id; ?>">Delete Article</a></li>
        </ul>
    </section>
    <?php endif; ?>

    <footer>
        <?php include("./includes/footer.php"); ?>
    </footer>
    
    <script src="./js/script.js"></script>
</body>
</html>