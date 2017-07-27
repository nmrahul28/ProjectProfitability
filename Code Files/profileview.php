<?php session_start(); include("connection1.php"); ?>
<html>
    <head>
        <title>Profile/<?php echo $_SESSION['usname']; ?></title>
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
                min-width: 250px;
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
            td
            {
                padding-bottom: 1.5em;
            }
            #madd
            {
                background-image: url('images/PwdReq.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
            }
            #del
            {
                background-image: url('images/ProfileReq.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
            }
            #rev
            {
                background-image: url('images/RevenueRequest.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
            }
            #projd
            {
                background-image: url('images/ProjectDetReq.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
            }
        </style>
    </head>
    <?php
        $profilefetque = mysql_query("select * from profileview where ID = '".$_SESSION['user']."';");
        $fetchedvalues = mysql_fetch_assoc($profilefetque);
        $_SESSION['proFName'] = $fetchedvalues['FirstName'];
        $_SESSION['proLName'] = $fetchedvalues['LastName'];
        $_SESSION['proBand'] = $fetchedvalues['Band'];
        $_SESSION['proTelecode'] = $fetchedvalues['Telecode'];
        $_SESSION['proMobile'] = $fetchedvalues['Mobile'];
        $_SESSION['proExt'] = $fetchedvalues['Extension'];
    ?>
    <body>
        <?php
            if($_SESSION['rname'] == "" || $_SESSION['usname'] == "")
            {
                ?>
                <script>alert("Please login to continue");location.href = "Login.php";</script>
                <?php
            }
        ?>
        <!--        Template Start      -->
        <img src = "images/Logo%20left_01.png" height ="75" align = "left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <font face = "algerian" color = "#FF0000" size = "50">Project Profitability</font>
        <a href = "http://www.techmahindra.com/"><img src = "images/Logo.png" height = "65" align = "right"></a>
        <font face = "Arial Narrow" color = "red" size = "4"><marquee behavior=alternate scrollamount = "3">Connected World. Connected Technologies.</marquee></font><br /><br />
<!--        <table>-->
<!--            <tr>-->
                <div width = "*" align = "right"><img src = images/home.png><a
                <?php
                switch($_SESSION['rname'])
                {
                    case 'PM': ?>href = "dashboardpm.php"<?php
                    case 'PGM': ?>href = "dashboardpgm.php"<?php
                    case 'IBU': ?>href = "dashboardibu.php"<?php
                    case 'IBG': ?>href = "dashboardibg.php"<?php
                    case 'Admin': ?>href = "dashboardadmin.php"<?php
                }
                ?>
                style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">
                    Home</a> | <img src = "images/question.png" align = "top"><a href="help.php" target = "_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Help</a> | <img src = "images/contact.png" align = "top">&thinsp;<a href="contact.php" target = "_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Contact</a> | <img src = "images/Logout.png">&thinsp;<a href = "logout.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Logout</a></div>
<!--            </tr>-->
<!--        </table>-->
        <hr><br><br><br>
<!--        Template end        -->
        <center>
            <fieldset align = "center" style = "width:90%;">
                <center>
                    <form name = "proform" method = "post" action = "">
                        <table>
                            <tr>
                                <td>First Name:</td>
                                <td><output type = "text" name = "fname" id = "fname"><?php echo $_SESSION['proFName']; ?></output></td>
                            </tr>
                            <tr>
                                <td>Last Name:</td>
                                <td><output type = "text" name = "lname" id = "lname"><?php echo $_SESSION['proLName']; ?></output></td>
                            </tr>
                            <tr>
                                <td>Band:</td>
                                <td><output type = "text" name = "lname" id = "lname"><?php echo $_SESSION['proBand']; ?></output></td>
                            </tr>
                            <tr>
                                <td>Mobile Number:</td>
                                <td><output type = "text" name = "lname" id = "lname"><?php echo "+".$_SESSION['proTelecode']." ".$_SESSION['proMobile']; ?></output></td>
                            </tr>
                            <tr>
                                <td>Extension:</td>
                                <td><output type = "text" name = "lname" id = "lname"><?php echo $_SESSION['proExt']; ?></output></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><output type = "text" name = "lname" id = "lname"><?php echo $_SESSION['user']; ?></output>@TechMahindra.com</td>
                            </tr>
                        </table>
                    </form>
                </center>
            <div id = "div2">
                <div id = "reqop">
                    <div class = "addremove">
                        <button class = "selectopt">Request Admin</button>
                        <div class = "selectar">
                            <a href = "resetpwd.php" id = "madd">&thinsp;&thinsp;&thinsp;Request for password change</a>
                            <a href = "editprofile.php" id = "del">Request for profile edit</a>
                            <?php
                            if($_SESSION['rname'] == 'Admin' || $_SESSION['rname'] == 'IBG' || $_SESSION['rname'] == 'IBU' || $_SESSION['rname'] == 'PGM')
                            {
                                ?>
                                <a href = "revenuerequest.php" id = "rev">&thinsp;&thinsp;&thinsp;Request for project revenue change</a>
                                <a href = "ProjectDetailsRequest.php" id = "projd">&thinsp;&thinsp;&thinsp;Request for project details change</a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        </center>
    </body>
</html>