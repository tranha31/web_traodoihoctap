<?php session_start(); 
if(isset($_GET['account'])){
    $ac = $_GET['account'];
}
else{
    if(isset($_SESSION['account'])){
        $ac = $_SESSION['account'];
    }
    else{
        echo "<script>alert(\"Cannot access!\");window.location.assign(\"../main_forum/Code/home.php\");</script>";
    }
}

?>
<html>
<head>
    <title>Web Trao đổi học tập</title>
    <meta charset="UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "../main_forum/Code/header_footer.css">
    <link rel = "stylesheet" href = "account_infor.css">
    
</head>
<body>
    <section>
        <div class="header">
            <div>
                <div class="header_icon">
                    <li><img class="logo" src="https://drive.google.com/uc?id=1ucMaE2s1IhOArdjLHNGm_FdcX6-cSrfw"></li>
                    <li><a href="../main_forum/Code/home.php" class="home_icon"><img src="https://drive.google.com/uc?id=1Mo5BQY2veciStLc_MXRvJV1GTdL7HGnB"></a></li>
                    <li><a href="../main_forum/Code/forum.php" class="forum_icon"><img src="https://drive.google.com/uc?id=1fNJVt5H7d7eDxWng7Fi4R5PaMO96HaAC"></a></li>
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
                        <a href=\"account_infor.php\" class=\"forum_icon\"><img src=\"../main_forum/Picture/tk.png\"></a>
                        <a href=\"../login/logout.php\" class=\"forum_icon\"><img src=\"../main_forum/Picture/logout.png\"></a>";
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
    <section>
        <div class = "main">

<?php 
    $account="";  $date ="";
    $level="";  $numberofpost="";  $numberofheart="";
    $conn = mysqli_connect("localhost", "root","", "projectweb20202");
    if (!$conn) /* check if the connection was actually successful */
    {
        exit("Could not connect to the database: <br/>" .
            htmlspecialchars(mysql_error()) );
    }
    else {
        $sql = "SELECT * FROM account_infor WHERE account = '$ac'";
        $result = mysqli_query($conn, $sql, null);
        if (is_array($result) || is_object($result))
            foreach ($result as $item) {
                $account = $item["account"];
                $date = $item["date"];
                $level = $item["level"];
                $numberofpost = $item["numberofpost"];
                $numberofheart = $item["numberofheart"];
            }
        mysqli_close($conn);
    }
