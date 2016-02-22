<?php
    session_start();
    require 'database.php';
    if(isset($_SESSION['uname'])){
    $tex=$_POST['comment'];
    $dat=date("Y-m-d h:i:sa");
    
    //get the user who sent this comment
    $result=mysqli_query($con,"SELECT ID FROM user WHERE name='". $_SESSION[uname] ."'");
    		if(!$result){
		    printf("Query Prep Failed: %s\n", $con->error);
		    exit;
		}
    while ($row1= mysqli_fetch_array($result)){
		$IDD=(int)$row1['ID'];
		}
    
    //insert this commit into the database
    $result = mysqli_query($con,"INSERT INTO commit (commitText,commitDate,ID,storyID) VALUES ('".$tex."','".$dat."','".$IDD."','".$_POST['qq']."')");
    		if(!$result){
		    printf("Query Prep Failed: %s\n", $con->error);
		    exit;
		}
		
    //the comment amount of the matched story add 1
    $numm=0;
    $result = mysqli_query($con,"SELECT numCommit FROM story WHERE storyID='".$_POST['qq']."'");
    if($row1=mysqli_fetch_array($result)){
	$numm=(int)$row1['numCommit'];
    }
    $numm++;
    $result = mysqli_query($con,"UPDATE story SET numCommit='".$numm."' WHERE storyID='".$_POST['qq']."'");
    mysqli_close();
    header("Location: story.php?q=".$_POST['qq']);
    exit;
    }else{header("Location: main_.php");}
?>