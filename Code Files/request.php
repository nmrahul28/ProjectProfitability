<?php include("connection1.php"); session_start(); ?>
<html>
    <head>
        <title>Requests</title>
        <style type = "text/css">
            .title
            {
                font-variant: small-caps;
            }
        </style>
        <style type="text/css">
            tr:nth-child(even){background-color: #f2f2f2}
        </style>
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
                ?>
                <script>alert("You have no access to this page");alert("You have been logged out. Please log in again.");location.href = "logout.php";</script>
                <?php
            }
        ?>
        <img src = "images/Logo%20left_01.png" height ="75" align = "left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <font face = "algerian" color = "#FF0000" size = "50">Project Profitability</font>
        <a href = "http://www.techmahindra.com/"><img src = "images/Logo.png" height = "65" align = "right" title="Go to Tech Mahindra official site"></a>
        <font face = "Arial Narrow" color = "red" size = "4"><marquee behavior=alternate scrollamount = "3">Connected World. Connected Technologies.</marquee></font><br /><br />
        <table>
            <tr>
                <td width = "79.5%" align = "left"><b>Welcome <i><a href = "https://mybeatplus.techmahindra.com/" target = "_blank" style = "color:#999; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#999'"><?php echo $_SESSION['rname']; echo " (".$_SESSION['usname'].")"; ?></a></i></b></td>
                 <td width = "*" align = "right"><img src = "images/home.png">&thinsp;<a  href = "dashboardadmin.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Home</a> | <img src = "images/question.png"><a href="help.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Help</a> | <img src = "images/contact.png">&thinsp;<a href="contact.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Contact</a> | <img src = "images/Logout.png">&thinsp;<a href = "logout.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Logout</a></td>
            </tr>
        </table>
        <hr><br><br><br>
        <fieldset>
            <center>
                <?php
                $passwordtable = mysql_query("select * from passwordrequest;");
                ?>
                <h3 align = "center" class = "title">Password Requests</h3>
                <table style="border: 1px solid #DDD; text-align: left; border-collapse: collapse; width: 90%;">
                    <tr>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Employee ID</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Existing Password</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Requested Password</font></th>
                    </tr>
                    <?php
                        if(mysql_num_rows($passwordtable))
                        {
                            while($passwordtablefet = mysql_fetch_assoc($passwordtable))
                            {
                                ?>
                                <tr>
                                    <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $passwordtablefet['EmployeeID']; ?></td>
                                    <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $passwordtablefet['ExistingPassword']; ?></td>
                                    <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $passwordtablefet['RequestedPassword']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </table>
                <br><br>
                <?php
                $profiletable = mysql_query("select * from profilerequest;");
                ?>
                <h3 align = "center" class = "title">Profile Edit Requests</h3>
                <table style="border: 1px solid #DDD; text-align: left; border-collapse: collapse; width: 90%;">
                    <tr>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Employee ID</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">First Name</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Last Name</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Band</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">TeleCode</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Mobile</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Extension</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Email</font></th>
                    </tr>
                    <?php
                        if(mysql_num_rows($profiletable))
                        {
                            while($profiletablefet = mysql_fetch_assoc($profiletable))
                            {
                                ?>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $profiletablefet['EmployeeID']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $profiletablefet['FullName']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $profiletablefet['LastName']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $profiletablefet['Band']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $profiletablefet['Code']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $profiletablefet['Mobile']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $profiletablefet['Extension']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $profiletablefet['Email']; ?></td>
                                <?php
                            }
                        }
                    ?>
                </table>
                <br><br>
                <?php
                $revenuetable = mysql_query("select * from revenuerequest;");
                ?>
                <h3 align = "center" class = "title">Revenue Edit Requests</h3>
                <table style="border: 1px solid #DDD; text-align: left; border-collapse: collapse; width: 90%;">
                    <tr>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Project ID</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">New Revenue</font></th>
                    </tr>
                    <?php
                        if(mysql_num_rows($revenuetable))
                        {
                            while($revenuetablefet = mysql_fetch_assoc($revenuetable))
                            {
                                ?>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $revenuetablefet['ProjectID']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $revenuetablefet['NewRevenue']; ?></td>
                                <?php
                            }
                        }
                    ?>
                </table>
                <br><br>
                <?php
                $projectdettable = mysql_query("select * from projectdetailsrequest;");
                ?>
                <h3 align = "center" class = "title">Project Details Edit Requests</h3>
                <table style="border: 1px solid #DDD; text-align: left; border-collapse: collapse; width: 90%;">
                    <tr>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Project ID</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Project Name</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">IBG Head</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">IBU Head</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Program Manager</font></th>
                        <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Project Manager</font></th>
                    </tr>
                    <?php
                        if(mysql_num_rows($projectdettable))
                        {
                            while($projectdettablefet = mysql_fetch_assoc($projectdettable))
                            {
                                ?>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $projectdettablefet['ProjectID']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $projectdettablefet['ProjectName']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $projectdettablefet['IBGHead']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $projectdettablefet['IBUHeadID']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $projectdettablefet['ProgramManagerID']; ?></td>
                                <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $projectdettablefet['ProjectManagerID']; ?></td>
                                <?php
                            }
                        }
                    ?>
                </table>
            </center>
        </fieldset>
    </body>
</html>