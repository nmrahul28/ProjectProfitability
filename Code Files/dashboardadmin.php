<?php session_start(); ?>
<html>
    <head>
        <title>Dashboard/Admin</title>
        <script>
            //Disabling the browser's back button
          function preventBack(){window.history.forward();}
          setTimeout("preventBack()", 0);
          window.onunload=function(){null};
        </script>
         <script type="text/javascript">
             //JavaScript code for Session Timeout
            var events = ['click', 'mousemove', 'keydown'],
            i = events.length,
            timer,
            delay = 10000,
            logout = function () {
                location.href = "timeout.html";
            },
            reset = function () {
                clearTimeout(timer);
                timer = setTimeout(logout, 15*60*1000);  //15 Minutes
            };

            while (i) {
                i -= 1;
                document.addEventListener(events[i], reset, false);
            }
            reset();
        </script>
        <style type = "text/css">
            .selectopt
            {
                background-color: #FF0000;
                color: white;
                padding: 16px;
                font-size: 16px;
                border: none;
                cursor: pointer;
                border-radius: 8px;
            }
            .addremove
            {
                position: relative;
                display: inline-block;
            }
            .selectar
            {
                display: none;
                position: absolute;
                background-color: #F9F9F9;
                min-width: 160px;
                box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
                z-index: 1;
            }
            .selectar a
            {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }
            #madd
            {
                background-image: url('images/development.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
            }
            #del
            {
                background-image: url('images/support.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
            }
            .selectar a:hover
            {
                background-color: #F1F1F1;
            }
            .addremove:hover .selectar
            {
                display: block;
            }
            .addremove:hover .selectopt
            {
                background-color: #FF0000;
            }
        </style>
    </head>
    <body>
        <?php include("connection1.php"); $res = ""; $res1 = ""; $res2 = ""; $res3 = ""; $res4 = ""; $res5 = ""; $i = "0";
        if($_SESSION['rname'] == "" || $_SESSION['usname'] == "")
            {
            //If the session is empty, redirect to login page
                ?>
                <script>alert("Please login to continue");location.href = "Login.php";</script>
                <?php
            }
            if($_SESSION['rname'] != "Admin")
            {
                //If other than admin tries to access this page, redirects to login page.
                ?>
                <script>alert("You have no access to this page");alert("You have been logged out. Please log in again.");location.href = "logout.php";</script>
                <?php
            }
        ?>
<!--        Template Start      -->
        <img src = "images/Logo%20left_01.png" height ="75" align = "left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <font face = "algerian" color = "#FF0000" size = "50">Project Profitability</font>
        <a href = "http://www.techmahindra.com/"><img src = "images/Logo.png" height = "65" align = "right"></a>
        <font face = "Arial Narrow" color = "red" size = "4"><marquee behavior=alternate scrollamount = "3">Connected World. Connected Technologies.</marquee></font><br /><br />
        <table>
            <tr>
                <td width = "84.9%" align = "left"><b>Hi <i><a href = "profileview.php" style = "color:#999; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#999'"><?php echo $_SESSION['rname']; echo " (".$_SESSION['usname'].")"; ?></a></i>, welcome back.</b></td>
                <td width = "*" align = "right"><img src = "images/question.png" align = "top"><a href="help.php" target = "_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Help</a> | <img src = "images/contact.png" align = "top">&thinsp;<a href="contact.php" target = "_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Contact</a> | <img src = "images/Logout.png">&thinsp;<a href = "logout.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Logout</a></td>
            </tr>
        </table>
        <hr><br><br><br>
<!--        Template end        -->
        <div align = "right">
                <table>
                    <tr>
                        <td><img src = "https://cdn2.iconfinder.com/data/icons/files-folders-1/130/Folder-6-512.png" style='width:30px;height:30px;'></td>
                        <td><a href = "fileupload.php" style = "color:#000000;text-decoration:none;" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Upload User's List Data</a></td>
                    </tr>
                </table>
            </div>
        <fieldset>
            <br>
<!--            Link to access the members who have login access to the page-->
            <div align = "center"><img src ="images/members.png"  align = "center">&thinsp;<a href = "member.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">View Accessible Members</a></div>
            <br><br>
             <div align = "center"><img src ="images/AllProjects.png"  align = "center">&thinsp;<a href = "project.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">View all projects</a></div>
            <br>
            <div class = "reqclass" id = "reqclass" align = "center"><img src ="images/request.png"  align = "center">&thinsp;<a href = "request.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Requests</a>
                <?php
                    $passwordtable = mysql_query("select * from passwordrequest;");
                    $profiletable = mysql_query("select * from profilerequest;");
                    $revenuetable = mysql_query("select * from revenuerequest;");
                    $projectdettable = mysql_query("select * from projectdetailsrequest;");
                    if(mysql_num_rows($passwordtable) || mysql_num_rows($profiletable) || mysql_num_rows($revenuetable) || mysql_num_rows($projectdettable))
                    {
                    echo "<img src = 'https://media.giphy.com/media/WcBjciMTrdJVm/giphy.gif' style='width:50px;height:50px;' align = 'center'>";
                    }
                ?>
            </div>
        </fieldset>
    </body>
</html>