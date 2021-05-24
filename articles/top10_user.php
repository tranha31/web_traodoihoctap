<?php include "connect.php" ?>
<?php 
    $count = 0;
    $sql = "select p.account, name, numberofheart, linkgithub from personal_infor p, account_infor a where p.account = a.account ;";
    $result = $con->query($sql);
    if(!empty($result)){
        foreach($result as $item):
            $count ++; 
            if($count > 10) break;
?>       
            <div>
                <a href="../header_footer/ValidUser.php?account=<?php echo $item['account']; ?>" target="_blank"><p><?php echo "#".$count; ?></p><?php echo $item['account']." - ".$item['name']." - ".$item['numberofheart']." hearts"; ?></a>
            </div>
<?php   
        endforeach;
    }
?>