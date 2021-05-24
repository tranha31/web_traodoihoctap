<?php session_start(); ?>
<html>
<head>
    <title>Web Trao đổi học tập</title>
    <meta charset="UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "header_footer.css">
    <link rel = "stylesheet" href = "home.css">
    
    <script language="javascript" src="index.js"></script>
</head>
<?php

if(isset($_GET['q'])){
    $query = $_GET['q'];
    $find = explode(' ', $query);
    $sql2 = "Select count(articles.id) as amount from articles where ";
    $sql = "Select * from articles where ";
    foreach($find as $key => $value){
        $sql = $sql."title like '%$value%' or ";
        $sql2 = $sql2."title like '%$value%' or ";
    }
    $sql = substr($sql, 0, -3);
    $sql2 = substr($sql2, 0, -3);
    
}
else{
    if(!empty($_POST['Search'])){
        $query = $_POST['Search'];
        $find = explode(' ', $query);
        $sql2 = "Select count(articles.id) as amount from articles where ";
        $sql = "Select * from articles where ";
        foreach($find as $key => $value){
            $sql = $sql."title like '%$value%' or ";
            $sql2 = $sql2."title like '%$value%' or ";
        }
        $sql = substr($sql, 0, -3);
        $sql2 = substr($sql2, 0, -3);
       
    }
    else{
        $query = "";
        $sql2 = "Select count(articles.id) as amount from articles where title like '%%'";
        $sql = "Select * from articles where title like '%%'";
        
    }
    
}

?>
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
                    <input type="text" name="Search" class="search" id="S" value="<?php echo $query;?>" placeholder="Filter questions">
                    <img src="https://drive.google.com/uc?id=1ad0H9BfqS_MXpJEyhwymLbsO-gioXzE7">
                    <div id="search_ajax">
                        <div id="list">
                        </div>
                    </div>
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
            
            $conn = mysqli_connect("localhost", "root","", "projectweb20202");
            if(!$conn){
                die("Connection failed: " . mysqli_connect_error());
            }
            else{
                $result = mysqli_query($conn, $sql2, null);
                if(mysqli_num_rows($result)>0){
                    $row =  mysqli_fetch_assoc($result);
                    $total_rows = $row["amount"];
                }
                else{
                    $total_rows = 0;
                }
                
                $total_pages = ceil($total_rows / $no_per_page);
                
                $sql = $sql." ORDER BY articles.publish_date DESC limit $start,$no_per_page";
                $artical = mysqli_query($conn, $sql, null);
            }
                
            
        ?>
        
        
            <div class="Link">
                <div class="link1">
                    <div id="home" onclick="Home()">
                        <p>Home</p>
                        <div id="b1" class="bb" ></div>
                    </div>
                    <div id="Public"><p>PUBLIC<p><img src="../Picture/globe.png"></div>
                    <div id="question" onclick="Question()" style="background-color: #FFD7D8;">
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
            <div class="vertical"></div>
            <div class="content">
                
                <div class="title">
                    
                <div class="title_b_ask">
                    <p>Search Results</p>
                    <button id="ask_qs" onclick="Ask()">Ask Question</button>
                </div>
                <div class="display">
                    <p><?php echo $total_rows; ?> results</p>
                </div>
                </div>
                <div class="row"></div>
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
                        <p><?php echo $row['vote']; ?></p>
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
                        ?>
                <div class="linkP" style="margin-left:15px; margin-top:5px; display:flex">
                    <?php 
                    echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='search.php?page=1&q=$query'>"."First"."</a>";
                    if($page <= 1){
                            echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href=#>Prev</a>";
                    }
                    else{
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='search.php?page=".($page-1)."&q=$query'>"."Prev"."</a>";
                    }
                    
                    if($total_pages <= 4){    
                        for($i=1; $i<=$total_pages; $i++){
                            echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='search.php?page=".$i."&q=$query'>".$i."</a>";
                        }
                        
                    }
                    else{
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='search.php?page=1&q=$query'>1</a>";
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='search.php?page=2&q=$query'>2</a>";
                        echo "...";
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='search.php?page=".($total_pages-1)."&q=$query'>".($total_pages-1)."</a>";
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='search.php?page=".$total_pages."&q=$query'>".$total_pages."</a>";
                    }
                    if($page >= $total_pages){
                            echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href=#>Next</a>";
                    }
                    else{
                        echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='search.php?page=".($page+1)."&q=$query'>"."Next"."</a>";
                    }
                    
                    echo "<a style=\"margin-left:5px; margin-right:5px; display:block; position: relative; z-index:7;\"  href='search.php?page=".$total_pages."&q=$query'>"."Last"."</a>";
                    ?>
                </div>
                        <?php
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
                    <p>Top Users</p>
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
                            <p><?php echo $row["numberofheart"]?></p>
                            <p>votes</p>
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
        window.location.assign("home.php");
    }
    function Unvote(){
        window.location.assign("home.php?status=uv");
    }
    function Uncmt(){
        window.location.assign("home.php?status=ucmt");
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


</html>