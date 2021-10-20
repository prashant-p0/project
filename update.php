<?php
 include 'partials/_dbconnect.php';

  if(ISSET($_POST['update'])){
    $cat_id = $_POST['catid'];
    $thread_id = $_POST['id'];
    $thread_title = $_POST['problem'];
    $desc = $_POST['desc'];
   
    // try{
    $sql = "UPDATE `threads` SET `thread_title` = '$thread_title', `thread_desc` = '$desc' WHERE `threads`.`thread_id` = $thread_id ";
    // }catch(Exception $e){
    //     echo $e;
    // }
    $result = mysqli_query($conn, $sql);

    if($result){
    header("location: threadlist.php?catid={$cat_id}");
  }
 
}

$delete= false;
if(isset($_GET['delete'])){
    $id1 = $_GET['delete'];
    $cat_id = $_GET['catid'];
    
    try{
        $sql = "DELETE FROM `threads` WHERE `thread_id` = $id1";
    }catch(Exception  $err){
        echo $err;
    }
    $delete = true;
    $result = mysqli_query($conn, $sql);
    if($result){
      header("location: threadlist.php?catid={$cat_id}");
    }
}
?>






