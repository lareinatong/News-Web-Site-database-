<?php

//this is used to update the status of the comments to the database
//This only can be done by a logined user

    session_start();
    require 'database.php';
    if (!isset($_SESSION['uname'])){
        header("Location: main_.php");
    }else
    {
        $sid=(int)$_POST['qqq'];
        $tex=$_POST['commit'];
            $result4= mysqli_query($con,"UPDATE commit SET commitText='".$tex."' WHERE commitID='".$sid."'");
		if(!$result4){
		    printf("Query Prep Failed: %s\n", $con->error);
		    exit;
		}
            header("Location: story.php?q=".$sid);
            exit;
        
        
    }
?>