<aside>
    <?php if (!isset($_SESSION["userid"])) { ?>
        <form method="post" action="/BookMall/login/login.php">
            ID:<input type="text" name="name"><br>
            PW:<input type="password" name="pw">
            <button type="submit">로그인</button>
        </form><br>
        <button type="button" onclick="location.href='/BookMall/login/register_main.php'">회원가입</button>

    <?php } else { ?>
        <?= $_SESSION["username"] ?>님 안녕하세요.<br>
        <button type="button" onclick="location.href='/BookMall/login/logout.php'">로그아웃</button>
        <button type="button" onclick="location.href='/BookMall/cart/cart.php'">장바구니</button>
        <button type="button" onclick="location.href='/BookMall/user/usermodify_main.php'">ID/암호 변경</button>
        <?php if ($_SESSION["admin"]) { ?>
            <br><button type="button" onclick="location.href='/BookMall/book/booksubmit_main.php'">책 등록</button>
    <?php }
    } ?>
</aside>