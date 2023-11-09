<?php session_start();
require("../logincheck.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<script>
    function warning() {
        var result = confirm("정말로 회원탈퇴하시겠습니까?\n이 행동은 되돌릴 수 없습니다!");
        if (result == true) {
            location.href = "userdelete.php";
        }
    }
</script>

<body>
    <?php

    require("../header.php");
    require("../login/login_main.php");
    ?>
    <form action="usermodify.php" class="oncenter" method="post">
        <h2><?= $_SESSION["username"] ?>님의 정보 변경</h2><br>
        새 ID:<input type="text" name="newname"><br>
        새 암호:<input type="password" name="newpw"><br>
        현재 암호:<input type="password" name="nowpw"><br>
        <button type="submit">변경</button>
        <br><button type="button" style="color:red; background: black;" onclick="warning()">회원탈퇴</button>
    </form>

</body>


</html>