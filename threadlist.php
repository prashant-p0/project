<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .footer {
            width: 100%;
        }

        .slide {
            position: absolute;
            right: 240px;

        }
        
    </style>
    <title>Welcome to Forum</title>
</head>

<body>

    <?php include 'partials/_header.php' ?>
    <?php include 'partials/_dbconnect.php' ?>

    <?php
    //  $delete= false;
    //  if(isset($_GET['delete'])){
    //      $id1 = $_GET['delete'];
         
    //      try{
    //          $sql = "DELETE FROM `threads` WHERE `thread_id` = $id1";
    //      }catch(Exception  $err){
    //          echo $err;
    //      }
    //      $delete = true;
    //      $result = mysqli_query($conn, $sql);
         
    //      if ($delete) {
    //         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //         <strong>sucess!</strong> Your Query Has Been Successfully Deleted.
    //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //       </div>';
          
    //    }
      
    // }


    $id = $_GET['catid'];
    $sql = "SELECT * FROM `category_idcategories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
        $caturl = $row['cat_url'];
    }
    ?>


   
<?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        // insert thread into database
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<", "&lt;", "$th_title");
        $th_title = str_replace(">", "&gt;", "$th_title");

        $th_desc = str_replace("<", "&lt;", "$th_desc");
        $th_desc = str_replace(">", "&gt;", "$th_desc");

        $sno = $_POST['sno'];
        $ql = "SELECT thread_cat_id FROM `threads` WHERE thread_user_id=$sno";
        $resul = mysqli_query($conn, $ql);
        $no = mysqli_num_rows($resul);
        // echo $no;
        if ($no > 10 ) {
            echo '<div class="alert alert-warning alert-dismissible fade show" id="alert" role="alert">
        <strong>warning!</strong> you have already succeeded your limit of Question! please delete it
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';}
      else{
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
           
           
                        if ($showAlert) { 
                echo '<div id="alert" class="alert alert-success alert-dismissible fade show"  role="alert">
                <strong>sucess!</strong> Your thread has been added! Please wait for community to respond
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        } 
           
    }
    ?>
   

    <!-- category container start here -->
    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>

            <hr class="my-4">


            <?php
            if ($id == 1) {
                include 'files/python.php';
            } elseif ($id == 2) {
                include 'files/javascript.php';
            } elseif ($id == 3) {
                include 'files/bootstrap.php';
            } elseif ($id == 4) {
                include 'files/p.php';
            } elseif ($id == 5) {
                include 'files/html.php';
            } elseif ($id == 6) {
                include 'files/c.php';
            } else {
                echo '<h1> content not found</h1>';
            }
            ?>

            <a href="<?php echo $caturl ?>" role="button" class="btn btn-success btn-lg">Learn More</a>

            <!-- <p>This is peer to peer for sharing knowledge with each other.<br>
                No Spam / Advertising / Self-promote in the forums.<br>
                Do not post “offensive” posts, links or images.<br>
            </p> -->





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
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '
    <div class="container">
        <h1 class="py-2">Start a Discussions</h1>
        <form action="' . $_SERVER["REQUEST_URI"] . '" method="POST"> 
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title" required>
                <div id="emailHelp" class="form-text">Keep your title as short as possible</div>
            </div>
            <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
            <div class="form-group mb-3">
                <label for="exampleFormcontrolTextarea1">Elaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
    } else {
        echo ' <div class="container">
        <h1 class="py-2">Start a Discussions</h1>
        <p class="lead">You are not logged in. Please login to start discssion</p>
        </div>';
    }
    ?>


    <!-- fetch the data of which user has posted the question -->
    <div class="container mt-2" id="ques">
        <h1 class="py-2">Browse Quetions</h1>
        <?php
        $id = $_GET['catid'];
        $cat_id2=$id;
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo ' <div class="media my-3">
            <img src="img/user1.svg" width="35" class="mr-2" alt="...">
            <div class="media-body">';

            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                if ($thread_user_id ==  $_SESSION["sno"]) {
               
                    echo '<div class="slide">
                  <button id="'.$id.'" class="edit btn btn-warning px-3 mx-1" data-bs-toggle="modal" data-bs-target="#editModal">
                    Edit</button>
                   
                    <a href="update.php?delete='. $row["thread_id"] .'&catid=' . $cat_id2. '" class="delete btn btn-dark px-3 mx-1" id=" '. $row["thread_id"] .' ">Delete</a>
            </div>';
                }
            }
            echo ' <b><p>Asked by: ' . $row2['user_email'] . ' at ' . $thread_time . '</p></b>
            <h5 class="mt-3"><a href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                
                <div class="flex-grow-1">
                   ' . $desc . '
                </div>
            </div>
        </div><hr>';
        }

        include 'editModal.php';

        // echo var_dump($noResult);
        if ($noResult) {
            echo '  <div class="jumbotron jumbotron-fluid mt-4">
            <div class="container">
                <p class="display-5">No Threads Found</p>
                <p class="lead">Be the first person to ask question</p>
            </div>
        </div>';
        }
        ?>
       
 
        <p class="float-end mx-3"><a class="btn btn-dark" href="#">Back to top</a></p><br><br>
        </div>
            <?php include 'partials/_footer.php' ?>
        




        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>
<script>
    document.querySelectorAll('.edit').forEach(e => e.addEventListener('click' , (elem)=>{ console.log(elem ); document.querySelector('.th-id').value=elem.srcElement.id   }  ))

</script>
</html>