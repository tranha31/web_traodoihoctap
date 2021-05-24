<?php
session_start();
unset($_SESSION['account']);
?>
<script>
    window.location.assign("../main_forum/Code/home.php");
</script>