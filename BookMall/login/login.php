<?php
session_start();
$id = $_REQUEST["name"];
$pw = $_REQUEST["pw"];
require("../db_connect.php");
$query = $db->query("select * from users where username='$id' and passwd='$pw'");
if ($row = $query->fetch()) {
    $_SESSION["userid"] = $row["userid"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["admin"] = $row["admin"];
?>
    <script>
        history.back();
    </script>
<?php } else { ?>
    <script>
        alert("아이디 또는 비밀번호가 틀렸습니다.");
        history.back();
    </script>
<?php } ?>