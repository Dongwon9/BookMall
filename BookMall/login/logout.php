<?php
session_start();
unset($_SESSION["userid"]);
unset($_SESSION["username"]);
unset($_SESSION["admin"]);
?>
<script>
    history.back();
</script>