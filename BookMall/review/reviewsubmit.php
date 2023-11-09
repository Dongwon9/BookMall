<?php
session_start();
require("../db_connect.php");
$isbn = $_REQUEST["isbn"];
$id = $_SESSION["userid"];
$score = $_REQUEST["score"];
$content = str_replace("\n", "<br>", $_REQUEST["content"]);
switch ($_REQUEST["mode"]) {
    case "write":
        $db->exec("insert into review(isbn,userid,content,score) values ('$isbn','$id','$content','$score')");
        break;
    case "update":
        $db->exec("update review set content='$content',score='$score' where isbn=$isbn and userid=$id");
        break;
    case "delete":
        $db->exec("delete from review where isbn=$isbn and userid=$id");
        break;
}
?>
<script>
    history.back();
</script>