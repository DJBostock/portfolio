<?php

session_start();

include("./includes/article_functions.php");
include("./includes/db_credentials.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $my_username && $password === $my_password) {
        $_SESSION['is_logged_in'] = true;
        redirect("/blog.php");
        exit;
    }
}

$title = "Login";

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
        <form class="login_form" method="post" action="login.php">
            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </div>
            <button type="submit">Submit</button>
        </form>
    </article>

    <footer>
        <?php include("./includes/footer.php"); ?>
    </footer>

    <script src="./js/script.js"></script>
</body>

</html>