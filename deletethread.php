<?php

include 'partials/_dbconnect.php';

$delete = false;
if(isset($_GET['delete'])){
    $id1 = $_GET['delete'];
    $threadid = $_GET['threadid'];
    $delete = true;
    try{
        $sql = "DELETE FROM `comments` WHERE `comments`.`comment_id` = $id1";
    }catch(Exception  $err){
        echo $err;
    }
    
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if($result){
            header("location: thread.php?threadid={$threadid}");
          }
   }  
}
?>