<?php
    $account = "";
    $title = "";
    $content = "";
    $content_code = "";
    $vote = "";
    $publish_date = "";
    $status = "";
    $tag1 = "";
    $tag2 = "";
    $tag3 = "";
    $checkArticle = "";
    $checkLike = false;

    $sql = "select * from articles where id = ".$id;
    
    $result = $con->query($sql);
    if(!empty($result) && $result->num_rows > 0){
        $data = $result->fetch_assoc();
        $account = $data['account'];
        $title = $data['title'];
        $content = $data['content'];
        $content = html_entity_decode($content);
        $content_code = $data['content_code'];
        $publish_date = $data['publish_date'];
        $status = $data['status'];
        $tag1 = $data['tag1'];
        $tag2 = $data['tag2'];
        $tag3 = $data['tag3'];
    }
    if($content_code == "") $content_code = "Empty.";
    else{
        $content_code = html_entity_decode($content_code);
    }

    $comment = $_POST['myComment'] ?? null;
    if($comment != null){
        $comment = addslashes($comment);
        $comment = htmlspecialchars(htmlentities($comment));
        $time = date("Y-m-d");
        $sqlComment = "insert into comments(account, id, content, likes, time) values ('$loginUser','$id','$comment',0,'$time');";
        $con->query($sqlComment);
        $sqlAddCmtAction = "insert into actions values ('$loginUser','comments','$id','$time');";
        $con->query($sqlAddCmtAction);
    }

    //best solution
    $bestSolutionId = $_POST['best_solution_id'] ?? null;
    $bestSolutionStatus = $_POST['best_solution_status'] ?? null;
    $bestCmtId = $_POST['bestCmtId'] ?? null;
    if($bestSolutionId != null){
        if($bestSolutionStatus == 0){
            $sqlAddBestSolution = "update comments set best_cmt = 1 where id_cmt = ".$bestSolutionId;
            $con->query($sqlAddBestSolution);
            $sqlChangeBestSolution = "update comments set best_cmt = 0 where id_cmt = ".$bestCmtId;
            $con->query($sqlChangeBestSolution);
        } else {
            $sqlDelBestSolution = "update comments set best_cmt = 0 where id_cmt = ".$bestSolutionId;
            $con->query($sqlDelBestSolution);
        }
    }

    //check if the user likes the post
    $sqlCheckLike = "select acc from likes where id_article = ".$id;
    $result = $con->query($sqlCheckLike);
    if(!empty($result) && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            if($row['acc'] == $loginUser){
                $checkLike = true;
            }
        }
    }
    
    $mainLike = $_POST['mainLike'] ?? null;
    
    if($mainLike != null){
         if ($checkLike == false) {
            $sqlIncLike = 'insert into likes values ("'.$loginUser.'","'.$id.'");';
            $con->query($sqlIncLike);
            $checkLike = true;
            $time = date("Y-m-d");
            $sqlAddLikeAction = "insert into actions values ('$loginUser','likes','$id','$time', 0);";
            $con->query($sqlAddLikeAction);
             
            $sql1 = "update articles set vote = vote+1 where id = $id";
            $con->query($sql1);
            $uu = $_SESSION['account'];
            $sql2 = "update account_infor set numberofheart = numberofheart+1 where account ='$uu'";
            $con->query($sql2);
        } else {
            $sqlDecLike = 'delete from likes where acc = "'.$loginUser.'" and id_article = "'.$id.'";';
            $con->query($sqlDecLike);
            $checkLike = false;
            $sqlDelLikeAction = 'delete from actions where account = "'.$loginUser.'" and id = "'.$id.'";';
            $con->query($sqlDelLikeAction);
             
            $sql1 = "update articles set vote = vote-1 where id = $id";
            $con->query($sql1);
        }   
    }

    //count the number of hearts
    $sqlLikes = "select count(*) from likes where id_article = ".$id;
    $result = $con->query($sqlLikes);
    if(!empty($result) && $result->num_rows > 0){
        $vote = $result->fetch_assoc()['count(*)'];
    } else {
        $vote = 0;
    }


    //like function for the comment part
    $cmt_like = $_POST['cmt_like'] ?? null;
    if($cmt_like != null){
        $checkCmt = false;
        $sqlCheckCmt = "select acc from likes_cmt where id_cmt = ".$cmt_like;
        $result = $con->query($sqlCheckCmt);
        if(!empty($result) && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($row['acc'] == $loginUser){
                    $checkCmt = true;
                }
            }
        }
        

        if ($checkCmt == false) {
            $sqlIncLikeCmt = 'insert into likes_cmt values ("'.$loginUser.'","'.$cmt_like.'");';
            $con->query($sqlIncLikeCmt);
            $uu = $_SESSION['account'];
            $sql2 = "update account_infor set numberofheart = numberofheart+1 where account = '$uu'";
            $con->query($sql2);
        } else {
            $sqlDecLikeCmt = 'delete from likes_cmt where acc = "'.$loginUser.'" and id_cmt = "'.$cmt_like.'";';
            $con->query($sqlDecLikeCmt);
        }   
    }

    //check if the current account is admin
    $checkAdmin = 0;
    if($loginUser != null)
    {
        $sqlCheckAdmin = 'select level from account_infor where account = "'.$loginUser.'"';
        $result = $con->query($sqlCheckAdmin);
        if(!empty($result) && $result->num_rows > 0){
            $checkAdmin = $result->fetch_assoc()['level'];
        }
    }
    

    $checkArticle = $_POST['checkArticle'] ?? null;
    if($checkArticle != null){
        if ($status == 0) {
            $sqlCheck = 'update articles set status = 1 where id = '.$id;
            $con->query($sqlCheck);
            $status = 1;
            $time = date("Y-m-d H-i-s");
            $sqlAddAdminCheck = 'insert into admin_activity (account1, activity, account2, link, datetime) values("'.$loginUser.'","moderated the post","'.$account.'","http://localhost/web_traodoihoctap/articles/main2.php?id='.$id.'","'.$time.'")';
            $con->query($sqlAddAdminCheck);
        } else {
            $sqlCheck = 'update articles set status = 0 where id = '.$id;
            $con->query($sqlCheck);
            $status = 0;
            $time = date("Y-m-d H-i-s");
            $sqlDelAdminCheck = 'insert into admin_activity (account1, activity, account2, link, datetime) values("'.$loginUser.'","unmoderated the post","'.$account.'","http://localhost/web_traodoihoctap/articles/main2.php?id='.$id.'","'.$time.'")';
            $con->query($sqlDelAdminCheck);
        }   
    }

     //edit comment
     $editCommentContent = $_POST['myEditComment'] ?? null;
     $editCommentId = $_POST['myEditCommentId'] ?? null;
     if($editCommentContent != null){
         $editCommentContent = addslashes($editCommentContent);
         $editCommentContent = htmlspecialchars(htmlentities($editCommentContent));
         $timeEdit = date("Y-m-d");
         $sqlEditComment = 'update comments set content = "'.$editCommentContent.'", time = "'.$timeEdit.'" where id_cmt = '.$editCommentId;
         $con->query($sqlEditComment);
     }
 
 ?>
 
