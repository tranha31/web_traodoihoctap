<?php
    $limit = 5;
    $offset = ($page - 1)* $limit;
    $bestCmtId = "";

    $sql = "select * from comments where id = ".$id." order by best_cmt desc, time desc limit ".$limit." offset ".$offset;
    $sql2 = "select * from comments where id = ".$id." order by best_cmt desc, time desc";
    $result = $con->query($sql);
    $result2 = $con->query($sql2);

    if(!empty($result2) && $result2->num_rows > 0){
        foreach($result2 as $item): 
            if($item['best_cmt'] == 1) {
                $bestCmtId = $item['id_cmt'];
                break;
            }
        endforeach;
    }

    if(!empty($result) && $result->num_rows > 0){   
        foreach($result as $item): 
            ?>
                        <div class='username'>
                            <li><img id="img_u" src='https://drive.google.com/uc?id=1J3HBvIiL3x0bkMY9vdQO0AHy3e-VTdue'></li>
                            <li><a href='../header_footer/ValidUser.php?account=<?php echo $item["account"]; ?>'><h3><?php echo $item["account"] ?></h3></a></li>
                            <li><p style='color: rgb(145, 131, 131);'><?php echo $item['time'] ?></p></li>
            <?php
                        if($loginUser != null && $account == $loginUser){
            ?>
                            <form style="z-index:5; position:relative;" action="<?php echo "main.php?id=".$id."&page=".$page."#cmt_frame" ?>" method="POST">
                                    <input type="hidden" value="<?php echo $item['id_cmt'] ?>" name="best_solution_id">
                                    <input type="hidden" value="<?php echo $item['best_cmt'] ?>" name="best_solution_status">
                                    <input type="hidden" value="<?php echo $bestCmtId ?>" name="bestCmtId">
                                    <button style="margin:5px;padding:10px;font-size:medium; border-radius: 5% ;background-color: 
                                    <?php if($item['best_cmt'] == 0) echo "#00748b"; else echo "008b00" ?>; color:white;" type="sumbit"><p id="choose_best">
                                    <?php 
                                    if($item['best_cmt'] == 0) echo "CHOOSE THIS?";
                                    else if ($item['best_cmt'] == 1) echo "BEST SOLUTION!"
                                    ?>
                                    </p></button>
                            </form>
            <?php
                        }  
                            else {
                                if($item['best_cmt'] == 1){
            ?>
                            <li><p id="best_soluton" style="padding:10px;font-size:medium; border-radius: 5% ;background-color: #008b00; color:white;">BEST SOLUTION</p></li>
            <?php
            
                        }}
                        if($loginUser == $item['account']){ 
            ?>
                            <button style="z-index:5; position:relative;margin:5px;padding:10px;font-size:medium; 
                            border-radius: 5% ;background-color: #008b00; color:white;" onclick="showFormEditComment('<?php echo 'editForm'.$item['id_cmt'] ?>')">EDIT</button>
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
                        </div>
                        <div class="you" id="editForm<?php echo $item['id_cmt'] ?>" hidden>
                                <form method="POST" action="<?php 
                                                                            
                                                                            if($loginUser == null) echo "../login/login.php";
                                                                            else {
                                                                                echo htmlspecialchars("main.php?id=".$id."&page=".$page);
                                                                            }
                                                                        ?>">
                                                <input type="text" value="<?php echo $item['id_cmt'] ?>" name="myEditCommentId" hidden>
                                                <textarea name="myEditComment"></textarea>
                                                <button type="submit" class="button">Send</button>
                                </form>
                        </div>
                        <br><br>
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