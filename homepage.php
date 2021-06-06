<?php
    session_start();
    require 'dbConfig/config.php';
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
            <!-- <input type="text" name="task" class="task_input"> -->
            <input name="task" type="text" class="inputvalues" placeholder="Type your task"/><br>
            <input name="personalentry" type="submit" id="addentry_btn" value="Add a new Personal entry"/><br>
            <input name="workentry" type="submit" id="addentry_btn" value="Add a new Work entry"/><br>
            <input name="logout" type="submit" id="logout_btn" value="Log Out"/><br>
            
        </form>

        <label>Personal Journal:</label><br>
        <table>
            <thead>
                <tr>
                    <th>N</th>
                    <th>Tasks</th>
                    <th style="width: 60px;">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                // select all tasks if page is visited or refreshed
                $username = $_SESSION['username'];
                $tasks = mysqli_query($con, "SELECT * FROM journal WHERE username='$username' AND personal != '     NULL' ");

                $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
                    <tr>
                        <td> <?php echo $i; ?> </td>
                        <td class="task"> <?php echo $row['personal']; ?> </td>
                        <td class="delete"> 
                            <a href="homepage.php?del_task_personal=<?php echo $row['personal'] ?>">X</a> 
                        </td>   
                    </tr>
                <?php $i++; } ?>	
            </tbody>
        </table>

        <label>Work Journal:</label><br>
        <table>
            <thead>
                <tr>
                    <th>N</th>
                    <th>Tasks</th>
                    <th style="width: 60px;">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                // select all tasks if page is visited or refreshed
                $username = $_SESSION['username'];
                $tasks = mysqli_query($con, "SELECT * FROM journal WHERE username='$username' AND work != '     NULL' ");

                $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
                    <tr>
                        <td> <?php echo $i; ?> </td>
                        <td class="task"> <?php echo $row['work']; ?> </td>
                        <td class="delete"> 
                            <a href="homepage.php?del_task_work=<?php echo $row['work'] ?>">X</a> 
                        </td>   
                    </tr>
                <?php $i++; } ?>	
            </tbody>
        </table>
        <?php 
            if(isset($_POST['logout']))
            {
                session_destroy();
                header('location:index.php');
            }
            	// insert a quote if submit button is clicked
            if (isset($_POST['workentry']) or isset($_POST['personalentry'])) {
                if (empty($_POST['task'])) {
                    $errors = "You must fill in the task";
                    echo '<script type="text/javascript"> alert("Please fill the tasks") </script>';
                }else{
                    $task = $_POST['task'];
                    $username = $_SESSION['username'];
                    if(isset($_POST['personalentry'])) {
                        $sql = "insert into journal (username,personal) VALUES ('$username','$task')";
                    }
                    else {
                        $sql = "insert into journal (username,work) VALUES ('$username','$task')";
                    } 
                    
                    mysqli_query($con, $sql);
                    header('location: homepage.php');
                }
            }

            if (isset($_GET['del_task_personal'])) {
                $task = $_GET['del_task_personal'];
            
                mysqli_query($con, "DELETE FROM journal WHERE personal = '$task'");
                header('location: homepage.php');
            }
            if (isset($_GET['del_task_work'])) {
                $task = $_GET['del_task_work'];
            
                mysqli_query($con, "DELETE FROM journal WHERE work = '$task'");
                header('location: homepage.php');
            }
        ?>
    </div>

</body>
</html>