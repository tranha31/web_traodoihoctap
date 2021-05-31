<?php 
session_start(); 
if(isset($_POST['tag'])){
    $t = $_POST['tag'];
}
else{
    $t = $_GET['tag'];
}
?>
<html>
<head>
    <title>Web Trao đổi học tập</title>
    <meta charset="UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "header_footer.css">
    <link rel = "stylesheet" href = "home.css">
    <link rel = "stylesheet" href = "tag.css">
    
   
</head>
<body>
    <section>
        <div class="header">
            <div>
                <div class="header_icon">
                    <li><img class="logo" src="https://drive.google.com/uc?id=1ucMaE2s1IhOArdjLHNGm_FdcX6-cSrfw"></li>
                    <li><a href="home.php" class="home_icon"><img src="https://drive.google.com/uc?id=1Mo5BQY2veciStLc_MXRvJV1GTdL7HGnB"></a></li>
                    <li><a href="forum.php" class="forum_icon"><img src="https://drive.google.com/uc?id=1fNJVt5H7d7eDxWng7Fi4R5PaMO96HaAC"></a></li>
                </div>
                <form class="search_area" method="post" action="search.php">
                    <input type="text" name="Search" class="search" id="S" placeholder="Filter questions">
                    <img src="https://drive.google.com/uc?id=1ad0H9BfqS_MXpJEyhwymLbsO-gioXzE7">
                    
                </form>
                
            </div>
            
            <div>
                <?php 
                    $conn = mysqli_connect("localhost", "root","", "projectweb20202");
                    if(isset($_SESSION['account'])){
                        $u = $_SESSION['account'];
                        echo "<div class=\"account\">
                        <a href=\"../../information/account_infor.php\" class=\"forum_icon\"><img src=\"../Picture/tk.png\"></a>
                        <a href=\"../../login/logout.php\" class=\"forum_icon\"><img src=\"../Picture/logout.png\"></a>";
                    }
                    else{
                        echo "<div class=\"login\"><button onclick=Login()>Login</button></div>";
                    }
                ?>
                
            </div>
            
        </div>
        
        
    </section>
    <div id="search_ajax">
                        <div id="list">
                        </div>
                    </div>
    <div class = "main1">
        <?php 
    
            if(isset($_GET["page"])){
                $page = $_GET["page"];
            }
            else{
                $page = 1;
            }
            $no_per_page = 10;
            $start = ($page-1)*$no_per_page;
            
            $status;
            if(!isset($_GET["status"])){
                $status = 0;
            }
            else if($_GET['status'] == "uv"){
                $status = 1;
            }
            else if($_GET['status'] == "ucmt"){
                $status = 2;
            }
            
            $conn = mysqli_connect("localhost", "root","", "projectweb20202");
            if(!$conn){
                die("Connection failed: " . mysqli_connect_error());
            }
            else{
                $artical;
                if($status == 0){
                    $sql = "SELECT COUNT(articles.id) AS total FROM articles where (tag1 like '%$t%') or (tag2 like '%$t%') or (tag3 like '%$t%') ";
                    $result = mysqli_query($conn, $sql, null);
                    $row =  mysqli_fetch_assoc($result);
                    $total_rows = $row["total"];
                    $total_pages = ceil($total_rows / $no_per_page);
                    
                    $sql = "SELECT * FROM articles where (tag1 like '%$t%') or (tag2 like '%$t%') or (tag3 like '%$t%') ORDER BY articles.publish_date DESC limit $start,$no_per_page";
                    $artical = mysqli_query($conn, $sql, null);
                   
                }
                else if($status == 1){
                    $sql = "SELECT COUNT(articles.id) AS total FROM articles WHERE articles.vote = 0 and ((tag1 like '%$t%') or (tag2 like '%$t%') or (tag3 like '%$t%'))";
                    $result = mysqli_query($conn, $sql, null);
                    $row =  mysqli_fetch_assoc($result);
                    $total_rows = $row["total"];
                    $total_pages = ceil($total_rows / $no_per_page);
                    
                    $sql = "SELECT * FROM articles WHERE articles.vote = 0 and ((tag1 like '%$t%') or (tag2 like '%$t%') or (tag3 like '%$t%')) ORDER BY articles.publish_date DESC limit $start,$no_per_page";
                    $artical = mysqli_query($conn, $sql, null);
                }
                else if($status == 2){
                    $sql = "SELECT COUNT(articles.id) AS total FROM articles 
WHERE articles.id not in (SELECT comments.id FROM comments) and ((tag1 like '%$t%') or (tag2 like '%$t%') or (tag3 like '%$t%'))";
                    $result = mysqli_query($conn, $sql, null);
                    $row =  mysqli_fetch_assoc($result);
                    $total_rows = $row["total"];
                    $total_pages = ceil($total_rows / $no_per_page);
                    
                    $sql = "SELECT * FROM articles WHERE articles.id not in (SELECT comments.id FROM comments) and ((tag1 like '%$t%') or (tag2 like '%$t%') or (tag3 like '%$t%')) ORDER BY articles.publish_date DESC limit $start,$no_per_page";
                    $artical = mysqli_query($conn, $sql, null);
                }
                
            }
        ?>
        
            <div class="Link">
                <div class="link1">
                    <div id="home" onclick="Home()">
                        <p>Home</p>
                        <div id="b1" class="bb" ></div>
                    </div>
                    <div id="Public"><p>PUBLIC<p><img src="../Picture/globe.png"></div>
                    <div id="question" style="background-color: #FFD7D8;" onclick="Question()">
                        <p>Questions</p>
                        <div id="b2" class="bb" style="background-color:pink"></div>
                    </div>
                    <div id="Users" onclick="Users()">
                        <p>Users</p>
                        <div id="b3" class="bb"></div>
                    </div>
                    <div id="Game" onclick="Game()">
                        <p>Game</p>
                        <div id="b4" class="bb"></div>
                    </div>
                    <div id="YouTube" onclick="YouTube()">
                        <p>YouTube</p>
                        <div id="b5" class="bb"></div>
                    </div>
                    
                    <img class="icon1" src="../Picture/picture1.png">
                    <img class="icon1" src="../Picture/picture2.png">
                    <img class="icon1" src="../Picture/picture3.png">
                </div>
                 
            </div>
           
            <div class="content">
                
                <div class="title">
                    
                <div class="title_b_ask">
                    <p>The all questions</p>
                    <button id="ask_qs" onclick="Ask()">Ask Question</button>
                </div>
                <div class="display">
                    <p><?php echo $total_rows; ?> questions</p>
                    
                    <div class="d_button">
                        <button id="All" onclick="All()">All</button>
                        <button id="Unvote" onclick="Unvote()">Unvoted</button>
                        <button id="Uncmt" onclick="Uncmt()">Unanswered</button>
                    </div>
                    
                </div>
                </div>
                <div class="row"></div>
                <div id="tag">
                    <form method="post" action="tag.php">
                        <input id="stag" type="text" name="tag" placeholder="Filter tags">
                    </form>
                </div>
                <div id="ajax_tag">
                    <div id="List1"></div>
                </div>
                
                <?php
                if(mysqli_num_rows($artical)>0){
                    
                
                while($row = mysqli_fetch_assoc($artical)){
                    $id = $row["id"];
                    $sql = "SELECT COUNT(comments.id) AS T FROM comments WHERE comments.id = $id";
                    $result = mysqli_query($conn, $sql, null);
                    $row1 =  mysqli_fetch_assoc($result);
                    $cmts = $row1["T"];
                    $ava = rand(1,2);
                    
                    ?>
                <div class="content_qs">
                    <div class="count">
                        <?php
                        $sqlLikes = "select count(*) from likes where id_article = ".$id;
                        $result = $conn->query($sqlLikes);
                        if(!empty($result) && $result->num_rows > 0){
                            $vote = $result->fetch_assoc()['count(*)'];
                        } else {
                            $vote = 0;
                        }      
                        ?>
                        <p><?php echo $vote; ?></p>
                        <p>votes</p>
                        <p><?php echo $cmts; ?></p>
                        <p>answers</p>
                    </div>
                    <div class="c_qs">
                        <a href="../../articles/main.php?id=<?php echo $id; ?>"><?php echo $row["title"]; ?></a>
                        <div class="p_p">
                            <?php echo $row["content"]; ?>
                        </div>
                    </div>
                    
                </div>
                <?php
                $tag1 = $row['tag1'];
                $tag2 = $row['tag2'];
                $tag3 = $row['tag3'];
                if($tag1 && $tag2 && $tag3){
                    ?>
                    <button class="tag"><a href="tag.php?tag=<?php echo $tag1;?>"><?php echo $tag1; ?></a></button>
                    <button class="tag"><a href="tag.php?tag=<?php echo $tag2;?>"><?php echo $tag2; ?></a></button>
                    <button class="tag"><a href="tag.php?tag=<?php echo $tag3;?>"><?php echo $tag3; ?></a></button>
                    <?php
                }
                else if($tag1 && $tag2 && !$tag3){
                    ?>
                    <button class="tag"><a href="tag.php?tag=<?php echo $tag1;?>"><?php echo $tag1; ?></a></button>
                    <button class="tag"><a href="tag.php?tag=<?php echo $tag2;?>"><?php echo $tag2; ?></a></button>
                    <?php
                }
                else if($tag1 && !$tag2 && !$tag3){
                    ?>
                    <button class="tag"><a href="tag.php?tag=<?php echo $tag1;?>"><?php echo $tag1; ?></a></button>
                    <?php
                }    
                
                ?>
                <div class="questioner">
                    <img src="<?php echo "../Picture/user".$ava.".png"; ?>">
                    <a href="../../header_footer/ValidUser.php?account=<?php echo $row['account']; ?>"><?php echo $row['account']; ?></a>
                </div>
                <div class="row"></div>
                    
                    <?php
                }
                }
                ?>
                
                <?php 
                    if($total_pages > 1){
                        if($status == 0){
                            ?>
                <div class="linkP" style="margin-left:15px; margin-top:5px; display:flex;">
                    <?php 
                    echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\" href='tag.php?page=1&tag=$t'>"."First"."</a>";
                    if($page <= 1){
                            echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href=#>Prev</a>";
                    }
                    else{
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".($page-1)."&tag=$t'>"."Prev"."</a>";
                    }
                    
                    if($total_pages <= 4){    
                        for($i=1; $i<=$total_pages; $i++){
                            echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".$i."&tag=$t'>".$i."</a>";
                        }
                        
                    }
                    else{
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\" href='tag.php?page=1&tag=$t'>1</a>";
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='forum.php?page=2'>2</a>";
                        echo "...";
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".($total_pages-1)."&tag=$t'>".($total_pages-1)."</a>";
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".$total_pages."&tag=$t'>".$total_pages."</a>";
                    }
                    if($page >= $total_pages){
                            echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href=#>Next</a>";
                    }
                    else{
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".($page+1)."&tag=$t'>"."Next"."</a>";
                    }
                    
                    echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".$total_pages."&tag=$t'>"."Last"."</a>";
                    ?>
                </div>
                            <?php
                        }
                        else if($status == 1){
                            ?>
                <div class="linkP" style="margin-left:15px; margin-top:5px; display:flex;">
                    <?php 
                    echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=1&status=uv&tag=$t'>"."First"."</a>";
                    if($page <= 1){
                            echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href=#>Prev</a>";
                    }
                    else{
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".($page-1)."&status=uv&tag=$t'>"."Prev"."</a>";
                    }
                    
                    if($total_pages <= 4){    
                        for($i=1; $i<=$total_pages; $i++){
                            echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".$i."&status=uv&tag=$t'>".$i."</a>";
                        }
                        
                    }
                    else{
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=1&status=uv&tag=$t'>1</a>";
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=2&status=uv&tag=$t'>2</a>";
                        echo "...";
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".($total_pages-1)."&status=uv&tag=$t'>".($total_pages-1)."</a>";
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".$total_pages."&status=uv&tag=$t'>".$total_pages."</a>";
                    }
                    if($page >= $total_pages){
                            echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href=#>Next</a>";
                    }
                    else{
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".($page+1)."&status=uv&tag=$t'>"."Next"."</a>";
                    }
                    
                    echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".$total_pages."&status=uv&tag=$t'>"."Last"."</a>";
                    ?>
                </div>
                            <?php
                        }
                        else if($status == 2){
                            ?>
                <div class="linkP" style="margin-left:15px; margin-top:5px; display:flex;">
                    <?php 
                    echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=1&status=ucmt&tag=$t'>"."First"."</a>";
                    if($page <= 1){
                            echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href=#>Prev</a>";
                    }
                    else{
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".($page-1)."&status=ucmt&tag=$t'>"."Prev"."</a>";
                    }
                    
                    if($total_pages <= 4){    
                        for($i=1; $i<=$total_pages; $i++){
                            echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".$i."&status=ucmt&tag=$t'>".$i."</a>";
                        }
                        
                    }
                    else{
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=1&status=ucmt&tag=$t'>1</a>";
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=2&status=ucmt&tag=$t'>2</a>";
                        echo "...";
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".($total_pages-1)."&status=ucmt&tag=$t'>".($total_pages-1)."</a>";
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".$total_pages."&status=ucmt&tag=$t'>".$total_pages."</a>";
                    }
                    if($page >= $total_pages){
                            echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href=#>Next</a>";
                    }
                    else{
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".($page+1)."&status=ucmt&tag=$t'>"."Next"."</a>";
                    }
                    
                    echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='tag.php?page=".$total_pages."&status=ucmt&tag=$t'>"."Last"."</a>";
                    ?>
                </div>
                            <?php
                        }
                    }
                ?>
                
            </div>
            <div class = "top">
            <div class="top_ask_qs">
                <div class="top_header">
                    <p>Top Questions</p>
                    <img src="https://media.giphy.com/media/j5u1H5WRzZGoxQknj1/source.gif">
                </div>
                <div class="list_top_qs">
                    <?php
                    
                    $sql = "Select * from articles order by vote desc limit 10";
                    $result = mysqli_query($conn, $sql, null);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                    <div class="content_t_qs">
                        <div class="vote">
                            <p><?php echo $row['vote']; ?></p>
                            <p>votes</p>
                        </div>
                        <div class="content2">
                            <a class="tt" href="../../articles/main.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                            
                        </div>
                    </div>
                    <hr>
                            <?php
                        }
                    }
                        
                    ?>
                </div>
            </div>
                
            <div class="top_ask_qs">
                <div class="top_header">
                    <p>Top Members</p>
                    <img src="https://media.giphy.com/media/oVouQovpspyNqO3mhW/source.gif">
                </div>
                <div class="list_top_qs">
                    <?php
                    $sql = "SELECT * FROM account_infor ORDER BY account_infor.numberofpost DESC limit 10";
                    $result = mysqli_query($conn, $sql, null);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                    <div class="content_t_qs">
                        <div class="vote">
                            
                        </div>
                        <div class="content2">
                            <a href="../../header_footer/ValidUser.php?account=<?php echo $row['account']; ?>"><?php echo $row['account']; ?></a>
                            <p>Number of post: <?php echo $row["numberofpost"];?></p>
                        </div>
                    </div>
                    <hr>
                            <?php
                        }
                    }
                    ?>
                    
                </div>
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
    <section>
        <div class = "footer">
            <div>
                <p>@Copyright Nhóm 8 lớp Web mã lớp 124205</p>
            </div>
            <div>
                <button href="#">About us</button>
            </div>
        </div>
    </section>
    
