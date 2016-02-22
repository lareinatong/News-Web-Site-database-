<!DOCTYPE html>
    <?php
        session_start();
        require 'database.php';
    ?>
    <html>
        <head>
            <title>SYS - Share Your Story</title>
            <style type="text/css">
	    	h1 {color: pink; font: Arial;text-align:center;font-size: 500%;text-shadow: gray 2px 1px 2px;}
    		h5 {text-align:right;}
		p  {background-color: orange; color:red; font-size: 200%; padding: 20px;text-shadow: gray 2px 1px 2px;}
		div{text-align:center;}
	    </style>
	    <link href="style.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <hr>
		
		<!--The top of the page is varified when login or guest-->
		<table style="float: right"><tr><td>
                <?php
		if (isset($_SESSION['uname'])){
		    echo "Hello ".htmlentities($_SESSION['uname'])."!";
		echo "</td>\r\n";
		echo "<td>\r\n";
                echo "<form action=\"main_.php\" method=\"post\">\r\n";
                echo "<input type=\"submit\" value=\"Log Out\" />\r\n";
                echo "</form>\r\n";
		echo "</td><td>";
		echo "<form action=\"main.php\" method=\"POST\">\r\n";
                echo "<input type=\"submit\" value=\"Return\" />\r\n";
		echo "</form>";
		echo "</td></tr></table>";
		echo "<br>";
		
		}
		else{
		    echo "<form action=\"main_.php\" method=\"POST\">\r\n";
                    echo "<input type=\"submit\" value=\"Return\" />\r\n";
                    echo "</form>";
		    echo "</td></tr></table>";}
		?>

	    <br>
		<br>
            <hr>
	    
	    <!--Logo-->
            <h1>
            	Share Your Story
                <img src="story.jpg" width="320" height="115" alt="logo" />
            </h1>
            <hr>
		<!--Show the story-->
                <h3> <?php
                //title
                $sid=(int)$_GET['q'];
                $result3 = mysqli_query($con,"SELECT storyTitle FROM story WHERE storyID='". $sid ."'");
		if(!$result3){
		    printf("Query Prep Failed: %s\n", $con->error);
		    exit;
		}
		while ($row1= mysqli_fetch_array($result3)){
		$title=$row1['storyTitle'];
		}
                echo htmlentities($title);
                ?> </h3>
                <br>
                <?php
                //story
                $result3 = mysqli_query($con,"SELECT storyText FROM story WHERE storyID='". $sid ."'");
		if(!$result3){
		    printf("Query Prep Failed: %s\n", $con->error);
		    exit;
		}
		while ($row1= mysqli_fetch_array($result3)){
		$tex=$row1['storyText'];
		}
                echo htmlentities($tex);
                ?>
            <hr>
		
		<!--Show the comments by table-->
                <h3>See Others' Comments:</h3>
		<table>
		    <tr>
			<td><b>Num</b></td>
			<td><b>Comments</b></td>
			<td><b>Date</b></td>
			<td></td>
		    </tr><?php
                    
                $ID=0;
		if (isset($_SESSION['uname'])){
		$result3 = mysqli_query($con,"SELECT ID FROM user WHERE name='". $_SESSION[uname] ."'");
		if(!$result3){
		    printf("Query Prep Failed: %s\n", $con->error);
		    exit;
		}
		while ($row1= mysqli_fetch_array($result3)){
		$ID=(int)$row1['ID'];
		}}

		$sum=1;
		$result4= mysqli_query($con,"SELECT * FROM commit WHERE storyID='". $sid ."'");
		if(!$result4){
		    printf("Query Prep Failed: %s\n", $mysqli->error);
		    exit;
		}
		
		//every record is a row of table
		while ($row=mysqli_fetch_array($result4)){
		    
		    $sID=(int)$row['commitID'];
		    echo "<tr><td>";
		    echo $sum;
		    $sum++;
		    echo "</td><td>";
                    echo htmlentities($row['commitText']);
                    echo "</td><td>";
		    echo htmlentities($row['commitDate']);
		    echo "</td><td>";
		    if ($ID==$row['ID']){
			echo "<form action=\"operationcm.php\" method=\"POST\">\r\n";
			echo "<label>Delete <input type=\"radio\" name=\"cz\" value=\"delete\"/></label>\r\n";
			echo "<label>Edit <input type=\"radio\" name=\"cz\" value=\"edit\"/></label>\r\n";
			echo "<input type=\"hidden\" name=\"qq\" value=".$sID."/>\r\n";
                        echo "<input type=\"hidden\" name=\"aq\" value=".$sid."/>\r\n";
			echo "<input type=\"submit\" value=\"Do Operation\"/>\r\n";
			echo "</form>";
			}
		    echo "</td></tr>";
		    
		}
                ?>
		</table>
            <hr>
            <h3>
                <?php
		
		//if the user is logined, show the form so they could make comment
                if (isset($_SESSION['uname'])){
                echo "Write Your Comment:";
                echo "</h3>";
                echo "  "."<form action=\"addcm.php\" method=\"post\">\r\n";
                echo "  "."<label>Comment: <br> <input type=\"text\" name=\"comment\" /></label>\r\n";
                echo "<br>";
                echo "<input type=\"hidden\" name=\"qq\" value=".$sid." />\r\n";
                echo "      "."<input type=\"submit\" value=\"Submit\" />\r\n";
		echo "</form>";}
                mysqli_close($con);
                    ?>
        </body>
    </html>