<?php include "connect.php" ?>
<?php 
    $count = 0;
    $sql = "select id, title, count(id) from likes l, articles a where l.id_article = a.id group by id;";
    $result = $con->query($sql);
    
    if(!empty($result)){
        $numberOfData = $result->num_rows;
        foreach($result as $item):
            $count ++; 
            if($count > $numberOfData) break;
?>
            
            <div>
                <a href="main.php?id=<?php echo $item['id'] ?>"><p><?php echo $item['count(id)']." " ?></p><?php echo $item['title']; ?></a>
            </div>
<?php   
        endforeach;
    }
?>