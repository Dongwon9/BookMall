<?php
if (!isset($_SESSION["userid"])) {
?>
    <script>
        alert("로그인하세요.");
        location.href = "../main.php";
    </script>
<?php
    exit;
}
?>