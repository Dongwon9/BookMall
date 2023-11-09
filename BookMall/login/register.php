<?php
session_start();
$id = $_REQUEST["name"];
$pw = $_REQUEST["pw"];
$pw2 = $_REQUEST["pw2"];
require("../db_connect.php");
if ($pw != $pw2) { ?>
    <script>
        alert("비밀번호 확인이 일치하지 않습니다.");
        history.back();
    </script>

<?php exit;
}
if ($id == "" || $pw == "") { ?>
    <script>
        alert("아이디와 비밀번호를 입력해야 합니다.");
        history.back();
    </script>
<?php exit;
}

if ($db->query("select * from users where username='$id'")->fetch()) { ?>
    <script>
        alert("같은 아이디를 가진 계정이 이미 있습니다.");
        history.back();
    </script>
<?php exit;
}
$db->exec("insert into users(username,passwd) values ('$id','$pw')");
?>
<script>
    location.href = "../main.php";
</script>