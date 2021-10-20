<?php

session_start();
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/bunny/php/forum/">Forum</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/bunny/php/forum/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php" tabindex="-1">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="https://www.jdoodle.com/" tabindex="-1">Online Compiler</a>
                    </li>
                </ul>';

                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
                    echo ' <form class="d-flex" action="/bunny/php/forum/search.php" method="GET">
                    <a href="https://www.instagram.com/___username4/?utm_medium=copy_link"><img src="/bunny/php/forum/img/instagram1.jpg" width="35" class="mr-2" url= alt="..."></a> 
                    <input class="form-control me-2 mx-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button></form>
                    <form class="d-flex">
                    <p class="text-light pt-2 my-0 mx-2">welcome '. $_SESSION['useremail']. '</p>
                    <a href="partials/_logout.php" class="btn btn-outline-success ml-1">Logout</a></form>';
                }
                else{
                    echo '<form class="d-flex">
                    
                <a href="https://www.instagram.com/___username4/?utm_medium=copy_link"><img src="/bunny/php/forum/img/instagram1.jpg" width="40" class="mr-2" url= alt="..."></a> 
                <input class="form-control me-2 mx-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success me-2" type="submit">Search</button>
                      
                </form>
                    <button class="btn btn-outline-success ml-2 " data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>';
                }
                
               echo'   </div>
        </div>
    </nav>';
   
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>success!</strong> You can now login
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
} 
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false"){

    echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
        <strong>warning!</strong> password is not matched or Email ia already Exist
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}

if (isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>success!</strong> successfully login
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}
 if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false"){
    echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
        <strong>warning!</strong> password is not matched or please sign up
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
}
?>