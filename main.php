<!DOCTYPE html>
    <!--The same as the main_.php, but allow greeting and writing story-->
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
		<table style="float: right"><tr><td>
                <?php
		if (isset($_SESSION['uname'])){
		    echo "Hello ".$_SESSION['uname']."!";
		echo "</td>\r\n";
		echo "<td>\r\n";
                echo "<form action=\"main_.php\" method=\"post\">\r\n";
                echo "<input type=\"submit\" value=\"Log Out\" />\r\n";
                echo "</form>\r\n";}
		?>
		</td></tr></table>
	    <br>
	    <br>
		<br>
            <hr>
            <h1>
            	Share Your Stroy
                <img src="story.jpg" width="320" height="115" alt="logo" />
            </h1>
            <hr>
		<h3>See Others' Stories:</h3>
		<table>
		    <tr>
			<td><b>Num</b></td>
			<td><b>Title</b></td>
			<td><b>Date</b></td>
			<td><b>Comments</b></td>
			<td></td><td></td>
		    </tr>
                <?php
		if ((isset($_POST['username']))&&(isset($_POST['password']))){
                            $uname=$_POST['username'];
                            $pswd=$_POST['password'];
                            $result = mysqli_query($con,"SELECT name FROM user");
                            $flag=false;
                            while($row = mysqli_fetch_array($result)) {
                                if ($uname==$row['name']){
                                    $flag=true;
                                    break;
                                }
                            }
                            if ($flag==false){
                                header("Location: reg.html");
                                exit;
                            }
                            $result2 = mysqli_query($con,"SELECT password FROM user WHERE name=\"".$uname."\"");
                            
                            $flag=false;
                            
                            while($row = mysqli_fetch_array($result2)) {
                                if (crypt($pswd,$row['password'])==$row['password']){
                                    echo "<br>";
                                    $flag=true;
                                    break;
                                }
                            }
                            if ($flag==false){    
                                header("Location: wpswd.html");
                                exit;
                            }
                            $_SESSION['uname']=$uname;
                            $_SESSION['pswd']=$pswd;
			    header("Location: main.php");
			    exit;
			}
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
		$result4= mysqli_query($con,"SELECT * FROM story ORDER BY storyDate DESC");
		if(!$result4){
		    printf("Query Prep Failed: %s\n", $mysqli->error);
		    exit;
		}
		
		while ($row=mysqli_fetch_array($result4)){
		    
		    $sID=(int)$row['storyID'];
		    echo "<tr><td>";
		    echo $sum;
		    //echo $ID;
		    $sum++;
		    echo "</td><td>";
		    echo htmlentities($row['storyTitle']);
		    echo "</td><td>";
		    echo htmlentities($row['storyDate']);
		    echo "</td><td>";
		    $num=(int)$row['numCommit'];
		    //}
		    echo $num;
		    echo "</td><td>";

		    echo "<form action=\"story.php?q\" method=\"GET\">\r\n";
		    echo "<input type=\"hidden\" name=\"q\" value=".$sID.">\r\n";
		    echo "<input type=\"submit\" value=\"Go\"/>\r\n";
		    echo "</form>";
		    
		    echo "</td><td>";
		    //$ID=$row['ID'];//}
		    if ($ID==$row['ID']){
			echo "<form action=\"operation.php\" method=\"POST\">\r\n";
			echo "<label>Delete <input type=\"radio\" name=\"cz\" value=\"delete\"/></label>\r\n";
			echo "<label>Edit <input type=\"radio\" name=\"cz\" value=\"edit\"/></label>\r\n";
			echo "<input type=\"hidden\" name=\"qq\" value=".$sID."/>\r\n";
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
                        
			    if (isset($_SESSION['uname'])){
                            echo "Write Your Own Story:";
                            echo "</h3>";
                            echo "  "."<form action=\"add.php\" method=\"post\">\r\n";
                            echo "  "."<label>Title: <br> <input type=\"text\" name=\"title\" /></label>\r\n";
                            echo "<br>";
                            echo "  "."<label>Story: <br> <input type=\"text\" name=\"story\" /></label>\r\n";
                            echo "<br>";
                            echo "      "."<input type=\"submit\" value=\"Submit\" />\r\n";
			    echo "</form>";}else{
				header("Location: main_.php");
			    }
                            mysqli_close($con);
                        
                    ?>
        </body>
    </html>