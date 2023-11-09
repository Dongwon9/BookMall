<?php session_start();
require("db_connect.php");
$searchtext = $_REQUEST["searchtext"];
$page = $_REQUEST["page"] ?? 1;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    require("header.php");
    require("login/login_main.php");
    ?>
    <div class="oncenter">
        <?php
        if (!$db->query("select * from books where title like '%$searchtext%' limit 1")->fetch()) {
            echo ("<h2>\"$searchtext\" 에 대한 검색결과가 없습니다.</h2>");
            exit;
        }
        ?>

        <h2><?= $searchtext ?>에 대한 검색 결과</h2>
        <table>
            <tr>
                <th>제목</th>
                <th>지은이</th>
                <th>출판사</th>
                <th>가격</th>
            </tr>

            <?php
            $resultSize = 20;
            $query = $db->query("select * from books where title like '%$searchtext%' limit $resultSize");
            while ($row = $query->fetch()) {
            ?>
                <tr>
                    <td><a href="book/bookpage.php?isbn=<?= $row["isbn"] ?>"><?= $row["title"] ?></a></td>
                    <td><?= $row["author"] ?></td>
                    <td><?= $row["publisher"] ?></td>
                    <td><?= $row["price"] ?>원</td>
                </tr>
            <?php
            }
            ?>
        </table>
        <!--페이지네이션컨트롤-->
        <?php
        $paginationSize = 10;

        $firstLink = floor(($page - 1) / $paginationSize) * $paginationSize + 1;
        $lastLink = $firstLink + $paginationSize - 1;

        $numRecords = $db->query("select count(*) from books where title like '%$searchtext%'")->fetch()[0];
        $numPages = ceil($numRecords / $resultSize);

        if ($lastLink > $numPages) {
            $lastLink = $numPages;
        }
        if ($firstLink > 1) {
            $link = $firstLink - 1;
            echo "<a href=\"searchresult.php?page=$link&searchtext=$searchtext\">이전</a> ";
        }
        for ($i = $firstLink; $i <= $lastLink; $i++) {
            if ($i == $page) {
                echo "<a href = \"searchresult.php?page=$i&searchtext=$searchtext\"><u>$i</u></a>  ";
            } else {
                echo "<a href = \"searchresult.php?page=$i&searchtext=$searchtext\">$i</a> ";
            }
        }
        if ($lastLink < $numPages) {
            $link = $lastLink + 1;
            echo "<a href=\"searchresult.php?page=$link&searchtext=$searchtext\">다음</a> ";
        }
        ?>
    </div>

</body>

</html>