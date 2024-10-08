<?php
   
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include '_dbconn.php';
        $username=$_POST['signupusername'];
        $user_email = $_POST['signupemail'];
        $user_password = $_POST['signuppassword'];
        $user_cpassword = $_POST['signupcpassword'];



        $existsql = "SELECT * FROM `forum_user` WHERE user_email = '$user_email'";
        $result = mysqli_query($conn, $existsql);
        $numrows = mysqli_num_rows($result);
        if ($numrows > 0) {
            $showError = "Email already exists";
        } 
        else{
            if ($user_password == $user_cpassword){
                $hash = password_hash($user_password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `forum_user` ( `username`,`user_email`, `user_password`, `user_time`) 
                        VALUES ( '$username','$user_email', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);  
                if ($result) {
                    $showAlert=true;
                    header("Location: /forum/index.php?signupsuccess=true");    
                    exit();
                   
                }

            }
            else{
                $showError = "password do not match";
            }
        }
        header("Location: /forum/index.php?signupsuccess=false&error=" . urlencode($showerror));
        exit();
    }

?>