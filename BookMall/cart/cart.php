<?php session_start();
require("../db_connect.php");
require("../logincheck.php");
$userid = $_SESSION["userid"]
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
    <div class="oncenter">
        <?php
        if (!$db->query("select * from cart where userid=$userid limit 1")->fetch()) {
            echo "<h2>장바구니에 상품이 없습니다.</h2>";
            exit;
        }
        ?>
        <h2><?= $_SESSION["username"] ?> 님의 장바구니</h2>
        <table>
            <tr>
                <th>제목</th>
                <th>가격</th>
                <th>수량</th>
            </tr>
            <?php
            $totalprice = 0;
            $query = $db->query("select * from cart where userid=$userid");
            while ($row = $query->fetch()) {
                $info = explode(',', $row["info"]);
            ?>
                <form action="cartsubmit.php" method="post">
                    <tr>
                        <input type="hidden" name="isbn" value=<?= $row["isbn"] ?>>
                        <td><?= $info[0] ?></td>
                        <!--title-->
                        <td><?= (int)$info[1], "원" ?></td>
                        <!--price-->
                        <td><input name="amount" value=<?= $info[2] ?> class="onenumber"></td>
                        <td><button type="submit" name="mode" value="delete">제거하기</button></td>
                        <td><button type="submit" name="mode" value="modify">수량수정</button></td>
                    </tr>
                </form>
            <?php
                $totalprice += (int)$info[1] * (int)$info[2];
            }
            ?>
        </table>
        <h2>총 결제가격: <?= $totalprice ?>원
            <form action="cartsubmit.php" method="post">
                <button type="submit" name="mode" value="checkout">결제</button>
            </form>
        </h2>
    </div>
</body>

</html>