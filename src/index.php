<!DOCTYPE HTML>
<html lang = "en">
<head>
    <title>Home Media</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="../css/stylesheet.css" type="text/css">
    <link rel="stylesheet" href="../css/mainPage.css" type="text/css">
</head>
<body>
<nav class="navtop">
    <div>
        <h1>Home Media System</h1>
        <a href="register.html"><i class="fa fa-registered"></i>To Register</a>
    </div>
</nav>
<div class="login">
    <h1>Login</h1>
    <form action="authenticate.php" method="post">

        <label for="username">
            <i class="fas fa-user"></i>
        </label>
        <input type="text" name="username" placeholder="Username" id="username" required>

        <label for="password">
            <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="password" placeholder="Password" id="password" required>

        <input type="submit" name="btnLogin" value="Submit">
    </form>
</div>

</body>

</html>


<?php
