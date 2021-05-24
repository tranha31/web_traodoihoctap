<?php
$ac = $_GET['a'];
$id = $_GET["i"];
$act = $_GET['act'];
$actt = $_GET['actt'];

$conn = mysqli_connect("localhost", "root","", "projectweb20202");
$sql = "update actions set status = 1 where account = '$ac' and act = '$act' and id = $id and act_time = '$actt'";
mysqli_query($conn, $sql, null);

?>
<script>
    window.location.assign("main.php?id=<?php echo $id; ?>");
</script>
<?php

?>