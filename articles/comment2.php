<?php
    $limit = 5;
    $offset = ($page - 1)* $limit;

    $sql = "select * from comments where id = ".$id." order by best_cmt desc, time desc limit ".$limit." offset ".$offset;
    $result = $con->query($sql);

    if(!empty($result) && $result->num_rows > 0){
        foreach($result as $item): 
?>
            <div class='username'>
                <li><img src='https://drive.google.com/uc?id=1J3HBvIiL3x0bkMY9vdQO0AHy3e-VTdue'></li>
                <li><a href='#'><h3><?php echo $item["account"] ?></h3></a></li>
                <li><p style='color: rgb(145, 131, 131);'><?php echo $item['time'] ?></p></li>
<?php
            if($item['best_cmt'] == 1){
?>
                <li><p style='background-color: #00748b; color: white; text-align: center; padding: 7px; border-radius: 5%;'><b><?php echo "BEST SOLUTION" ?></b></p></li>
<?php
            }
?>
            </div>
            <div class='cmt'>
                <pre><code><?php echo html_entity_decode($item['content']); ?></code></pre>
            </div>
            <div class='interact'>
                <p style="margin-right: 5px;">
<?php 
                $sqlCountLikeEachCmt = "select count(*) from likes_cmt where id_cmt = ".$item['id_cmt'];
                $result = $con->query($sqlCountLikeEachCmt);
                if(!empty($result)) echo $result->fetch_assoc()['count(*)'];
                else echo 0;
?>
                 </p>
                <?php
                if(isset($_SESSION['account'])){
                ?>
                <form style="margin-bottom: 15px;" action="<?php 
                                                            $loginUser = $_SESSION['account'] ?? null;
                                                            if($loginUser == null) echo "../login/login.php";
                                                            else {
                                                               "main.php?id=".$id."&page=".$page;
                                                            }
                
                                                            ?>#cmt_frame" method="POST">
                    <input type="hidden" value="<?php echo $item['id_cmt'] ?>" name="cmt_like">
                    <button type="sumbit"><p>Like</p></button>
                </form>
                <?php
                }
                
                ?>
                
            </div>
<?php 
        endforeach; 
    }

    $sqlCount = "select count(*) from comments where id = ".$id;
    $resultCount = $con->query($sqlCount);
    $pageCount = 0;
    if(!empty($resultCount) && $resultCount->num_rows > 0){
        $tmp = $resultCount->fetch_assoc()['count(*)'];
        $pageCount = $tmp/$limit;
        if($tmp % $limit != 0) {
            $pageCount = floor($pageCount) + 1;;
        }
    }
?>