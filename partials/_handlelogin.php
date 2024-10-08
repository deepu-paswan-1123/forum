<?php
    $showerror=false;
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include '_dbconn.php';
        $login_email=$_POST['loginemail'];
        $login_pass=$_POST['loginpassword'];

        
        $sql="SELECT * FROM `forum_user` WHERE user_email='$login_email'";
        $result=mysqli_query($conn,$sql);
        $numrows=mysqli_num_rows($result);
        if ($numrows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($login_pass, $row['user_password'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno']=$row['sno'];
                echo $_SESSION['sno'];
                echo "<br>";
                $_SESSION['username']=$row['username'];
                echo $_SESSION['username'];
                echo "<br>";
                $_SESSION['useremail'] = $login_email;
                echo "logged in " . $login_email; 
                header("Location: /forum/index.php");
                exit();
            } else {
                echo "Unable to login: Invalid password";
            }
        } else {
            echo "Unable to login: Invalid email";
            header("Location: /forum/index.php");
            exit();
        }
        // header("Location: /forum/index.php");
        
    }

    

?>