<?php include "connect.php" ?>
<?php
    $id = isset($_GET['id'])? $_GET['id'] : 1;
    $sql = "select * from comments where id = ".$id;
    $result = $con->query($sql);
    $count = 0;
    if(!empty($result) && $result->num_rows > 0)
        $count = $result->num_rows;
        echo $count;
?>