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
	    <!--if log off then destroyed the session-->
	    <?php
	    if (isset($_SESSION['uname'])){
		session_destroy();
	    }
	    ?>
            <hr>
            <!--The log and reg part-->
		<table style="float: right">
		    <tr><td>
                 <form action="main.php" method="post">
                    <label>UserName: <input type="text" name="username"/></label>
                    <label>PassWord: <input type="password" name="password"/></label>
                    <input type="submit" value="Log In" />
                </form></td>
		<td>
		<form action="reg.html" method="post">
                    <input type="submit" value="Sign Up" />
                </form></td></tr></table>
		<br><br>
            
            <hr>
		<!--LOGO-->
            <h1>
            	Share Your Stroy
                <img src="story.jpg" width="320" height="115" alt="logo" />
            </h1>
            <hr>
		<!--Show story by table-->
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
		    $sum++;
		    echo "</td><td>";
		    echo htmlentities($row['storyTitle']);
		    echo "</td><td>";
		    echo htmlentities($row['storyDate']);
		    echo "</td><td>";
		    $num=(int)$row['numCommit'];
		    echo $num;
		    echo "</td><td>";
		    echo "<form action=\"story.php?q\" method=\"GET\">\r\n";
		    echo "<input type=\"hidden\" name=\"q\" value=\"".$sID."\" >\r\n";
		    echo "<input type=\"submit\" value=\"Go\"/>\r\n";
		    echo "</form>";

		    echo "</td></tr>";
		    
		}
		mysqli_close();
                ?>
		</table>
		
		<!--the main_.php do not used when user logined, so there is no place to write story-->
            <hr>
               
        </body>
    </html>


