<?php session_start();
require("../db_connect.php") ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
    <?php require("../header.php");
    ?>
    <br><br><br>
    <form method="post" action="register.php" class="oncenter">
        ID:<input type="text" name="name"><br>
        PW:<input type="password" name="pw"><br>
        PW확인:<input type="password" name="pw2"><br>
        <button type="submit">회원가입</button>
    </form><br>
</body>

</html>