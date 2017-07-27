<?php session_start(); ?>
<html>
    <head>
        <title>Add a Member</title>
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
                timer = setTimeout(logout, 15*60*1000); //15 minutes
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
        <style type = "text/css">
            .t
            {
                font-variant: small-caps;
            }
        </style>
    </head>
    <body>
        <?php include("connection1.php"); $res = ""; $res1 = ""; $res2 = ""; $res3 = ""; $res4 = ""; $res5 = ""; $i = "0";  $erole = "";
            $eband = "";
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
                <td width = "84.7%" align = "left"><b>Welcome <i><a href = "profileview.php" target = "_blank" style = "color:#999; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#999'"><?php echo $_SESSION['rname']; echo " (".$_SESSION['usname'].")"; ?></a></i></b></td>
                <td width = "*" align = "right"><img src = "images/question.png" align = "top"><a href="home.php" target = "_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Help</a> | <img src = "images/contact.png" align = "top">&thinsp;<a href="contact.php" target = "_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Contact</a> | <img src = "images/Logout.png">&thinsp;<a href = "logout.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Logout</a></td>
            </tr>
        </table>
        <hr><br><br><br>
        <fieldset>
            <div align = "center">
                <font class = "t" color = "#FF0000" size = "5">Add a Member</font>
            </div>
            <div align = "right">
                <table>
                    <tr>
                        <td><img src = "images/Cancel.png"></td>
                        <td><a href = "member.php" style = "color:#000000;text-decoration:none;" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Cancel</a></td>
                    </tr>
                </table>
            </div>
        <?php
            $eloc = "";
            if(isset($_POST["submit"]))
            {
                $ename = $_POST['empname'];
                $eid = $_POST['empid'];
                $erole = $_POST['emprole'];
                 
                $eband = $_POST['empband'];
                
                $check = mysql_query("select username from loginaccess;");
                if(mysql_num_rows($check))
                {
                    while($namecheck=mysql_fetch_assoc($check))
                    {
                        if($namecheck['username'] == $eid){
                        ?>
                        <script>alert("User already exists...!");</script>
                        <?php }
                    }
                }
                if(isset($_REQUEST["locrad"]))
                {
                   
                    $eloc = $_REQUEST["locrad"];
                }
               if($ename != "" && $eid != "" && $erole != "" && $eband != "")
                {
                    $addque = mysql_query("INSERT INTO loginaccess(FName,username,password,Role,band,location) VALUES('$ename','$eid','Techm@".$eid."$','$erole','$eband','$eloc');");
                   
                   $add2que = mysql_query("INSERT INTO profileview(ID) VALUES('$eid');");
                }
                header("location:member.php");
            }
        ?>
        <form name = "addform" method="post" action = "" onsubmit = "check();" autocomplete="off">
            <center>
                <table>
                    <tr style="background-color: #FFFFFF">
                        <td>Employee Name</td>
                        <td><input type = "text" name = "empname" required></td>
                        <td>&ensp;&ensp;</td>
                        <td>Employee ID</td>
                        <td><input type = "text" name = "empid" required></td>
                        
                    </tr>
                    <tr style="background-color: #FFFFFF">
                        <td>Role</td>
                        <td>
<!--                            <input list="emprole" name="emprole" required>-->
<!--                            <datalist id="emprole">-->
                            <select name = "emprole" id = "emprole" required>
                                <option value ="">---Select a role---</option>
                                <option value = "Admin"> Admin</option>
                                <option value = "IBG"> IBG</option>
                                <option value = "IBU"> IBU</option>
                                <option value = "PGM"> PGM</option>
                                <option value = "PM"> PM</option>
                            </select>
<!--                            </datalist>-->
                           
                             
                        </td>
                        <td>&ensp;&ensp;</td>
<!--                        <td>Band</td>-->
<!--                        <td>-->
<!--                            <input list="empband" name="empband" required>-->
<!--                            <datalist id="empband">-->
<!--
                            <select name = "empband" id = "empband" required>
                                <option value ="">---Select a band---</option>
                                <option value = "P2"> P2</option>
                                <option value = "P1"> P1</option>
                                <option value = "U4"> U4</option>
                                <option value = "U3"> U3</option>
                                <option value = "U2"> U2</option>
                                <option value = "U1"> U1</option>
                            </select>
-->
<!--                            </datalist>-->
<!--                        </td>-->
                    </tr>
<!--
                    <tr style="background-color: #FFFFFF">
                        <td>Location</td>
                        <td><input type = "radio" name = "locrad" value="Onsite" required>Onsite</td>&thinsp;<td><input type = "radio" name = "locrad" value="Offshore" required>Offshore</td>
                        <td>&ensp;&ensp;</td>
                        <td></td>
                    </tr>
-->
                    <tr style="background-color: #FFFFFF">
                        <td>&ensp;&ensp;</td>
                        <td></td>
                        <td><button class = "btnAdd" type = "submit" name = "submit">Add</button>
                            <style type = "text/css">
                                .btnAdd
                                {
                                    color: #FF0000;
                                    background: #D5D5D5;
                                    font-weight: bold;
                                    border: 1px solid #D5D5D5;
                                    border-radius: 8px;
                                    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
                                }
                                .btnAdd:hover
                                {
                                    color: #FFF;
                                    background: #FF0000;
                                }
                                .btnAdd:active {
                                  background-color: #FF0000;
                                  box-shadow: 0 5px rgba(0,0,0,0.2);
                                  transform: translateY(4px);
                                }
                            </style>
                        </td>
                    </tr>
                </table>
            </center>
        </fieldset>
        </form>
    </body>
</html>