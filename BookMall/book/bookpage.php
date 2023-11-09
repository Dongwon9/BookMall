<?php session_start();
require("../db_connect.php");
if (empty($_REQUEST["isbn"])) {
    require("../errorpage.php");
}
$isbn = $_REQUEST["isbn"];
$userid = $_SESSION["userid"] ?? False;

$avgsc = $db->query("select avg(score) from review where isbn=$isbn")->fetch()[0];
$db->exec("update books set avgscore='$avgsc' where isbn=$isbn");
if (!($book = $db->query("select * from books where isbn=$isbn")->fetch())) {
?>
    <script>
        alert("책을 찾을 수 없습니다.");
        history.back();
    </script>

<?php
}
$temp = $book["hits"] += 1;
$db->exec("update books set hits=$temp where isbn=$isbn");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
    <?php
    require("../header.php");
    require("../login/login_main.php");
    ?>
    <ul>
        <li>
            <h3><?= $book["title"] ?></h3><br>
        </li>
        <li>저자: <?= $book["author"] ?><br></li>
        <li>출판사: <?= $book["publisher"] ?><br></li>
        <li>가격: <?= $book["price"], "원" ?><br></li>
        <li>평점:<?= $book["avgscore"] > 0 ? $book["avgscore"] . "점" : "없음" ?><br></li>
        <li><?php if (isset($_SESSION["userid"])) {
                if (!$db->query("select * from cart where userid=$userid and isbn=$isbn")->fetch()) { ?>
                    <button type="button" onclick="location.href='../cart/cartsubmit.php?isbn=<?= $isbn ?>&mode=submit'">장바구니에 담기</button>
            <?php } else {
                    echo "장바구니에 있음";
                }
            }
            ?>
        </li>
    </ul>
    <?= $book["description"] ?><br>
    <?php require("../review/review.php");


    if ($_SESSION["admin"] ?? False) {
    ?>
        <p>---관리자 전용---</p>
        <button type="button" onclick="location.href='booksubmit_main.php?modify=<?= $isbn ?>'">
            도서정보 수정</button>
        <button type="button" onclick="location.href='bookdelete.php?isbn=<?= $isbn ?>'">
            도서 삭제</button>
    <?php } ?>
</body>

</html>