<?php require("../db_connect.php");

$title = $_REQUEST["title"];
$author = $_REQUEST["author"];
$publisher = $_REQUEST["publisher"];
$price = $_REQUEST["price"];
$description = $_REQUEST["description"];
$isbn = $_REQUEST["isbn"] ?? -1;

foreach ($_REQUEST as $field) {
    if ($field == "") {
?>
        <script>
            alert("모든 필드를 입력해야 합니다.");
            history.back();
        </script>
<?php
        exit;
    }
}
if ($isbn == -1) {
    $db->exec("insert into books(title,author,publisher,price,description) 
        values ('$title', '$author','$publisher','$price','$description')");
} else {
    $db->exec("update books set 
        title='$title', author='$author',publisher='$publisher',
        price='$price',description='$description'
        where isbn=$isbn");
}
header("Location:../main.php");
exit;
