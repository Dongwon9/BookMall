<?php
session_start();
require("db_connect.php");
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
        <h2>인기 도서 25권</h2>
        <table>
            <?php
            $queue = $db->query("select * from books order by hits desc limit 25");
            while ($row = $queue->fetch()) {
            ?>
                <tr>
                    <td><a href="book/bookpage.php?isbn=<?= $row["isbn"] ?>"><?= $row["title"] ?></a></td>
                    <td><?= $row["author"] ?></td>
                    <td>평점 <?= $row["avgscore"] > 0 ? $row["avgscore"] . "점" : "없음" ?></td>
                    <td>조회수 <?= $row["hits"] ?>회</td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <br>
</body>

</html>