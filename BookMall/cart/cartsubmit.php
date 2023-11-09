<?php
session_start();
require("../db_connect.php");
$isbn = $_REQUEST["isbn"] ?? 0;
$userid = $_SESSION["userid"];
$amount = $_REQUEST["amount"] ?? 1;
$row = $db->query("select * from books where isbn=$isbn")->fetch();
$str = implode(',', [$row["title"], $row["price"], $amount]);

switch ($_REQUEST["mode"]) {
    case "submit":
        $db->exec("insert into cart(userid,isbn,info) values('$userid','$isbn','$str')");
        break;
    case "checkout":
        $db->exec("delete from cart where userid=$userid");
        break;
    case "delete":
        $db->exec("delete from cart where userid=$userid and isbn=$isbn");
        break;
    case "modify":
        if ((int)$amount <= 0) {
?>
            <script>
                alert("수량이 잘못되었습니다.");
                location.href = "cart.php";
            </script>
<?php exit;
        } else {
            $db->exec("update cart set info='$str' where userid=$userid and isbn=$isbn");
        }
        break;
}
header("Location:cart.php");
exit;
