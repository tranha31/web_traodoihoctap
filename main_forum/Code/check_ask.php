<?php session_start() ?>
<html>
    <head>
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link rel = "stylesheet" href = "check_ask.css">
        
    </head>
    <body>
        
   
<?php 
    if(isset($_SESSION['account'])){
        $account = $_SESSION["account"];
    }
    else{
        $account = "";
    }

    if($account == ""){
        ?>
            <div class="center popup">
                <img src="../Picture/warning.png">
                <p>You must login first</p>
                <p>Please comeback and try again</p>
                <button id="dismiss" onclick="Dismiss()">OK</button>
            </div>
            <script>
                document.getElementsByClassName("popup")[0].classList.add("active");
            </script>
            <script>
                function Dismiss(){
                    window.location.assign("home.php");
                }
            </script>
        <?php
    }
    else{
        
    
    
    if($_POST['title'] == ""){
        ?>
            <div class="center popup">
                <img src="../Picture/warning.png">
                <p>You must enter title</p>
                <p>Please comeback and try again</p>
                <button id="dismiss" onclick="Dismiss()">OK</button>
            </div>
            <script>
                document.getElementsByClassName("popup")[0].classList.add("active");
            </script>
            <script>
                function Dismiss(){
                    window.location.assign("ask_question.php");
                }
            </script>
        <?php
        
    }
    else if($_POST['content1'] == ""){
        ?>
            <div class ="center popup">
                <img src="../Picture/warning.png">
                <p>You must enter content</p>
                <p>Please comeback and try again</p>
                <button id="dismiss" onclick="Dismiss()">OK</button>
            </div>
            <script>
                document.getElementsByClassName("popup")[0].classList.add("active");
            </script>
            <script>
                function Dismiss(){
                    window.location.assign("ask_question.php";?>");
                }
            </script>
        <?php
        
    }
    else{
        $conn = mysqli_connect("localhost", "root","", "projectweb20202");
        
        $id = $_POST['id'];
        $title = $_POST["title"];
        $content = $_POST["content1"];
        $tag = $_POST['tag'];
        if($tag != ""){
            $tags = explode(' ', $tag);
            if(count($tags) == 1){
                $tag1 = $tags[0];
                $tag2 = "";
                $tag3 = "";
            }
            else if(count($tags) == 2){
                $tag1 = $tags[0];
                $tag2 = $tags[1];
                $tag3 = "";
            }
            else if(count($tags) == 3){
                $tag1 = $tags[0];
                $tag2 = $tags[1];
                $tag3 = $tags[2];
            }
            else{
                ?>
            <div class="center popup">
                <img src="../Picture/warning.png">
                <p>You enter too many tags</p>
                <p>Please comeback and try again</p>
                <button id="dismiss" onclick="Dismiss()">OK</button>
            </div>
            <script>
                document.getElementsByClassName("popup")[0].classList.add("active");
            </script>
            <script>
                function Dismiss(){
                    window.location.assign("ask_question.php");
                }
            </script>
        <?php
            }
        }
        else{
            $tag1 = "";
            $tag2 = "";
            $tag3 = "";
        }
        if($_POST['content2'] != ""){
            $content_code = $_POST['content2'];
        }
        else{
            $content_code = "";
        }
        $pb_date = date("Y-m-d");
        
        $content = addslashes($content);
        $content = htmlspecialchars(htmlentities($content));
        
        if($content_code != ""){
            $content_code = addslashes($content_code);
            $content_code = htmlspecialchars(htmlentities($content_code));
        }
        if($id == ""){
            $sql = "Insert into articles(account, title, content, content_code, vote, publish_date, status, tag1, tag2, tag3) values ('$account','$title','$content','$content_code',0,'$pb_date',0,'$tag1', '$tag2', '$tag3')";
        
            mysqli_query($conn, $sql, null);
        
            $sql = "update account_infor set numberofpost = numberofpost+1 where account = '$account'";
            mysqli_query($conn, $sql, null);
        
            $sql = "select * from articles where account = '$account' and publish_date = '$pb_date'";
            $result = mysqli_query($conn, $sql, null);
            $row =  mysqli_fetch_assoc($result);
            $id1 = $row['id'];
        
        
            $sql = "Insert into account_activity(account1, activity, account2, linkpost, shortcontent, datetime) values ('$account','post question','$account','http://localhost/web_traodoihoctap/articles/main2.php?id=$id1','$title','$pb_date')";
            mysqli_query($conn, $sql, null);
        
            if($tag1 != ""){
                $sql = "select * from tags where tag = '$tag1'";
                $result = mysqli_query($conn, $sql, null);
                if(mysqli_num_rows($result)==0){
                    $sql = "insert into tags(tag) values('$tag1')";
                    mysqli_query($conn, $sql, null);
                }
            }
            if($tag2 != ""){
                $sql = "select * from tags where tag = '$tag2'";
                $result = mysqli_query($conn, $sql, null);
                if(mysqli_num_rows($result)==0){
                    $sql = "insert into tags(tag) values('$tag2')";
                    mysqli_query($conn, $sql, null);
                }
            }
            if($tag3 != ""){
                $sql = "select * from tags where tag = '$tag3'";
                $result = mysqli_query($conn, $sql, null);
                if(mysqli_num_rows($result)==0){
                    $sql = "insert into tags(tag) values('$tag3')";
                    mysqli_query($conn, $sql, null);
                }
            }
            ?>
                <div class ="center popup">
                    <img src="../Picture/check.png">
                    <p>Success</p>
                    <p>Please continue to ask more questions for the forum to develop</p>
                    <button id="dismiss" onclick="Dismiss()">OK</button>
                </div>
                <script>
                    document.getElementsByClassName("popup")[0].classList.add("active");
                </script>
                <script>
                    function Dismiss(){
                        window.location.assign("ask_question.php");
                    }
                </script>
            <?php
        }
        else{
            
            $sql = "update articles set title = '$title', content = '$content', content_code = '$content_code', tag1 = '$tag1', tag2 = '$tag2', tag3 = '$tag3' where id = $id";
            mysqli_query($conn, $sql, null);
            
            $sql = "Insert into account_activity(account1, activity, account2, linkpost, shortcontent, datetime) values ('$account','edit question','$account','http://localhost/web_traodoihoctap/articles/main2.php?id=$id','$title','$pb_date')";
            mysqli_query($conn, $sql, null);
            
            ?>
                <div class ="center popup">
                    <img src="../Picture/check.png">
                    <p>Success</p>
                    <p>Please continue to ask more questions for the forum to develop</p>
                    <button id="dismiss" onclick="Dismiss()">OK</button>
                </div>
                <script>
                    document.getElementsByClassName("popup")[0].classList.add("active");
                </script>
                <script>
                    function Dismiss(){
                        window.location.assign("../../articles/main.php?id=<?php echo $id;?>");
                    }
                </script>
            <?php
        }
        
        }
    }
?>
    </body>
</html>   


