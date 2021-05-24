<html>
    <head>
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link rel = "stylesheet" href = "../main_forum/Code/check_ask.css">
        
    </head>
    <body>
        
        <?php
        $conn = mysqli_connect("localhost", "root","", "projectweb20202");
        $ve = $_GET['code'];
        $sql = "select * from account_infor where verification_code = '$ve' and verified = 0";
        $result = mysqli_query($conn, $sql, null);
        if(mysqli_num_rows($result) > 0){
            $sql = "update account_infor set verified = 1 where verification_code = '$ve'";
            mysqli_query($conn, $sql, null);
            ?>
        <div class="center popup">
                <img src="picture/check.png">
                <p>Your account is valid, thanks!</p>
                <p>You may now login</p>
                <button id="dismiss" onclick="Dismiss()">OK</button>
        </div>
        <script>
            document.getElementsByClassName("popup")[0].classList.add("active");
        </script>
        <script>
            function Dismiss(){
                window.location.assign("login.php");
            }
        </script>
            <?php
        }
        else{
            ?>
        <div class="center popup">
                <img src="../main_forum/Picture/warning.png">
                <p>I think you're in the wrong place!</p>
                <p>Please try again</p>
                <button id="dismiss" onclick="Dismiss()">OK</button>
        </div>
        <script>
            document.getElementsByClassName("popup")[0].classList.add("active");
        </script>
        <script>
            function Dismiss(){
                window.location.assign("../main_forum/Code/home.php");
            }
        </script>
            <?php
        }
        ?>
        
    </body>
</html>
