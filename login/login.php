<?php 
session_start();
if(isset($_POST["login"])){
    $u = $_POST["account"];
    $p = $_POST["password"];
    if($u == "" || $p == ""){
        echo "<script>alert(\"You must enter all information!\");</script>";
    }
    else{
        $conn = mysqli_connect("localhost", "root","", "projectweb20202");
        $sql = "select * from account_infor where account = '$u' and password = '$p'";
        $result = mysqli_query($conn, $sql, null);
        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            if($row['verified'] == 1){
                $_SESSION["account"] = $row["account"];
                echo "<script>window.location.assign(\"../main_forum/Code/home.php\")</script>";
            }
            else{
                echo "<script>alert(\"Your account is not verified! Please try again!\");</script>";
            }
            
        }
        else{
            echo "<script>alert(\"You enter wrong information. Please try again!\");</script>";
        }
    }
}

?>
<html>
<head>
    <title>Web Trao đổi học tập</title>
    <meta charset="UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "login.css">
</head>
<body>
    <div id="welcome">
        <h2>UKnow</h2>
        <h4>UKnow helps you learn and connect with people</h4>
    </div>
    <div id="main">
        <img id="ava" src="picture/avatar.png">
        <h1>Login</h1>
        <form method="post" action="login.php" class="login">
            <p><b>Username</b></p>
            <input type="text" name="account" placeholder="Username" class="i">
            <p><b>Password</b></p>
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="login">Login</button>
        </form>
        <a href="forgetpassword.php" class="link">Change password</a>
        <a href="Signup.php" class="link">Sign up</a>
        <a href="../main_forum/Code/home.php" class="link">Back to home</a>
    </div>
</body>
</html>