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

$title = $result['title'];

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
    <?php if ($result === null): ?>
        <p>Article not found.</p>
    <?php else: ?>
        <?= $result['title']; ?>
        <br>
        <?= $result['content']; ?>
    <?php endif; ?>

    <footer>
        <?php include("./includes/footer.php"); ?>
    </footer>
    
    <script src="./js/script.js"></script>
</body>
</html>