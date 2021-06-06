<?php
    require 'dbConfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#e6e6fa">

    <div id="main-wrapper">
        <center>
            <center><ch2>Registration Form</h2></center>
            <img src="images/img.png" class="avatar"/>
        </center>
    

        <form class="myform" action"register.php" method="post">
            <label><b>Username:</label><br>
            <input name="username" type="text" class="inputvalues" placeholder="Type your username" required/><br>
            <label>Password:</label><br>
            <input name="password" type="password" class="inputvalues" placeholder="Your password" required/><br>
            <label>Confirm Password:</label><br>
            <input name="cpassword" type="password" class="inputvalues" placeholder="Confirm Password" required/><br>
            <input name="submit_btn" type="submit" id="signup_btn" value="Sign Up"/><br>
            <a href="index.php"><input type="button" id="back_btn" value="Back"/></a>
        </form>

        <?php
            if(isset($_POST['submit_btn']))
            {
                //echo '<script type="text/javascript"> alert("Sign Up button clicked") </script>';

                $username = $_POST['username'];
                $password = $_POST['password'];
                $cpassword = $_POST['cpassword'];

                if($password==$cpassword)
                {
                    $query= "select * from user WHERE Username='$username'";

                    $query_run = mysqli_query($con,$query);

                    if(mysqli_num_rows($query_run)>0)
                    {
                        //there is already a user with the same username
                        echo '<script type="text/javascript"> alert("User already exists... try another username") </script>';
                    }
                    else
                    {
                        $query= "insert into user values('$username','$password')";
                        $query_run = mysqli_query($con,$query);

                        if($query_run)
                        {
                            echo '<script type="text/javascript"> alert("User Registered...Go to Login Page to Login") </script>';

                        }
                        else
                        {
                            echo '<script type="text/javascript"> alert("Error!") </script>';
                        }
                    }

                }
                else
                {
                    echo '<script type="text/javascript"> alert("Password and Confirm Password does not match") </script>';
                }
            }
        ?>
    </div>

</body>
</html>