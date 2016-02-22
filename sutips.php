<!DOCTYPE html>
    <?php
    session_start();
    ?>
    <!--Show this page when user do an operation successfully-->
    <html>
        <head>
            <title>CONGRATULATIONS!</title>
            <style type="text/css">
                h1 {text-align:center;}
            </style>
        </head>
        <body>
            <h1>
                Operation Successfully! Go Back!
                <form action="main.php">
                    <input type="submit" value="Return"/>
                </form>
            </h1>
        </body>
    </html>