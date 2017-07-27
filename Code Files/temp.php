<html>
    <head>
        <title>Template</title>
    </head>
    <body>
        <img src = "Logo%20left_01.png" height ="75" align = "left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <img src = "Title.PNG" align = "center">
        <img src = "Logo.png" height = "65" align = "right">
        <font face = "Arial Narrow" color = "red" size = "3"><marquee behavior=alternate scrollamount = "3">Connected World. Connected Technologies.</marquee></font><br /><br />
        <?php
            include("connection.php");
//            include("login.php");
            
        ?>
        <table>
            <tr>
                <td width = "85.7%" align = "left"><b>Welcome</b></td>
                <td width = "*" align = "right"><img src = "question.png"><a href="home.php">Help</a> | <img src = "contact.png">&thinsp;<a href="home.php">Contact</a> | <a href = "Login.php">Log Out</a></td>
            </tr>
        </table>
        <hr>
    </body>
</html>
