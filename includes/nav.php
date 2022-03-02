<ul class="nav_ul">
    <li><a href="index.php">Home</a></li>
    <li><a href="about.php">About Me</a></li>
    <li><a href="blog.php">Blog</a></li>
    <?php if ($_SESSION['is_logged_in']): ?>
        <li><a href="logout.php">Logout</a></li>
    <?php else: ?>    
        <li><a href="login.php">Login</a></li>
    <?php endif; ?>
</ul>