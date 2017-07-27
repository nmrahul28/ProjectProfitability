<?php session_start(); ?>
<html>
    <head>
        <title>Remove a Member</title>
        <style type = "text/css">
            .t
            {
                font-variant: small-caps;
            }
        </style>
        <script type="text/javascript">
            var events = ['click', 'mousemove', 'keydown'],
            i = events.length,
            timer,
            delay = 10000,
            logout = function () {
                location.href = "timeout.html";
            },
            reset = function () {
                clearTimeout(timer);
                timer = setTimeout(logout, 15*60*1000);
            };

            while (i) {
                i -= 1;
                document.addEventListener(events[i], reset, false);
            }
            reset();
        </script>
        <script type="text/javascript">
            function check()
            {
                if(document.addform.empname.value == "")
                    {
                        alert("Please enter Associate Name");
                        document.addform.empname.focus();
                        return false;
                    }
                if(document.addform.empid.value == "")
                    {
                        alert("Please enter the Employee ID");
                        document.addform.empid.focus();
                        return false;
                    }
                else{
                    return true;
                }
            }
        </script>
    </head>
    <body>
        <?php
            if($_SESSION['rname'] == "" || $_SESSION['usname'] == "")
            {
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
        <img src = "images/Logo%20left_01.png" height ="75" align = "left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <font face = "algerian" color = "#FF0000" size = "50">Project Profitability</font>
        <a href = "http://www.techmahindra.com/"><img src = "images/Logo.png" height = "65" align = "right"></a>
        <font face = "Arial Narrow" color = "red" size = "3"><marquee behavior=alternate scrollamount = "3">Connected World. Connected Technologies.</marquee></font><br /><br />
        <table>
            <tr>
                <td width = "84.7%" align = "left"><b>Welcome <i><a href = "https://mybeatplus.techmahindra.com/" target = "_blank" style = "color:#999; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#999'"><?php echo $_SESSION['rname']; echo " (".$_SESSION['usname'].")"; ?></a></i></b></td>
                <td width = "*" align = "right"><img src = "images/question.png" align = "top"><a href="home.php" target = "_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Help</a> | <img src = "images/contact.png" align = "top">&thinsp;<a href="contact.php" target = "_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Contact</a> | <img src = "images/Logout.png">&thinsp;<a href = "logout.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Logout</a></td>
            </tr>
        </table>
        <hr><br><br><br>
        <?php
            $eloc = "";
            include("connection1.php");
            if(isset($_POST["submit"]))
            {
                $proname = $_POST['proname'];
                $proid = $_POST['proid'];
                $delque = mysql_query("DELETE FROM projectdetails WHERE ProjectID = '$proid';");
                $delque1 = mysql_query("DELETE FROM projectresources WHERE ProjectID = '$proid';");
                header("location:project.php");
            }
            
        ?>
        <fieldset>
            <div align = "center">
                <font class = "t" color = "#FF0000" size = "5">Remove a project</font>
            </div>
            <div align = "right">
                <table>
                    <tr>
                        <td><img src = "images/Cancel.png"></td>
                        <td><a href = "project.php" style = "color:#000000;text-decoration:none;" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Cancel</a></td>
                    </tr>
                </table>
            </div>
            <form name = "addform" method="post" action = "removeproject.php" onsubmit = "check();" autocomplete="off">
            <center>
                <table>
                    <tr style="background-color: #FFFFFF">
                        <td>Project Name</td>
                        <td><input type = "text" name = "proname" required></td>
                        <td>&ensp;&ensp;</td>
                        <td>Project ID</td>
                        <td><input type = "text" name = "proid" required></td>
                        
                    </tr>
                    <tr style="background-color: #FFFFFF">
                        <td>&ensp;&ensp;</td>
                        <td></td>
                        <td><button class = "btnRem" type = "submit" name = "submit" title = "Remove the mentioned member">Remove</button>
                            <style type = "text/css">
                                .btnRem
                                {
                                    color: #FF0000;
                                    background: #D5D5D5;
                                    font-weight: bold;
                                    border: 1px solid #D5D5D5;
                                    border-radius: 8px;
                                    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
                                }
                                .btnRem:hover
                                {
                                    color: #FFF;
                                    background: #FF0000;
                                }
                            </style>
                        </td>
                    </tr>
                </table>
            </center>
        </form>
        </fieldset>
    </body>
</html>