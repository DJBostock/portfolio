<?php

session_start();

include("./includes/article_functions.php");

if($_SESSION['is_logged_in'] !== true) {
    redirect("/blog.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    include("./includes/db_connection.php");
    $id = $_POST['id'];
    $conn = getDB();
    $sql = "DELETE FROM article WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt !== false) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        redirect("/blog.php");
    }
} 

if(isset($_GET['id'])) {
    include("./includes/db_connection.php");
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
        <h2>Are you sure you want to delete this article?</h2>

        <?php if ($result === null): ?>
            <p>Article not found.</p>
        <?php else: ?>
            <?= htmlspecialchars($result['title']); ?>
            <br>
            <?= htmlspecialchars($result['content']); ?>
        <?php endif; ?>

        <form method="post" action="delete_article.php">
            <input type="hidden" name="id" value="<?= $id; ?>" />
            <button>Delete</button>
        </form>
    </article>

    <section>
        <ul>
            <li><a href="edit_article.php?id=<?= $id; ?>">Edit Article</a></li>
            <li><a href="delete_article.php?id=<?= $id; ?>">Delete Article</a></li>
        </ul>
    </section>

    <footer>
        <?php include("./includes/footer.php"); ?>
    </footer>
    
    <script src="./js/script.js"></script>
</body>
</html>