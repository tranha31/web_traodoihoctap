<?php include  "includes/header.php" ?>  
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

    displayEdit = 0;
    function showFormEditComment(formEditId){
        if(displayEdit == 0 )
        {
            document.getElementById(formEditId).hidden = false;
            displayEdit = 1;
        }
        else
        {
            document.getElementById(formEditId).hidden = true;
            displayEdit = 0;
        }
    }
</script>

    <section>
        <div class = "main">
            <div id="left">
                <div class="up" onclick="Ask()">
                    <h2 style="text-align: center;">Ask Questions</h2>
                </div>
                <div class="middle">
                    <div class="title">
                        <div class="name">
                            <?php
                            if(isset($_SESSION['account'])){
                                if($account == $_SESSION['account']){
                                    echo "<img src=\"../main_forum/Picture/edit.png\" onclick=\"Edit()\">";
                                }
                            }
                            
                            ?>
                            
                            <h2>
                                <?php echo $title ?>
                            </h2>
                            
                        </div>
                        <div class="moreinfo">
                            
                            <h5><pre>Asked: <?php echo $publish_date ?></pre></h5>
                            <h5><a href="../information/account_infor.php?account=<?php echo $account;?>">Asked by: <?php echo $account; ?></a></h5><br>
                            <?php
                            if($tag1 && $tag2 && $tag3){
                                ?>
                                <button><a href="../main_forum/Code/tag.php?tag=<?php echo $tag1;?>"><?php echo $tag1; ?></a></button>
                                <button><a href="../main_forum/Code/tag.php?tag=<?php echo $tag2;?>"><?php echo $tag2; ?></a></button>
                                <button><a href="../main_forum/Code/tag.php?tag=<?php echo $tag3;?>"><?php echo $tag3; ?></a></button>
                                <?php
                            }
                            else if($tag1 && $tag2 && !$tag3){
                                ?>
                                <button><a href="../main_forum/Code/tag.php?tag=<?php echo $tag1;?>"><?php echo $tag1; ?></a></button>
                                <button><a href="../main_forum/Code/tag.php?tag=<?php echo $tag2;?>"><?php echo $tag2; ?></a></button>
                                <?php
                            }
                            else if($tag1 && !$tag2 && !$tag3){
                                ?>
                                <button><a href="../main_forum/Code/tag.php?tag=<?php echo $tag1;?>"><?php echo $tag1; ?></a></button>
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
                        <div class="react">
                            <div class="react_like" id="likeBtn" style="z-index:5; position:relative;">
                                    <form action="<?php 
                                                        
                                                        if($loginUser == null) echo "../login/login.php";
                                                        else {
                                                            echo "main.php?id=".$id."&page=".$page;
                                                        }
                                    
                                                    ?>" method="POST">
                                        <div style="margin:auto;">
                                            <input type="hidden" value="1" id="mainLike" name="mainLike">
                                            <?php
                                            if($checkLike == 0){
                                            ?>    
                                                <input type="image" src="https://drive.google.com/uc?id=1tKFly_X-f7gISI3OU8ewrhIM74Eyc_v1">
                                            <?php
                                            } else if ($checkLike == 1){
                                            ?>
                                                <input type="image" src="https://drive.google.com/uc?id=1DAlONvT1CmZgPNNbEPzPaZavqs8dvWf4">
                                
                                            <?php
                                            }
                                            ?>
                                            <button type="sumbit"><p <?php if($checkLike == true) echo 'style="color: blue; font-weight: bold;"' ?> >Like</p></button>
                                        </div>
                                    </form>
                            </div>
                            
                            <div class="react_cmt" style="z-index:5; position:relative;">
                                <a href="#yourCmt" style="text-decoration: none; color: black">
                                <li><img src="https://drive.google.com/uc?id=1GcUOLi1AKhQmCdRIaJ85IaO3yVhRGaY6"></li>
                                <li><p>Comment</p></li>
                                </a>
                            </div>
                            <?php if($checkAdmin == 1){ ?>
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
                                    if($status == 0){
                                ?>    
                                    <input type="image" src="https://drive.google.com/uc?id=1NkMSJ_2iSV3BaaheIMIgOi9PsE7zNqA6">
                                <?php
                                    } else if ($status == 1){
                                ?>
                                    <input type="image" src="https://drive.google.com/uc?id=1epPJLo1lFgvu3HX2u3ACIMJZNdqI1ZvP">
                                
                                <?php
                                    }
                                ?>
                                    <button type="sumbit"><p <?php if($status == 1) echo 'style="color: green; font-weight: bold;"' ?>>Check</p></button>
                                    </div>
                                    </form>
                            </div>
                            <?php  }  ?>
                        </div>
                    </div>
 
                    <div class="comment">
                            <div class="someone" id="cmt_frame">
                                <?php include "comment.php" ?>
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
                            <form method="POST" action="<?php 
                                                            
                                                            if($loginUser == null) echo "../login/login.php";
                                                            else {
                                                                echo htmlspecialchars("main.php?id=".$id."&page=".$page);
                                                            }
                                                        ?>">
                                <textarea placeholder="Say something" name="myComment"></textarea>
                                <button type="submit" class="button">Send</button>
                            </form>
                        </div>
                    </div>
  
                </div>
            </div>
            <div id="right">
                <div class="ask" onclick="Ask()">
                    <h1>Ask Questions</h1>
                </div>
                <div class="top10">
                    <h3>Top 10 interesting articles</h3>
                    <div class="top10_data">
                        <?php include "top10_article.php" ?>                   
                    </div>
                </div>
                <div class="top10">
                    <h3>Top 10 members</h3>
                    <div class="top10_data">
                        <?php include "top10_user.php" ?>               
                    </div>
                </div>
            </div>

            <div class="notification" id="notifi">
                <div class="modalWindow" id="modalWindow" hidden>
                    
                </div>
                <div class="down">
                    <div class="my-float">
                        <button id="notificationBtn" onclick="ifClick()"><img src="https://drive.google.com/uc?id=1Co_0F0xYuTAyVrnrGbOKGVO3k7UA8fQc">
                        <h1 id="no" style="margin-top:-85px; font-size:35px; color:red; display:none">!</h1>
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

<?php include "notification.php" ?>
    <script type="text/javascript">
        function Edit(){
            window.location.assign("../main_forum/Code/ask_question.php?id=<?php echo $id;?>");
        }
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