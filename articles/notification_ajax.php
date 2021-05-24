<?php
session_start();
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\"?>\n";
echo "<notifications>\n";

$loginUser = $_SESSION['account'];
$conn = mysqli_connect("localhost", "root","", "projectweb20202");

$sqlNotification = 'select per.account, per.linkgithub, art.title, act.act, art.id, act.act_time from actions act, articles art, account_infor acc, personal_infor per
where  act.id = art.id 
and art.account = "'.$loginUser.'"
and act.account = acc.account
and acc.account = per.account
and act.status = 0
order by act_time desc limit 5 offset 0;';

                       
$result = mysqli_query($conn, $sqlNotification, null);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        echo "<id>".$row['id']."</id>\n";
        echo "<account>".$row['account']."</account>\n";
        echo "<act>".$row['act']."</act>\n";
        echo "<title>".$row['title']."</title>\n";
        echo "<acttime>".$row["act_time"]."</acttime>\n";
        
    }
}
mysqli_close($conn);
echo "</notifications>";                      
                       
?>