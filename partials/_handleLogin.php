
<?php
$showError = "false";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];

    $sql = "SELECT * from `users` WHERE user_email='$email'";
    $result = mysqli_query($conn, $sql);
    // echo var_dump($result);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) {
        // echo var_dump($numRows);
        $row = mysqli_fetch_assoc($result);
        // echo var_dump($row);
        if (password_verify($pass, $row["user_pass"])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['useremail'] = $email;
            echo "logged in  " . $email;
            header("Location: /bunny/php/forum/index.php?loginsuccess=true");
            exit();
        } else {
            // echo "invalifd credentials";
            header("Location: /bunny/php/forum/index.php?loginsuccess=false");
        }
    }
    header("Location: /bunny/php/forum/index.php?loginsuccess=false");
}



?>