</body>
    
<?php 
if($status == 0){
    echo "
    <script>
        document.getElementById(\"All\").style.backgroundColor = \"#ded8d8\";
    </script>
    ";
}
else if($status == 1){
    echo "
    <script>
        document.getElementById(\"Unvote\").style.backgroundColor = \"#ded8d8\";
    </script>
    ";
}
else if($status == 2){
    echo "
    <script>
        document.getElementById(\"Uncmt\").style.backgroundColor = \"#ded8d8\";
    </script>
    ";
}
    
?>
<?php include("notification.php"); ?>
<script>
    
    function Login(){
        window.location.assign("../../login/login.php");
    }
    function Logout(){
        window.location.assign("../../login/logout.php");
    }
    function Home(){
        window.location.assign("home.php");
    }
    function Question(){
        window.location.assign("forum.php");
    }
    function Users(){
        window.location.assign("Users.php");
    }
    function Game(){
        alert("You must disconnect internet to play game!");
        window.location.assign("https://www.google.com");
    }
    function YouTube(){
        window.location.assign("https://www.youtube.com");
    }
    function Ask(){
        window.location.assign("ask_question.php");
    }
    
    function All(){
        window.location.assign("tag.php?tag=<?php echo $t;?>");
    }
    function Unvote(){
        window.location.assign("tag.php?status=uv&tag=<?php echo $t;?>");
    }
    function Uncmt(){
        window.location.assign("tag.php?status=ucmt&tag=<?php echo $t;?>");
    }
    
</script>
<script type="text/javascript">
    var show = false;
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
    
        var t;
        function startSearch(){
            if(t) window.clearTimeout(t);
            t = window.setTimeout("liveSearch()", 200);
        }
        function getXMLHttpRequest()

        {
            var request, err;
            try {
                request = new XMLHttpRequest(); 
            }
            catch(err) {
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
        
        function liveSearch()
        
        {
            ajaxRequest = getXMLHttpRequest();
            if (!ajaxRequest) alert("Request error!");
            var myURL = "Search_Q.php";
            var query = document.getElementById("S").value;
            
            myURL = myURL + "?query=" + query;
            console.log(myURL);
            ajaxRequest.onreadystatechange = ajaxResponse;
            ajaxRequest.open("GET", myURL);
            ajaxRequest.send(null);
        }
        function ajaxResponse() 
        {
            console.log("00000");
            
            if (ajaxRequest.readyState != 4) 
            { return; }
            else {
                if (ajaxRequest.status == 200) 
                {
                   console.log("11111");
                    var i, n, li, t;
                    var ul = document.getElementById("list");
                    var div = document.getElementById("search_ajax");
                    div.removeChild(ul); 
                    ul = document.createElement("div");
                    ul.id="list";
                    div.style.display = "flex";
                    ul.style.display = "flex";
                    ul.style.flexDirection = "column";
                    console.log(ajaxRequest.responseXML);
                    names=ajaxRequest.responseXML.getElementsByTagName("name");
                    ids = ajaxRequest.responseXML.getElementsByTagName("id");
                    for (i = 0; i < names.length; i++)
                    {
                        a = document.createElement("a");  
                        n = names[i].firstChild.nodeValue;
                        ID = ids[i].firstChild.nodeValue;
                        link = "../../articles/main.php?id="+ID;
                        a.setAttribute('href', link);
                        
                        a.innerHTML = n;
                        
                        ul.appendChild(a);
                    }
                    if (names.length == 0) { 
                        div.style.display = "none";
                    }
                    div.appendChild(ul);
                    
                }
                else {
                    alert("Request failed: " + ajaxRequest.statusText);
                }
            }
        }
        
        var obj = document.getElementById("S");
        obj.onkeydown = startSearch;
</script>
<script>
        var g;
        function startSearch1(){
            if(g) window.clearTimeout(g);
            g = window.setTimeout("liveSearch1()", 200);
        }
        
        
        function liveSearch1()
        
        {
            ajaxRequest = getXMLHttpRequest();
            if (!ajaxRequest) alert("Request error!");
            var myURL = "ajax_tag.php";
            var query = document.getElementById("stag").value;
            
            myURL = myURL + "?query=" + query;
            console.log(myURL);
            ajaxRequest.onreadystatechange = ajaxResponse;
            ajaxRequest.open("GET", myURL);
            ajaxRequest.send(null);
        }
        function ajaxResponse() 
        {
            
            
            if (ajaxRequest.readyState != 4) 
            { return; }
            else {
                if (ajaxRequest.status == 200) 
                {
                   
                    var i, n, li, t;
                    var ul = document.getElementById("List1");
                    var div = document.getElementById("ajax_tag");
                    div.removeChild(ul); 
                    ul = document.createElement("div");
                    ul.id="List1";
                    div.style.display = "flex";
                    console.log(ajaxRequest.responseXML);
                    tags=ajaxRequest.responseXML.getElementsByTagName("tag");
                    
                    for (i = 0; i < tags.length; i++)
                    {
                        a = document.createElement("a");  
                        
                        tag = tags[i].firstChild.nodeValue;
                        link = "tag.php?tag="+tag;
                        a.setAttribute('href', link);
                        
                        a.innerHTML = tag;
                        
                        ul.appendChild(a);
                    }
                    if (tags.length == 0) { 
                        div.style.display = "none";
                    }
                    div.appendChild(ul);
                    
                }
                else {
                    alert("Request failed: " + ajaxRequest.statusText);
                }
            }
        }
        
        var obj = document.getElementById("stag");
        obj.onkeydown = startSearch1;

</script>

</html>