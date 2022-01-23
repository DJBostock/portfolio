<?php
    if(isset($_POST['search'])) {
        $test = $_POST['search'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("./includes/head.php"); ?>
</head>
<body>
    <nav>
        <?php include("./includes/nav.php"); ?>
    </nav>

    <?php if(isset($test)): ?>
        <p><?= $test ?></p>
    <?php endif; ?>

    <form method="post">
        <input name="search" />
        <button>Send</button>
    </form>
    
    <script src="./js/script.js"></script>
</body>
</html>