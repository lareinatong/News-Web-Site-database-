<!DOCTYPE html>
<!--This page is mean to delete or edit stories-->
<?php
    session_start();
    require 'database.php';
    
    //make sure that this operation is done by a logined user
    if (!isset($_SESSION['uname'])){
        header("Location: main_.php");
    }else
    {
	//if the operation is delete then delete the record
        $sid=(int)$_POST['qq'];
        $czz=$_POST['cz'];
        if ($czz=="delete"){
            $result4= mysqli_query($con,"DELETE FROM story WHERE storyID='".$sid."'");
		if(!$result4){
		    printf("Query Prep Failed: %s\n", $con->error);
		    exit;
		}
            header("Location: sutips.php");
            exit;
        }
        
    }
?>

<!-- if the operation ordered is edit then show the form-->

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
                <h2>~Edit Your Story~</h2>
            <hr>
		
                <!--take out the text in the database and put it in the text area, this would make edit much easier-->
                    <form action="edit.php" method="POST">
                        <label>Title: <input type="textarea" name="title" value="<?php
                        $result4= mysqli_query($con,"SELECT storyTitle FROM story WHERE storyID='".$sid."'");
                        if(!$result4){
                            printf("Query Prep Failed: %s\n", $mysqli->error);
                            exit;
                        }
                        if ($row=mysqli_fetch_array($result4)){
                            $title=$row['storyTitle'];
                        }
                        echo htmlentities($title);
                        ?>"/></label>
                        <label>Story: <input type="textarea" name="story" value="<?php
                        $result4= mysqli_query($con,"SELECT storyText FROM story WHERE storyID='".$sid."'");
                        if(!$result4){
                            printf("Query Prep Failed: %s\n", $mysqli->error);
                            exit;
                        }
                        if ($row=mysqli_fetch_array($result4)){
                            $tex=$row['storyText'];
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

