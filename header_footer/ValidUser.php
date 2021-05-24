<?php 
session_start();
if(!isset($_GET['account'])){
    ?>
    <script>
        window.location.assign('../information/account_infor.php');
    </script>
    <?php
}
else{
    $ac = $_GET['account'];
    if($ac == $_SESSION['account']){
        ?>
        <script>
            window.location.assign('../information/account_infor.php');
        </script>
        <?php
    }
    else{
        ?>
        <script>
            window.location.assign('../information/account_infor.php?account=<?php echo $ac; ?>');
        </script>
        <?php
    }
}

?>