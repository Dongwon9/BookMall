<?php session_start();
require("../db_connect.php");
$username = $_SESSION["username"];
$userid = $_SESSION["userid"];
$nowpw = $_REQUEST["nowpw"];
$nowinfo = $db->query("select * from users where userid=$userid")->fetch();
if ($nowinfo["passwd"] != $nowpw) {
?>
    <script>
        alert("암호를 틀렸습니다.");
        history.back();
    </script>
<?php exit;
}
$pass = $nowinfo["passwd"];
$newname = $_REQUEST["newname"] != "" ? $_REQUEST["newname"] : $username;
$newpw = $_REQUEST["newpw"] != "" ? $_REQUEST["newpw"] : $pass;
if (
    $db->query("select * from users where username='$newname'")->fetch()
    && $newname != $username
) { ?>
    <script>
        alert("입력하신 아이디는 이미 사용중입니다.");
        history.back();
    </script>
<?php exit;
}
$db->exec("update users set username='$newname', passwd='$newpw' where userid=$userid");
?>
<script>
    alert("변경 완료. 로그아웃됩니다.");
</script>
<?php
unset($_SESSION["userid"]);
unset($_SESSION["username"]);
unset($_SESSION["admin"]);
header("Location:../main.php");
?>