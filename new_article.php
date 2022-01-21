<?php
    if(isset($_GET['search'])) {
        $test = "form submitted.";
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
        <p><?= $test; ?></p>
    <?php endif; ?>

    <form>
        <input name="search" />
        <button>Send</button>
    </form>
    
    <script src="./js/script.js"></script>
</body>
</html>