<?php

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

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_title = $_POST['title'];
    $form_content = $_POST['content'];
    $form_id = $_POST['form_id'];

    $errors = [];

    if ($form_title == '') {
        $errors[] = 'Title is required.';
    }

    if ($form_content == '') {
        $errors[] = 'Content is required.';
    }

    if ($form_id == '') {
        $errors[] = 'ID is required.';
    }

    if (empty($errors)) {
        $conn = getDB();

        $date = new DateTimeImmutable();
        $timestamp = date_format($date, 'Y-m-d H:i:s');
    
        $sql = "UPDATE article SET title = ?, content = ?, last_edited = ? WHERE id = ?";
    
        $stmt = mysqli_prepare($conn, $sql);
    
        if ($stmt !== false) {
            mysqli_stmt_bind_param($stmt, "ssss", $form_title, $form_content, $timestamp, $form_id);
            mysqli_stmt_execute($stmt);
        }

        redirect("/article.php?id=$id");
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

    <article>
        <?php if (!empty($errors)): ?>
            <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if ($result === null): ?>
            <p>Article not found.</p>
        <?php else: ?>
            <form method="post">
            <div>
                <label for="title">Title:</label>
                <?php if($result['title'] == ''): ?>
                    <input name="title" id="title" />
                <?php else: ?>
                    <input name="title" id="title" value="<?= htmlspecialchars($result['title']); ?>" />
                <?php endif; ?>
            </div>
            <div>
                <label for="content">Content:</label>
                <?php if($result['content'] == ''): ?>
                    <textarea name="content" id="content" cols="30" rows="10"></textarea>
                <?php else: ?>
                    <textarea name="content" id="content" cols="30" rows="10"><?= htmlspecialchars($result['content']); ?></textarea>
                <?php endif; ?>
            </div>
            <div>
                <input type="hidden" name="form_id" id="form_id" value="<?= $result['id']; ?>" />
                <button>Send</button>
            </div>
        </form>
        <?php endif; ?>
    </article>

    <footer>
        <?php include("./includes/footer.php"); ?>
    </footer>
    
    <script src="./js/script.js"></script>
</body>
</html>