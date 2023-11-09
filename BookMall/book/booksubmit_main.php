<?php session_start();
if (!$_SESSION["admin"]) {
    require("../errorpage.php");
}
require("../db_connect.php");
if (isset($_REQUEST["modify"])) {
    $isbn = $_REQUEST["modify"];
    $book = $db->query("select * from books where isbn=$isbn")->fetch();
}
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
    <h2>
        <?php
        if (empty($isbn)) {
            echo "신규 도서 등록";
        } else {
            echo "책 $book[1] 에 대한 정보 수정";
        }
        if (isset($book["title"])) {
            $book["title"] = str_replace(" ", "&nbsp;", $book["title"]);
        }
        ?>
    </h2>
    <form action="booksubmit.php" method="post">
        제목:<input type="text" name="title" value=<?= $book["title"] ?? "" ?>><br>
        저자:<input type="text" name="author" value=<?= $book["author"] ?? "" ?>><br>
        출판사:<input type="text" name="publisher" value=<?= $book["publisher"] ?? "" ?>><br>
        가격:<input type="number" name="price" value=<?= $book["price"] ?? "" ?>><br>
        설명<br>
        <textarea name="description" class="big"><?= $book["description"] ?? "" ?></textarea>
        <?php if (empty($isbn)) { ?>
            <button type="submit">등록</button>
        <?php } else { ?>
            <button type="submit" name="isbn" value=<?= $isbn ?>>수정</button>
        <?php } ?>
    </form>
</body>

</html>