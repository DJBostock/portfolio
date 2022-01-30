<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $form_title = $_POST['title'];
        $form_content = $_POST['content'];
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