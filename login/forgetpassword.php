<?php
if(isset($_POST['submit'])){
    if(isset($_POST["account"])){
        $ac = $_POST["account"];
    }
    else{
        $ac = "";
    }
    if(isset($_POST["password"])){
        $p = $_POST["password"];
    }
    else{
        $p = "";
    }
    if(isset($_POST['email'])){
        $em = $_POST['email'];
    }
    else{
        $em = "";
    }
    if(isset($_POST['g-recaptcha-response'])){
        $captcha = $_POST['g-recaptcha-response'];
    }
    else{
        $captcha = "";
    }
    if($ac == "" || $p == "" || $em == "" || $captcha == ""){
        echo "<script>alert(\"You must enter all information!\");</script>";
    }
    else{
        if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
            echo "<script>alert(\"Your email address is not valid!\");</script>";
        }
        else{
            
            $secret = '6LfQx9oaAAAAAMadd0K270bfqsM9LevGG4vsG7gB'; //Thay thế bằng mã Secret Key của bạn
            $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
            $response_data = json_decode($verify_response);
            if(!$response_data->success)
            {
                $message = 'Authentication failed';
                
                echo "<script>alert(\"$message\");</script>";
            }
            
            
            $conn = mysqli_connect("localhost", "root","", "projectweb20202");
            $sql = "SELECT * FROM personal_infor WHERE account = '$ac' AND email = '$em'";
            $result = mysqli_query($conn, $sql, null);
            if(mysqli_num_rows($result) == 0){
                echo "<script>alert(\"Your account is not correct!\");</script>";
            }
            else{
                if(!checkPass($p)){
                    echo "<script>alert(\"Invalid password!\");</script>";
                }
                else{
                    $verificationCode = md5(uniqid("validation", true));
                    $verificationLink = "http://localhost/web_traodoihoctap/login/SignupControl.php?code=" . $verificationCode;
                    
                    $htmlStr = "";
                    $htmlStr .= "Hi " . $em."\n";
 
                    $htmlStr .= "You just changed your password. Please click the link below to verify your subscription and have access to the download center.\n";
                    $htmlStr .= "$verificationLink"."\n";
 
                    $htmlStr .= "Kind regards,";
                    
                    $name = "UKnow";
                    $email_sender = "nhom8cnw@gmail.com";
                    $subject = "Verification Link | UKnow | Subscription";
                    $recipient_email = $em;
 
                    $headers  = "MIME-Version: 1.0rn";
                    $headers .= "Content-type: text/html; charset=iso-8859-1rn";
                    $headers .= "From: {$name} <{$email_sender}> n";
 
                    $body = $htmlStr;
                    $d = date('Y-m-d');
                    if( mail($recipient_email, $subject, $body, $headers) ){
                        $sql = "update account_infor set password = '$p', verification_code='$verificationCode', verified=0 where account = '$ac'";
                        mysqli_query($conn, $sql, null);
                        
                        echo "<script>alert(\"Please check your email to verified account!\");window.location.assign(\"login.php\");</script>";
                    }
                    else{
                        die("Sending failed.");
                        echo "<script>window.location.assign(\"Signup.php\");</script>";
                    }
                }
            }
        }
    }
}

function checkPass($pass){
    $so = ["0","1","2","3","4","5","6","7","8","9"];
    $ktt = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
    $kth = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
    
    if(strlen($pass) < 8){
        return false;
    }
    if(strpos($pass, " ") !== false){
        return false;
    }
    $va = false;
    $va1 = false;
    $va2 = false;
    foreach($so as $k=>$v){
        if(strpos($pass, $v) !== false){
            $va = true;
            break;
        }
    }
    foreach($ktt as $k=>$v){
        if(strpos($pass, $v) !== false){
            $va1 = true;
            break;
        }
    }
    foreach($kth as $k=>$v){
        if(strpos($pass, $v) !== false){
            $va2 = true;
            break;
        }
    }
    if(($va == true && $va1 == true) || ($va == true && $va2 == true)){
        return true;
    }
    else{
        return false;
    }
}

?>

<html>
<head>
    <title>Web Trao đổi học tập</title>
    <meta charset="UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <link rel = "stylesheet" href = "login.css">
    <link rel = "stylesheet" href = "signup.css">
    <script src='https://www.google.com/recaptcha/api.js' async defer ></script>
</head>

<body>
    <div id="welcome">
        <h2>UKnow</h2>
        <h4>UKnow helps you learn and connect with people</h4>
    </div>
    <div id="main">
        <img id="ava" src="picture/avatar.png">
        <h1>Change Password</h1>
        <form method="post" action="forgetpassword.php" class="login">
            <p><b>Username</b><span>*</span></p>
            <input type="text" name="account" placeholder="Username" class="i">
            <p><b>New Password</b><span>*</span></p>
            <input type="text" name="password" placeholder="Password">
            <p><b>Email</b><span>*</span></p>
            <input type="text" name="email" placeholder="Email">
            <p id="note">Passwords must contain at least eight characters, including at least 1 letter and 1 number and not including space character.</p>
            <div class="g-recaptcha" data-sitekey="6LfQx9oaAAAAABLJp0zYPa89yeaiG84TMHIbA4sf"></div>
            <button type="submit" name="submit">Submit</button>
        </form>
        <a href="login.php" class="link">Login</a>
    </div>
</body>

</html>