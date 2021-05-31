<html>
<head>
    <title>Web Trao đổi học tập</title>
    <meta charset="UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "../main_forum/Code/header_footer.css">
    <link rel="stylesheet" href = "index.css">
    
    
</head>
<body>
<?php include "connect.php" ?> 
<?php
    $id = isset($_GET['id']) ? ($_GET['id'] > 0 ? $_GET['id'] : 1) : 1;
    $page = isset($_GET['page']) ? ($_GET['page'] > 0 ? $_GET['page'] : 1) : 1;
    //$_SESSION['account'] = "haiphamk63";
    $loginUser = $_SESSION['account'] ?? null; 
?> 
<?php include "article_and_cmt.php" ?>  

<!-- The finction helps remove the previous value of $POST['__'] --> 
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

    <section>
        <div class = "main">
            <div id="left">
                
                <div class="middle">
                    <div class="title">
                        <div class="name">
                            <h2>
                                <?php echo $title ?>
                            </h2>
                        </div>
                        <div class="moreinfo">
                            <h5><pre>Asked: <?php echo $publish_date ?></pre></h5>
                            <?php
                            if($tag1 && $tag2 && $tag3){
                                ?>
                                <button><a href="#"><?php echo $tag1; ?></a></button>
                                <button><a href="#"><?php echo $tag2; ?></a></button>
                                <button><a href="#"><?php echo $tag3; ?></a></button>
                                <?php
                            }
                            else if($tag1 && $tag2 && !$tag3){
                                ?>
                                <button><a href="#"><?php echo $tag1; ?></a></button>
                                <button><a href="#"><?php echo $tag2; ?></a></button>
                                <?php
                            }
                            else if($tag1 && !$tag2 && !$tag3){
                                ?>
                                <button><a href="#"><?php echo $tag1; ?></a></button>
                                <?php
                            }    
                            ?>
                        </div>
                    </div>
                    <div class="body">
                        <div class="content">
                            <p>
                                <?php echo $content ?>
                                <br><br>
                                CODE...
                            </p>
                        </div>

                        <div class="source">
                            <pre><code><?php echo $content_code ?></code></pre>
                        </div>
                        <div class="interaction">
                            <div class="heart">
                                <li><img src="https://drive.google.com/uc?id=1n90up3uN4-Xo51Q4-8ShMx4a7G6dRay4"></li>
                                <li><p><?php echo $vote ?></p></li>
                            </div>
                            <div class="cmt_share">
                              <li><?php include "count_comment.php" ?> Comments</li>
                            </div>
                        </div>

                        <!-- REACT TO ARTICLE -->
                        <?php
                            if(isset($_SESSION['account'])){
                        ?>
                        <div class="react">
                            <div class="react_like" id="likeBtn">
                                
                                
                                <form action="<?php 
                                                        
                                                        if($loginUser == null) echo "../login/login.php";
                                                        else {
                                                            echo "main.php?id=".$id."&page=".$page;
                                                        }
                                    
                                                    ?>" method="POST">
                                    <div style="margin:auto;">
                                        <input type="hidden" value="1" id="mainLike" name="mainLike">
                                        <input type="image" src="https://drive.google.com/uc?id=1tKFly_X-f7gISI3OU8ewrhIM74Eyc_v1">
                                        <button type="sumbit"><p <?php if($checkLike == true) echo 'style="color: green; font-weight: bold;"' ?> >Like</p></button>
                                    </div>
                                    </form>
                                    
                                <!--<li><p>Like</p></li>-->
                            </div>
                            <div class="react_cmt">
                                <a href="#yourCmt" style="text-decoration: none; color: black">
                                <li><img src="https://drive.google.com/uc?id=1GcUOLi1AKhQmCdRIaJ85IaO3yVhRGaY6"></li>
                                <li><p>Comment</p></li>
                                </a>
                            </div>
                            <div class="react_share">
                                <form action="<?php 
                                                    if($loginUser == null) echo "../login/login.php";
                                                    else {
                                                        echo "main.php?id=".$id."&page=".$page;
                                                    }
                                                ?>" method="POST">
                                <div style="margin:auto;">
                                    <input type="hidden" value="1" id="checkArticle" name="checkArticle">
                                <?php
                                    if($status == 1){
                                ?>    
                                    <input type="image" src="https://drive.google.com/uc?id=1NkMSJ_2iSV3BaaheIMIgOi9PsE7zNqA6">
                                <?php
                                    }
                                ?>
                                    <button type="sumbit"><p <?php if($status == 1) echo 'style="color: green; font-weight: bold;"' ?>>Check</p></button>
                                    </div>
                                    </form>
                                
                                
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
 
                    <div class="comment">
                            <div class="someone" id="cmt_frame">
                                <?php include "comment2.php" ?>
                            </div>
                            <!-- show the list of pages, each page includes $limit comments --> 
                            <div class="previous_cmt">
                                <a style="text-decoration: none; width: 50px;" href="<?php echo 'main.php?id='.$id.'&page='.(($page <= $pageCount - 1) ? ($page + 1) : $pageCount)?>#cmt_frame">>>></a>
                                <?php
                                    for($i = 1; $i <= $pageCount; $i ++){
                                        if($page == $i){
                                ?>
                                            <a href="<?php echo 'main.php?id='.$id.'&page='.$i?>#cmt_frame" style="background-color:#052d35"><?php echo $i;?></a>                                      
                                <?php
                                        } else{
                                ?>
                                            <a href="<?php echo 'main.php?id='.$id.'&page='.$i?>#cmt_frame" ><?php echo $i;?></a>
                                <?php
                                        }
                                    }
                                ?>
                                <a style="text-decoration: none; width: 50px;" href="<?php echo 'main.php?id='.$id.'&page='.(($page >= 2) ? ($page - 1) : 1)?>#cmt_frame"><<<</a>
                            </div> 
                        <div class="you" id="yourCmt">
                            <?php
                            if(isset($_SESSION['account'])){
                                ?>
                                <form method="POST" action="<?php 
                                                            
                                                            if($loginUser == null) echo "../login/login.php";
                                                            else {
                                                                echo htmlspecialchars("main.php?id=".$id."&page=".$page);
                                                            }
                                                        ?>">
                                <textarea placeholder="Say something" name="myComment"></textarea>
                                <button type="submit" class="button">Send</button>
                            </form>
                            
                                <?php
                            }
                            ?>
                            
                        </div>
                    </div>
  
                </div>
            </div>
            
            
        </div>
    </section>


    <script type="text/javascript">
        
        function Ask(){
            window.location.assign("../main_forum/Code/ask_question.php");
        }
        function Logout(){
            window.location.assign("../login/logout.php");
        }
        
        var show = false;
        var xmlHttpRequest;
        function ifClick(){
            if (show == false){
                //init();
                document.getElementById("modalWindow").hidden = false;
                show = true;
            }
            else {
                document.getElementById("modalWindow").hidden = true;
                show = false;
            }
            
        }

        /*
        function getXMLHttpRequest() {
            var request, err;
            try {
                request = new XMLHttpRequest();
            }
            catch (err) {
                try { // first attempt for Internet Explorer
                    request = new ActiveXObject("MSXML2.XMLHttp.6.0");
                }
                catch (err) {

                    try { // second attempt for Internet Explorer
                        request = new ActiveXObject("MSXML2.XMLHttp.3.0");
                    }
                    catch (err) {
                        request = false; // oops, can’t create one!
                    }
                }
            }
            return request;
        }

        function init(){
            xmlHttpRequest = getXMLHttpRequest();
            xmlHttpRequest.onreadystatechange = findInformation;
            xmlHttpRequest.open("GET", "get-notification.php", true);
            xmlHttpRequest.send(null);
        }

        function findInformation(){
            if (xmlHttpRequest.state != 4){
                return;
            } else {
                if(xmlHttpRequest.status != 200){
                    return;
                } else {
                    showNotification();
                }
            }
        }

        function showNofitication(){
            var xmlDoc = xmlHttpRequest.responseXML;
            var name = xmlDoc.getElementsByTagName("item");
            document.getElementById("name_noti").innerHTML = name.getElementsByTagName("name")[0].childNodes[0].nodeValue;
            document.getElementById("act_noti").innerHTML = name.getElementsByTagName("act")[0].childNodes[0].nodeValue;
            document.getElementById("title_noti").innerHTML = name.getElementsByTagName("title")[0].childNodes[0].nodeValue;
            document.getElementById("act_time_noti").innerHTML = name.getElementsByTagName("act_time")[0].childNodes[0].nodeValue;
        }

        */

    </script>
<?php $con->close(); ?>    
    </body>
</html>