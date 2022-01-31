<?php

include("./includes/db_connection.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_title = $_POST['title'];
    $form_content = $_POST['content'];

    $date = new DateTimeImmutable();
    $timestamp = date_format($date, 'Y-m-d H:i:s');

    $values = $form_title . "', '" . $form_content . "', '" . $timestamp;

    $sql = "INSERT INTO article (title, content, published_at) VALUES ('" . $values . "')";

    $results = mysqli_query($conn, $sql);

    if ($results === false) {
        echo mysqli_error($conn);
    } else {
        $id = mysqli_insert_id($conn);
        echo "Inserted record with ID: $id";
    }
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

    <?php if(isset($form_title)): ?>
        <p><?= $form_title ?></p>
        <p><?= $form_content ?></p>
        <p><?= $timestamp ?></p>
        <p><?= $values ?></p>
        <p><?= $sql ?></p>
    <?php endif; ?>

    <form method="post">
        <div>
            <label for="title">Title:</label>
            <input name="title" id="title" />
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
        </div>
        <div>
            <button>Send</button>
        </div>
    </form>

    <footer>
        <?php include("./includes/footer.php"); ?>
    </footer>
    
    <script src="./js/script.js"></script>
</body>
</html>