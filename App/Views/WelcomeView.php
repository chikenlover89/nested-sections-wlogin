<?php include "App/Views/Headers/Header.php" ?>

<div style="text-align: center">
    <?php if ($_SESSION['auth_id'] != null): ?>
        <h1>Welcome, <?php echo $_SESSION['auth_id']; ?>! </h1>
        <img
                src="https://upload.wikimedia.org/wikipedia/commons/e/e6/Home_Icon.svg"
                alt="home"
                height="100px"
                width="100px"/>
    <?php else: ?>
        <h1>Welcome!</h1>
        <h2>Please Log In! </h2>
    <?php endif; ?>
</div>