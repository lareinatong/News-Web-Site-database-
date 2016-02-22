<?php

//this page is used to update the story to the database

    session_start();
    require 'database.php';
    
    //make sure that this operation is done by a logined user
    
    if (!isset($_SESSION['uname'])){
        header("Location: main_.php");
    }else
    {
        $sid=(int)$_POST['qqq'];
        $title=$_POST['title'];
        $tex=$_POST['story'];
            $result4= mysqli_query($con,"UPDATE story SET storyTitle='".$title."',storyText='".$tex."' WHERE storyID='".$sid."'");
		if(!$result4){
		    printf("Query Prep Failed: %s\n", $con->error);
		    exit;
		}
            header("Location: sutips.php");
            exit;
        
        
    }
?>