?>
    
            <div id="account_information">
                <div class="account_information">
                    <div class="avatar">
                        <h1>Account information</h1>
                        <?php $ava = rand(1, 2); ?>
                        <img src="../main_forum/Picture/user<?php echo $ava;?>.jpg">
                    </div>
                    <div class="information">
                        <li>
                            <p>Account: </p>
                            <p><?php echo $account;?></p>
                        </li>
                        <li>
                            <p>Participation date: </p>
                            <p><?php echo $date;?></p>
                        </li>    
                        <li>
                            <img class ="member_avatar" 
                            <?php 
                                if($level == 0) echo "src=\"https://drive.google.com/uc?id=1XcBKt2B_1Gp81-QtyCb3NKTRG2aP6xjz\"";
                                else if($level == 1)echo "src=\"https://drive.google.com/uc?id=1RbWDCDSBzTJi1XD_zWduAYIM_wxCfzTt\"";
                            ?>>
                            <p><?php
                                if($level == 0) echo "User";
                                else if($level == 1)echo "Admin";
                            ?></p>
                        </li>
                        <li>
                            <p>Number of posts: </p>
                            <p><?php echo $numberofpost;?></p>
                            <img class ="member_comment" src="https://drive.google.com/uc?id=1JBawsxIE5b3MsS8E-6I1F-FDlKnmoYkq">
                        </li>
                        <li>
                            <p>Number of votes: </p>
                            <p><?php echo $numberofheart;?></p>
                            <img class ="member_liked" src="https://drive.google.com/uc?id=1n90up3uN4-Xo51Q4-8ShMx4a7G6dRay4">
                        </li>
                    </div>
                </div>
                <div class="selection_button">
                    <button>
                        <a href="#activity_history" class="link">Activity history</a>
                    </button>
                    <button>
                        <a href="#personal_information" class="link">Personal information</a>
                    </button>
                    <?php
                        if($level == 0){
                            if(isset($_SESSION['account'])){
                                $conn = mysqli_connect("localhost", "root","", "projectweb20202");
                                $account = $_SESSION['account'];
                                $sql = "SELECT * FROM account_infor WHERE level = 1 AND account = '$account'";
                                $result = mysqli_query($conn, $sql, null);
                                if(mysqli_num_rows($result)>0){
                                    $sql = "select * from account_infor where level = 0 and account = '$ac' and ban = 0";
                                    $result1 = mysqli_query($conn, $sql, null);
                                    if(mysqli_num_rows($result1)>0){
                                        echo "<button onclick=\"Ban()\">Ban account</button>";
                                        echo "<button onclick=\"SetAdmin()\">Set admin</button>";
                                    }
                                    $sql = "select * from account_infor where level = 0 and account = '$ac' and ban = 1";
                                    $result2 = mysqli_query($conn, $sql, null);
                                    if(mysqli_num_rows($result2)>0){
                                        echo "<button onclick=\"UnBan()\">Unban account</button>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>

            </div>

            <div id="activity_history">
                <div class="search_history">
                    <div>
                        <?php
                        if($level == 1){
                            if(isset($_SESSION['account'])){
                                
                            
                            if($ac == $_SESSION['account'])
                            ?>
                            <button onclick = "showAdminActivity()" style="position: relative; display:block; z-index:8;">Admin Activities</button>
                            <?php
                        }
                        }
                        ?>
                        
                        <button onclick = "showMemberActivity()" style="position: relative; display:block; z-index:8;">
                            Show Activities
                        </button>
                         
                    </div>

                    <div class="history_area" id="member_activity" style="overflow:auto;">
                    
<?php 
    $conn = mysqli_connect("localhost", "root","", "projectweb20202");
    if (!$conn) /* check if the connection was actually successful */
    {
        exit("Could not connect to the database: <br/>" .
            htmlspecialchars(mysql_error()) );
    }
    else {
        $i = 0;
        $sql = "SELECT * FROM account_activity WHERE account1 = '$ac'";
        $result = mysqli_query($conn, $sql, null);
        if (is_array($result) || is_object($result))
            foreach ($result as $item) {
                $i++;
                echo
                "<a href =\"#content_activity\" class = \"activity\" onclick=\"changeIframe('" .$item['linkpost']. "')\">
                <p><b><i>" .$item['account1']." </i></b> <i>" .$item['activity']. "</i></p>
                <p>\"" .$item['shortcontent']. "\"</p>
                <div><p><i></i><i>" .$item['datetime']. "</i></p></div>
                </a>";
            }
        mysqli_close($conn);
    }
?>
                       
                    </div>
                    <div class="history_area" id="admin_activity" style="overflow:auto;">
                    
<?php 
    $conn = mysqli_connect("localhost", "root","", "projectweb20202");
    if (!$conn) /* check if the connection was actually successful */
    {
        exit("Could not connect to the database: <br/>" .
            htmlspecialchars(mysql_error()) );
    }
    else {
        $i = 0;
        $sql = "SELECT * FROM admin_activity WHERE account1 = '$ac'";
        $result = mysqli_query($conn, $sql, null);
        if (is_array($result) || is_object($result))
            foreach ($result as $item) {
                $i++;
                echo
                "<a href =\"#content_activity\" class = \"activity\" onclick=\"changeIframe('" .$item['link']. "')\">
                <p><b><i>" .$item['account1']." </i></b> <i>" .$item['activity']. " </i><b><i>" .$item['account2']. "</i></b></p>
                <div><p><i></i><i>" .$item['datetime']. "</i></p></div>
                </a>";
            }
        mysqli_close($conn);
    }
?>
                       
                    </div>
                    
                </div>
                <div class="activity_history" id="content_activity">
                    <iFrame id="iFrame" src=""></iFrame>
                </div>
            </div>
<?php 
    $account="";  $name="";  $yearofbirth="";
    $linkfacebook="";  $linkgithub=""; $linklinkedin="";
    $skill1="";  $skill2="";  $skill3="";
    $experiment1="";  $experiment2="";  $experiment3="";
    $phone="";   $email="";   $address="";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $account = $ac;
        $name = ($_POST["name"]);
        $yearofbirth = ($_POST["yearofbirth"]);
        $linkfacebook = ($_POST["linkfacebook"]);
        $linkgithub = ($_POST["linkgithub"]);
        $linklinkedin = ($_POST["linklinkedin"]);
        $skill1 = ($_POST["skill1"]);
        $skill2 = ($_POST["skill2"]);
        $skill3 = ($_POST["skill3"]);
        $experiment1 = ($_POST["experiment1"]);
        $experiment2 = ($_POST["experiment2"]);
        $experiment3 = ($_POST["experiment3"]);
        $phone = ($_POST["phone"]);
        
        echo 
            "<script>
                var numbers = /((09|03|07|08|05|84)+([0-9]{8})\b)/g;
                var numb=/((84)+([0-9]{9})\b)/g;
                var n=/([+]+(84)+([0-9]{9})\b)/g;
                var num = /((02)+([0-9]{9})\b)/g;
                
                var mphone = '$phone';
                console.log(mphone);

                if (mphone.value !== '') {
                    if (mphone.match(numbers) || mphone.match(num)||mphone.match(numb)||mphone.match(n)) {
                        
                    }
                    else {
                        alert('Wrong telephone number format');
                        window.location.assign('account_infor.php');
                    }
                }
            </script>";
        
        $email = ($_POST["email"]);
        $address = ($_POST["address"]);
        
        $conn = mysqli_connect("localhost", "root","", "projectweb20202");
        if (!$conn) /* check if the connection was actually successful */
        {
            exit("Could not connect to the database: <br/>" .
                htmlspecialchars(mysql_error()) );
        }
        //"UPDATE MyGuests SET lastname='Doe' WHERE id=2"
        else {
            $sql="UPDATE personal_infor SET name='" .$name. "', yearofbirth=" .$yearofbirth
                . ",linkfacebook='" .$linkfacebook. "',linkgithub='" .$linkgithub . "',linklinkedin='" .$linklinkedin
                . "',skill1='" .$skill1. "',skill2='" .$skill2. "',skill3='" .$skill3
                . "',experiment1='" .$experiment1. "',experiment2='" .$experiment2 . "',experiment3='" .$experiment3
                . "',phone='" .$phone. "',email='" .$email. "',address='" .$address."' WHERE account ='" .$account."'";
                
            mysqli_query($conn, $sql, null);
            mysqli_close($conn);
        }
    }

?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<?php 
    $conn = mysqli_connect("localhost", "root","", "projectweb20202");
    if (!$conn) /* check if the connection was actually successful */
    {
        exit("Could not connect to the database: <br/>" .
            htmlspecialchars(mysql_error()) );
    }
    else {
        $sql = "SELECT * FROM personal_infor WHERE account = '$ac'";
        $result = mysqli_query($conn, $sql, null);
        if (is_array($result) || is_object($result))
            foreach ($result as $item) {
                $name = $item['name'];
                $yearofbirth = $item['yearofbirth'];
                $linkfacebook = $item['linkfacebook'];
                $linkgithub = $item['linkgithub'];
                $linklinkedin = $item['linklinkedin'];
                $skill1 = $item['skill1'];
                $skill2 = $item['skill2'];
                $skill3 = $item['skill3'];
                $experiment1 = $item['experiment1'];
                $experiment2 = $item['experiment2'];
                $experiment3 = $item['experiment3'];
                $phone = $item['phone'];
                $email = $item['email'];
                $address = $item['address'];
            }
        mysqli_close($conn);
    }
    
?>
            <div id="personal_information">
                <div class = "show_infor" id="show_infor">
                    <div class="personal_information">
                        <div class="personal_infor">
                            <div>
                                <h1>Personal information</h1>
                                <li>
                                    <p><b><i>Full name:</i></b></p>
                                    <p><?php echo $name;?></p>
                                </li>
                                <li>
                                    <p><b><i>Year of birth:</i></b></p>
                                    <p><?php echo $yearofbirth;?></p>
                                </li>
                            </div>
                            <div>
                            <li><a href="<?php echo $linkfacebook;?>"><img src="https://drive.google.com/uc?id=1Dsgq5hddjFmMOsAylqZQB-tMgBSjLdVY">Facebook</a></li>
                            <li><a href="<?php echo $linkgithub;?>"><img src="https://drive.google.com/uc?id=1x67FlOAUykHvEwCgB6VB_ZU0O3l_p9gN">GitHub</a></li>
                            <li><a href="<?php echo $linklinkedin;?>"><img src="https://drive.google.com/uc?id=13GjVfn193ctlz2rZmMJ7tJt2TQBAxU8m">LinkedIn</a></li>
                            </div>
                        </div>
                        <div class="skills">
                            <h1>Skills</h1>
                            <li>
                                <p><?php echo $skill1;?></p>
                            </li>
                            <li>
                                <p><?php echo $skill2;?></p>
                            </li>
                            <li>
                                <p><?php echo $skill3;?></p>
                            </li>
                        </div>
                        <div class="experiment">
                            <h1>Experiences</h1>
                            <li>
                                <p><?php echo $experiment1;?></p>
                            </li>
                            <li>
                                <p><?php echo $experiment2;?></p>
                            </li>
                            <li>
                                <p><?php echo $experiment3;?></p>
                            </li>
                        </div>
                        <div class="communication">
                            <h1>Contact</h1>
                            <li>
                                <p><b><i>Phone number:</i></b></p>
                                <p><?php echo $phone;?></p>
                            </li>
                            <li>
                                <p><b><i>Email:</i></b></p>
                                <p><?php echo $email;?></p>
                            </li>
                            <li>
                                <p><b><i>Address:</i></b></p>
                                <p><?php echo $address;?></p>
                            </li>
                        </div>
                    </div>

                    <div class="edit_button">
                        <?php
                            if(isset($_SESSION['account'])){
                                $a = $_SESSION['account'];
                            }
                            else{
                                $a = "";
                            }
                            if($ac == $a){
                                echo "<button  type=\"button\" onclick=\"editInforFunction()\">Edit</button>";
                            }
                        ?>
                        
                    </div>
                </div>

                <div class = "edit_infor" id="edit_infor">
                    <div class="personal_information">
                        <div class="personal_infor">
                            <div>
                                <h1>Personal information</h1>
                                <li>
                                    <p><b><i>Full name:</i></b></p>
                                    <p><input type = "text" name="name" value="<?php echo $name?>"></p>
                                </li>
                                <li>
                                    <p><b><i>Year of birth:</i></b></p>
                                    <p><input type = "text" name="yearofbirth" value="<?php echo $yearofbirth?>"></p>
                                </li>
                            </div>
                            <div>
                            <li><img src="https://drive.google.com/uc?id=1Dsgq5hddjFmMOsAylqZQB-tMgBSjLdVY"><input type = "text" name="linkfacebook" value="<?php echo $linkfacebook?>" placeholder="link facebook"></li>
                            <li><img src="https://drive.google.com/uc?id=1x67FlOAUykHvEwCgB6VB_ZU0O3l_p9gN"><input type = "text" name="linkgithub" value="<?php echo $linkgithub?>" placeholder="link github"></li>
                            <li><img src="https://drive.google.com/uc?id=13GjVfn193ctlz2rZmMJ7tJt2TQBAxU8m"><input type = "text" name="linklinkedin" value="<?php echo $linklinkedin?>" placeholder="link linkedin"></li>
                            </div>
                        </div>
                        <div class="skills">
                            <h1>Skills</h1>
                            <li>
                                <input type = "text" name="skill1" value="<?php echo $skill1?>" placeholder="kỹ năng 1">
                            </li>
                            <li>
                                <input type = "text" name="skill2" value="<?php echo $skill2?>" placeholder="kỹ năng 2">
                            </li>
                            <li>
                                <input type = "text" name="skill3" value="<?php echo $skill3?>" placeholder="kỹ năng 3">
                            </li>
                        </div>
                        <div class="experiments">
                            <h1>Experiences</h1>
                            <li>
                                <input type = "text" name="experiment1" value="<?php echo $experiment1?>" placeholder="kinh nghiệm 1">
                            </li>
                            <li>
                                <input type = "text" name="experiment2" value="<?php echo $experiment2?>" placeholder="kinh nghiệm 2">
                            </li>
                            <li>
                                <input type = "text" name="experiment3" value="<?php echo $experiment3?>" placeholder="kinh nghiệm 3">
                            </li>
                        </div>
                        <div class="communication">
                            <h1>Contact</h1>
                            <li>
                                <p><b><i>Phone number:</i></b></p>
                                <input type = "text" name="phone" value="<?php echo $phone?>">
                            </li>
                            <li>
                                <p><b><i>Email:</i></b></p>
                                <input type = "text" name="email" value="<?php echo $email?>" readonly>
                            </li>
                            <li>
                                <p><b><i>Address:</i></b></p>
                                <input type = "text" name="address" value="<?php echo $address?>">
                            </li>
                        </div>
                    </div>

                    <div class="save_button">
                        <?php
                            if(isset($_SESSION['account'])){
                                $a = $_SESSION['account'];
                            }
                            else{
                                $a = "";
                            }
                            if($ac == $a){
                                echo "<td align=\"right\"> <input type=\"SUBMIT\" value=\"Save\" onclick=\"showInforFunction()\"></td>";
                                echo "<td align=\"left\"> <input type=\"reset\" value=\"Cancel\" onclick=\"showInforFunction()\"></td>";
                            }
                        ?>
                        
                    </div>
                <div>
            </div>
                </div>
    </div>
</form>
        </div>
    </section>
    
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

    <script src="account_infor.js">

    </script>
<script type="text/javascript">
        function Ban(){
            window.location.assign("Active.php?a=<?php echo $ac;?>&s=1");
        }
        function UnBan(){
            window.location.assign("Active.php?a=<?php echo $ac;?>&s=2");
        }
        function SetAdmin(){
            window.location.assign("Active.php?a=<?php echo $ac;?>&s=3");
        }
        function Login(){
            window.location.assign("../login/login.php");
        }
        function Logout(){
            window.location.assign("../login/logout.php");
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
            var myURL = "../main_forum/Code/Search_Q.php";
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


</body>
</html>