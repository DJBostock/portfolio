<?php

include("./includes/db_connection.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = getDB();
    $form_title = $_POST['title'];
    $form_content = $_POST['content'];

    $date = new DateTimeImmutable();
    $timestamp = date_format($date, 'Y-m-d H:i:s');

    $sql = "INSERT INTO article (title, content, published_at) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $form_title, $form_content, $timestamp);
        if (mysqli_stmt_execute($stmt)) {
            $id = mysqli_insert_id($conn);
            echo "Inserted record with ID: $id";    
        } else {
            echo mysqli_stmt_error($stmt);
        }
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