<?php session_start();
require("../db_connect.php");
$isbn = $_REQUEST["isbn"];
$db->exec("delete from books where isbn=$isbn");
$db->exec("delete from review where isbn=$isbn");
header("Location:../main.php");
exit;
