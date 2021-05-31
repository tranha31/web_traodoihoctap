<?php session_start();?>

<html>
<head>
    <title>Web Trao đổi học tập</title>
    <meta charset="UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "header_footer.css">
    <link rel= "stylesheet" href= "ask_question.css">
    
    
   
</head>
    <?php 
        if(isset($_SESSION["account"])){
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
                    window.location.assign("../../login/login.php");
                }
            </script>
        <?php
        }
    else{
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
    <div class="ask">
        <div class="a1">
            <div class="a2">
                
                <h2>Ask a public question</h2>
                <img  id="ii" src="https://media.giphy.com/media/cYy90i7ZuUjByBCqGU/source.gif">
            </div>
            <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                
                $sql = "SELECT * FROM articles WHERE id = $id";
                $result = mysqli_query($conn, $sql, null);
                $data = mysqli_fetch_assoc($result);
                
                $title = $data['title'];
                $content = $data['content'];
                $content = html_entity_decode($content);
                $content_code = $data['content_code'];
                if($content_code != ""){
                    $content_code = html_entity_decode($content_code);
                }
                $tag1 = $data['tag1'];
                $tag2 = $data['tag2'];
                $tag3 = $data['tag3'];
                $tag = $tag1." ".$tag2." ".$tag3;
            }
            else{
                $id = "";
                $title = "";
                $content = "";
                $content_code = "";
                $tag = "";
            }
            
            ?>
        
            <div class="content">
            <form method="post" action="<?php echo "check_ask.php"; ?>" onsubmit="addNewLine()">
                <h4>Title <span>*</span></h4>
                <p>Be specific and imagine you're asking a question to another person</p>
                <input name="id" type="hidden" value="<?php echo $id;?>">
                <input id="i1" type="text" name="title" value="<?php echo $title;?>">
                <h4>Body</h4>
                <p>Include all the information someone would need to answer your question <span>*</span></p>
                <textarea id="contents" name="content1" rows="1000" cols="100" style="resize: none;"><?php echo $content;?></textarea>
                
                <p>Code content: if you want the question to be clearer</p>
                <textarea id="contentss" name="content2" rows="1000" cols="100" style="resize: none; "><?php echo $content_code;?></textarea>
                <p>Tag: you can put up to 3 tags, each tag separated by space</p>
                <input id="i2" name="tag" type="text" value="<?php echo $tag;?>">
                <input id="p1" type="submit" name="submitQs" value="Post your question">
            </form>
                
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
<?php include("notification.php"); ?>
</body>    
        <?php
    }
        
    ?>

    <script>
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
        function Logout(){
            window.location.assign("../../login/logout.php");
        }
        var textareas = document.getElementsByTagName('textarea');
        var count = textareas.length;
        for(var i=0;i<count;i++){
            textareas[i].onkeydown = function(e){
                if(e.keyCode==9 || e.which==9){
                    e.preventDefault();
                    var s = this.selectionStart;
                    this.value = this.value.substring(0,this.selectionStart) + "\t" + this.value.substring(this.selectionEnd);
                    this.selectionEnd = s+1; 
                }
            }
        }
    </script>
    <script type="text/javascript">
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