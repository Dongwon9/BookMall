<?php
$db = new PDO("mysql:host=localhost;port=3307;dbname=bookmall", "php", "1234");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>