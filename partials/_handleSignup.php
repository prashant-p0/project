<?php
$showError = "false";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '_dbconnect.php';
    $user_email = $_POST['signEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];
    $username=$_post['username'];
   
    // echo $photo;
    
    // chect whether user exist or not
    $existsql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existsql);
    $numRows = mysqli_num_rows($result);
    if($numRows > 0 ){
        $showError = "Email is already Exist";
    }
    else{
        if($pass == $cpass){
            move_uploaded_file($tmp_name,"/bunny/php/forum/user/$photo");
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`,`username`,`time_stamp`) VALUES ('$user_email', '$hash','$username',current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
                header("location: /bunny/php/forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError = "Password do not matched";
           
        }
    }
    header("location: /bunny/php/forum/index.php?signupsuccess=false&error=$showError");
}

?>