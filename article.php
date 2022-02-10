<?php

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    include("./includes/db_connection.php");
    $conn = getDB();
    $sql = "SELECT * FROM article WHERE id={$id};";
    $response = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($response);
    $title = $result['title'];
} else {
    $id = 0;
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

    <footer>
        <?php include("./includes/footer.php"); ?>
    </footer>
    
    <script src="./js/script.js"></script>
</body>
</html>