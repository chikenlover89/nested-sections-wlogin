<?php include "App/Views/Headers/Header.php" ?>

<div class="formWrap">
<div class="form">
<form method="post" action="/login">
    <div>
        <input type="user" id="user" name="user" required/>
        <label for="user">Username</label>
    </div>

    <div>
        <input type="password" id="password" name="password" required/>
        <label for="password">Password</label>
    </div><br>

    <button type="submit">Login</button>
</form>
</div>
</div>

<div style="color: red;text-align: center">
    <?=$error?>
</div>
