<?php
session_start();


$conn = mysqli_connect("localhost", "root","", "projectweb20202");

if(isset($_GET['code'])){
    $c = $_GET['code'];
    $admin = $_GET['admin'];
    $ac = $_GET['account'];
    $sql = "select * from account_infor where active_admin = '$c'";
    $result = mysqli_query($conn, $sql, null);
    $row = mysqli_fetch_assoc($result);
    
    $today = date("Y-m-d");
    $admin_d = $row["date_admin"];
    $today = strtotime($today);
    $admin_d = strtotime($admin_d);
    $datediff = abs($today - $admin_d);
    $due = floor($datediff / (60*60*24));
    if($due <= 5){
        $sql = "update account_infor set level = 1 where active_admin = '$c'";
        mysqli_query($conn, $sql, null);
        $sql = "insert into admin_activity(account1, activity, account2, link, datetime) values('$admin', 'set success admin account', '$ac', '', '$today')";
        mysqli_query($conn, $sql, null);
        echo "<script>alert(\"You are admin now\");window.location.assign(\"../main_forum/Code/home.php\");</script>";
    }
    else{
        echo "<script>alert(\"Your invitation has expired\");window.location.assign(\"../main_forum/Code/home.php\");</script>";
    }
}
else{
    $a = $_GET['a'];
    $s = $_GET['s'];
    $u = $_SESSION['account'];

if($s == 1){
    $d = date("Y-m-d");
    $sql = "update account_infor set ban = 1, dateofban = '$d' where account = '$a'";
    mysqli_query($conn, $sql, null);
    
    $sql = "SELECT * FROM personal_infor WHERE account = '$a'";
    $result = mysqli_query($conn, $sql, null);
    $row = mysqli_fetch_assoc($result);
    
    $recipient_email = $row['email'];
    $subject = "Ban Account | UKnow";
    $body = "Your account has been banned 10 days. If you wish to appeal, contact us by email: nhom8cnw@gmail.com";
    $name = "UKnow";
    $email_sender = "nhom8cnw@gmail.com";
    $headers  = "MIME-Version: 1.0rn";
    $headers .= "Content-type: text/html; charset=iso-8859-1rn";
    $headers .= "From: {$name} <{$email_sender}> n";
    mail($recipient_email, $subject, $body, $headers);
    
    $sql = "insert into admin_activity(account1, activity, account2, link, datetime) values('$u', 'ban account', '$a', '', '$d')";
    mysqli_query($conn, $sql, null);
    
    echo "<script>window.location.assign(\"account_infor.php?account=$a\");</script>";
}
else if($s == 2){
    $d = date("Y-m-d");
    $sql = "update account_infor set ban = 0 where account = '$a'";
    mysqli_query($conn, $sql, null);
    
    $sql = "SELECT * FROM personal_infor WHERE account = '$a'";
    $result = mysqli_query($conn, $sql, null);
    $row = mysqli_fetch_assoc($result);
    
    $recipient_email = $row['email'];
    $subject = "Unban Account | UKnow";
    $body = "Your account has been unblocked. Please continue to be actively involved.";
    $name = "UKnow";
    $email_sender = "nhom8cnw@gmail.com";
    $headers  = "MIME-Version: 1.0rn";
    $headers .= "Content-type: text/html; charset=iso-8859-1rn";
    $headers .= "From: {$name} <{$email_sender}> n";
    mail($recipient_email, $subject, $body, $headers);
    
    $sql = "insert into admin_activity(account1, activity, account2, link, datetime) values('$u', 'unblock account', '$a', '', '$d')";
    mysqli_query($conn, $sql, null);
    
    echo "<script>window.location.assign(\"account_infor.php?account=$a\");</script>";
    
}
else if($s == 3){
    $d = date("Y-m-d");
    
    $verificationCode = md5(uniqid("admin", true));
    $verificationLink = "http://localhost/web_traodoihoctap/information/Active.php?code=". $verificationCode."&admin=$u&account=$a";
    
    $sql = "update account_infor set active_admin = '$verificationCode', date_admin = '$d' where account = '$a'";
    mysqli_query($conn, $sql, null);
    $sql = "SELECT * FROM personal_infor WHERE account = '$a'";
    $result = mysqli_query($conn, $sql, null);
    $row = mysqli_fetch_assoc($result);
    
    $recipient_email = $row['email'];
    $subject = "Invite become admin | UKnow";
    $body = "you have been invited admin rights by $u. Please contact email nhom8cnw@gmail.com for details of work to do and click link to accept invite ".$verificationLink." in 5 days";
    $name = "UKnow";
    $email_sender = "nhom8cnw@gmail.com";
    $headers  = "MIME-Version: 1.0rn";
    $headers .= "Content-type: text/html; charset=iso-8859-1rn";
    $headers .= "From: {$name} <{$email_sender}> n";
    mail($recipient_email, $subject, $body, $headers);
    
    $sql = "insert into admin_activity(account1, activity, account2, link, datetime) values('$u', 'invite to admin', '$a', '', '$d')";
    mysqli_query($conn, $sql, null);
    
    echo "<script>window.location.assign(\"account_infor.php?account=$a\");</script>";
}
}
?>