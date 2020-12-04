<link rel="stylesheet" href="/../App/Styles/BasicStyle.css">

<div class="header" ">
    <a style="padding-left: 10px" href="/">Home</a>
    <a style="padding-left: 10px" href="/login">Login</a>

    <?php if ($_SESSION['auth_id'] != null): ?>
        <a style="display: inline-block;float: right; padding-left: 10px" href="/logout">Logout</a>
        <a style="padding-left: 10px" href="/sections">Sections</a>
    <?php endif; ?>
</div>
<br>