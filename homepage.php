<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#e6e6fa">

    <div id="main-wrapper">
        <center>
            <center><h2>Home Page</h2></center>
            <h3>Welcome
                <?php echo $_SESSION['username'] ?>
            </h3>
            <img src="images/img.png" class="avatar"/>
        </center>
    

        <form class="myform" action"homepage.php" method="post">
           
            <input name="logout" type="submit" id="logout_btn" value="Log Out"/><br>
            
        </form>
        <?php 
            if(isset($_POST['logout']))
            {
                session_destroy();
                header('location:index.php');
            }
        ?>
    </div>

</body>
</html>