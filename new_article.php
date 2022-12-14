<?php

session_start();

include("./includes/db_connection.php");
include("./includes/article_functions.php");

if($_SESSION['is_logged_in'] !== true) {
    redirect("/blog.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_title = $_POST['title'];
    $form_content = $_POST['content'];

    $errors = [];

    if ($form_title == '') {
        $errors[] = 'Title is required.';
    }

    if ($form_content == '') {
        $errors[] = 'Content is required.';
    }

    if (empty($errors)) {
        $conn = getDB();

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
                redirect("/article.php?id=$id");
            } else {
                echo mysqli_stmt_error($stmt);
            }
        }
    }
}

$title = "New Article";

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
        <?php if (!empty($errors)): ?>
            <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="post">
            <div>
                <label for="title">Title:</label>
                <?php if($form_title == ''): ?>
                    <input name="title" id="title" />
                <?php else: ?>
                    <input name="title" id="title" value="<?= htmlspecialchars($form_title); ?>" />
                <?php endif; ?>
            </div>
            <div>
                <label for="content">Content:</label>
                <?php if($form_content == ''): ?>
                    <textarea name="content" id="content" cols="30" rows="10"></textarea>
                <?php else: ?>
                    <textarea name="content" id="content" cols="30" rows="10"><?= htmlspecialchars($form_content); ?></textarea>
                <?php endif; ?>
            </div>
            <div>
                <button>Send</button>
            </div>
        </form>

    </article>


    <footer>
        <?php include("./includes/footer.php"); ?>
    </footer>
    
    <script src="./js/script.js"></script>
</body>
</html>