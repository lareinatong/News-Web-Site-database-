<!DOCTYPE html>
<!--Delete or edit a comment-->

<?php
    session_start();
    require 'database.php';
    
    //make sure this operation is done by a logined user
    if (!isset($_SESSION['uname'])){
        header("Location: main_.php");
    }else
    {
	//if the operation is delete then delete a comment and make the comment amount of the related story decrease
        $sid=(int)$_POST['qq'];
        $czz=$_POST['cz'];
        if ($czz=="delete"){
            $result4= mysqli_query($con,"DELETE FROM commit WHERE commitID='".$sid."'");
		if(!$result4){
		    printf("Query Prep Failed: %s\n", $con->error);
		    exit;
		}
	    $numm=0;
	    $result = mysqli_query($con,"SELECT numCommit FROM story WHERE storyID='".$_POST['aq']."'");
	    if($row1=mysqli_fetch_array($result)){
		$numm=(int)$row1['numCommit'];
	    }
	    $numm--;
	    $result = mysqli_query($con,"UPDATE story SET numCommit='".$numm."' WHERE storyID='".$_POST['aq']."'");
            header("Location: story.php?q=".$_POST['aq']);
            exit;
        }
        
    }
?>

<!--if the operation ordered is edit then show the form-->
<html>
        <head>
            <title>Edit Your Story</title>
            <style type="text/css">
	    	h1 {color: orange; font: Arial;text-align:center;font-size: 1000%;text-shadow: gray 2px 1px 2px;}
                h2 {color: green; font: Arial;text-align:center;font-size: 500%;text-shadow: gray 2px 1px 2px;}
    		h5 {text-align:right;}
                h6 {font-size: 100%;text-align: center;}
		p  {background-color: orange; color:red; font-size: 200%; padding: 20px;text-shadow: gray 2px 1px 2px;}
		div{text-align:center;}
	    </style>
        </head>
        <body>
            <hr>
                <table style="float: right"><tr><td>
                <?php
		if (isset($_SESSION['uname'])){
		    echo "Hello ".htmlentities($_SESSION['uname'])."!";
		echo "</td>\r\n";
		echo "<td>\r\n";
                echo "<form action=\"main_.php\" method=\"post\">\r\n";
                echo "<input type=\"submit\" value=\"Log Out\" />\r\n";
                echo "</form>\r\n";}
		?>
		</td>
                <td>
                    <form action="main.php" method="POST">
                        <input type="submit" value="Return" />
                    </form>
                </td>
                </tr></table>
	    <br>
	    <br>
		<br>
            <hr>
                <h2>~Edit Your Comment~</h2>
            <hr>
		
                <!--send the information to the editcm.php-->
                    <form action="editcm.php" method="POST">
                        <label>Comment: <input type="text" name="commit" value="<?php
                        $result4= mysqli_query($con,"SELECT commitText FROM commit WHERE commitID='".$sid."'");
                        if(!$result4){
                            printf("Query Prep Failed: %s\n", $con->error);
                            exit;
                        }
                        if ($row=mysqli_fetch_array($result4)){
                            $tex=$row['commitText'];
                        }
                        mysqli_close();
                        echo htmlentities($tex); ?>"/></label>
                        <input type="hidden" name="qqq" value="<?php
                        echo $sid;
                        ?>" />
                        <input type="submit" value="Edit" />
                    </form>
                
            <hr>

        </body>
</html>

