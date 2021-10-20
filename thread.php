<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #ques {
            min-height: 433px;
        }
        .slide{
            position: absolute;
            right: 240px;
        }
        .footer{
            /* position: absolute; */
            position: absolute;
            left: 1250px;
            top: 1070px;
        }
    </style>
    <title>Welcome to Forum</title>
</head>

<body>

    <?php include 'partials/_header.php' ?>
    <?php include 'partials/_dbconnect.php' ?>

    <?php

// $delete = false;
// if(isset($_GET['delete'])){
//     $id1 = $_GET['delete'];
//     $delete = true;
//     try{
//         $sql = "DELETE FROM `comments` WHERE `comments`.`comment_id` = $id1";
//     }catch(Exception  $err){
//         echo $err;
//     }
    
//     $result = mysqli_query($conn, $sql);
//     if ($delete) {
//         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
//         <strong>sucess!</strong> Your Query Has Been Successfully Deleted.
//         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
//       </div>';
//    }  
// }

    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];

        // Query the users table to find out the name of original poster
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];   
    }
    ?>


    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        // insert into comment  DB
        $comment = $_POST['comment'];
        $comment = str_replace("<", "&lt;", "$comment");
        $comment = str_replace(">", "&gt;", "$comment");

        $sno = $_POST['sno'];

        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;

        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>sucess!</strong> Your comment has been added!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
    ?>

    <!-- category container start here -->
    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?> </p>
            <hr class="my-4">
            <!-- <p>this is peer to peer for sharing knowledge with each other.
                No Spam / Advertising / Self-promote in the forums. ...
                Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...
            </p> -->
            <p>Posted By: <em><?php echo $posted_by ?></em></p>
            <div class="alert alert-danger mt-4" role="alert">
                <h4 class="alert-heading">Warning!</h4>
                <p>This is peer to peer for sharing knowledge with each other.<br>
                    No Spam / Advertising / Self-promote in the forums.<br>
                    Do not post “offensive” posts, links or images.<br>
                </p>
            </div>
        </div>
    </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
    echo '<div class="container">
    <h1 class="py-2">Post a Comment</h1>
    <form action="'. $_SERVER['REQUEST_URI'] .'" method="POST">
        <div class="form-group mb-3">
            <label for="exampleFormcontrolTextarea1">Type your comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
        </div>
        <button type="submit" class="btn btn-success">Post Comment</button>
    </form>
</div>';
    }
    
    else{
        echo ' <div class="container">
        <h1 class="py-2">Post a Comment</h1>
        <p class="lead">You are not logged in. Please login to post comments</p>
        </div>';
    }
    ?>

    <div class="container" id="ques">
        <h1 class="py-2">Discussions</h1>
        <?php
        $id = $_GET['threadid'];
        $thread_id2=$id;

        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $thread_user_id = $row['comment_by'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo ' <div class="media my-3">
            <img src="img/user1.svg" width="35" class="mr-3" alt="...">
            <div class="media-body">';
            
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
                if($thread_user_id ==  $_SESSION["sno"] ){
           echo' <div class="slide">
            
           
            <a href="deletethread.php?delete='. $row["comment_id"] .'&threadid=' . $thread_id2. '" class="delete btn btn-dark px-3 mx-1" id=" '. $row["comment_id"] .' ">Delete</a>
                    </div>';
           
                }
            }

                echo'<b><p>Answer by: '.$row2['user_email'].' at '. $comment_time.'</p></b>
                   ' . $content .'
            
        </div>
        </div>
        <hr>';
        }
        // include 'editthreadModal.php';
        // echo var_dump($noResult);
        if ($noResult) {
            echo '  <div class="jumbotron jumbotron-fluid mt-4">
        <div class="container">
            <p class="display-5">No Comments Found</p>
            <p class="lead">Be the first person to ask question</p>
        </div>
    </div>';
        }
        ?>
        <div class="footer">
                <p class="float-end mx-3"><a class="btn btn-dark" href="#">Back to top</a></p></div>

    </div>
        <?php include 'partials/_footer.php' ?>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>