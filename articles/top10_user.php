<?php include "connect.php" ?>
<?php 
    $count = 0;
    $sql = "select p.account, name, numberofpost, linkgithub from personal_infor p, account_infor a where p.account = a.account order by numberofpost desc ;";
    $result = $con->query($sql);
    if(!empty($result)){
        foreach($result as $item):
            $count ++; 
            if($count > 10) break;
?>       
            <div>
                <a href="../header_footer/ValidUser.php?account=<?php echo $item['account']; ?>" target="_blank"><p><?php echo "#".$count; ?></p><?php echo $item['account']." - ".$item['name']." - ".$item['numberofpost']." posts"; ?></a>
            </div>
<?php   
        endforeach;
    }
?>