<?php
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\"?>\n";
echo "<names>\n";

if(!isset($query)){
    $query = $_GET['query'];
}
if($query != ""){
    $conn = mysqli_connect("localhost", "root","", "projectweb20202");
    $find = explode(' ', $query);
    $sql = "Select * from articles where ";
    foreach($find as $key => $value){
        $sql = $sql."title like '%$value%' or ";
    }
    $sql = substr($sql, 0, -3);
    
    $result = mysqli_query($conn, $sql, null);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<id>".$row['id']."</id>\n";
            echo "<name>".$row['title']."</name>\n";
        }
    }
    mysqli_close($conn);
}

echo '</names>';
?>