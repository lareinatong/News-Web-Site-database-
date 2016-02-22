 <?php

    //using this method to add story to database
    session_start();
    require 'database.php';
    
    //make sure that this done by a logined user
    if(isset($_SESSION['uname'])){
    $title=$_POST['title'];
    $tex=$_POST['story'];
    $dat=date("Y-m-d h:i:sa");
    $result=mysqli_query($con,"SELECT ID FROM user WHERE name='". $_SESSION[uname] ."'");
    		if(!$result){
		    printf("Query Prep Failed: %s\n", $con->error);
		    exit;
		}
    while ($row1= mysqli_fetch_array($result)){
		$IDD=(int)$row1['ID'];
		}
    $numm=0;
    $result = mysqli_query($con,"INSERT INTO story (storyTitle,storyText,storyDate,ID,numCommit) VALUES ('".$title."','".$tex."','".$dat."','".$IDD."','".$numm."')");
    		if(!$result){
		    printf("Query Prep Failed: %s\n", $con->error);
		    exit;
		}
    mysqli_close();
    header("Location: sutips.php");
    exit;
    }else{header("Location: main_.php");}
?>