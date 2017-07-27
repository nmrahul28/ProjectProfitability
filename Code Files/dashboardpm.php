<?php include("connection1.php"); session_start(); ?>
<html>
    <head>
        <title>Dashboard/PM</title>
        <script>
          function preventBack(){window.history.forward();}
          setTimeout("preventBack()", 0);
          window.onunload=function(){null};
        </script>
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
        <script>
            function pname() {
              var input, filter, table, tr, td, i;
              input = document.getElementById("myName");
              filter = input.value.toUpperCase();
              table = document.getElementById("myTable");
              tr = table.getElementsByTagName("tr");
              for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                }
              }
            }
        </script>
        <style type = "text/css">
            #f
            {
                width: 50%;
                float: left;
            }
            #cc
            {
                width: 50%;
                float: right;
            }
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
            fieldset.fs
            {
                background-color: #EEEEEE;
            }
            .title
            {
                font-variant: small-caps;
            }
        </style>
    </head>
    <body>
        <?php $pd = ""; $pn = ""; $PName = ""; $res = ""; 
            if($_SESSION['rname'] == "" || $_SESSION['usname'] == "")
            {
                ?>
                <script>alert("Please login to continue");location.href = "Login.php";</script>
                <?php
            }
            if($_SESSION['rname'] != "PM")
            {
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
                <td width = "84.7%" align = "left"><b>Hi <i><a href = "profileview.php" style = "color:#999; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#999'"><?php echo $_SESSION['rname']; echo " (".$_SESSION['usname'].")"; ?></a></i>, welcome back</b></td>
                <td width = "*" align = "right"><img src = "images/question.png"><a href="help.php" target="_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Help</a> | <img src = "images/contact.png">&thinsp;<a href="contact.php" target = "_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Contact</a> | <img src = "images/Logout.png">&thinsp;<a href = "logout.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Logout</a></td>
            </tr>
        </table>
        <hr><br><br><br>
        <fieldset>
            <center>
                <form name = "dashfpm" method = "post">
                    <table>
                        <tr>
                            <td>Select the project:</td>
                            <td><select name = "pro[]" required>
                                <option value = "">---Select a Project---</option>
                                <?php
                                    $profet = mysql_query("select Name from projectdetails where ProjectManager = '".$_SESSION['user']."' order by Name ASC;");
                                    if(mysql_num_rows($profet))
                                    {
                                        while($project = mysql_fetch_array($profet))
                                        {
                                            $pname = $project['Name'];
                                            echo "<option value =".$pname.">".$pname."</option>";
                                        }
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr style="background-color:#FFFFFF">
                            <td></td>
                            <td><button class = "btnSubmit" type = "submit" name = "submit">Submit</button>
                                <style type = "text/css">
                                .btnSubmit{
                                    color: #FF0000;
                                    background: #D5D5D5;
                                    font-weight: bold;
                                    border: 1px solid #D5D5D5;
                                    border-radius: 8px;
                                    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
                                }
                                .btnSubmit:hover {
                                  color: #FFF;
                                  background: #FF0000;
                                }
                                </style>
                            </td>
                        </tr>
                        <tr></tr>
                    </table>
                </form>
            </center>
<!--            <div align = "right"><img src = "finger.png" align = "top">&thinsp;<a href = "Choose.php" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#0038DA'">Click here to calculate Contribution</a></div>-->
            <fieldset><center>
                    <h2 style="text-align:center;" class="title">Projects</h2>
                    <?php
                        $tab = mysql_query("select ProjectID,Name,IBGHead,IBUHead,ProgramManager,ProjectManager from projectdetails where IBUHead = '".$_SESSION['user']."' OR IBGHead = '".$_SESSION['user']."' OR ProgramManager = '".$_SESSION['user']."' OR ProjectManager = '".$_SESSION['user']."' order by Name ASC;");
                    ?>
                    <div class = "search">
                        <table>
                            <tr>
                                <td>Search by : </td><td><input type="text" placeholder="Project name.." id="myName" onkeyup="pname()"></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <table style="border: 1px solid #DDD; text-align: left; border-collapse: collapse; width: 90%;" id = "myTable">
                        <tr>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Project ID</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Project Name</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Project Manager</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Program Manager</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">IBU Head</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">IBG Head</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Planned Offshore HeadCount</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Planned Onsite HeadCount</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Actual Offshore HeadCount</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Actual Onsite HeadCount</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Estimated Countribution</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Actual Countribution</font></th>
                        </tr>
                        <?php
                            if(mysql_num_rows($tab))
                            {
                                while($tabv = mysql_fetch_assoc($tab))
                                {
                                    ?>
                                    <tr>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['ProjectID']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;">
                                        <?php echo $tabv['Name']; ?>
                                        </td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['ProjectManager']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['ProgramManager']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['IBUHead']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['IBGHead']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php //echo $tabv['PlannedOffshoreHeadCount']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php //echo $tabv['PlannedOnsiteHeadCount']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php //echo $tabv['ActualOffshoreHeadCount']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php //echo $tabv['ActualOnsiteHeadCount']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php //echo $tabv['PlannedContribution']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php //echo $tabv['ActualContribution']; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                    </table>
                    <style type="text/css">
                        tr:nth-child(even){background-color: #f2f2f2}
                    </style>
    </center></fieldset>
            <?php
                if(isset($_POST["submit"]))
                {
                    foreach($_REQUEST['pro'] as $proj);
                    $fetque = mysql_query("select ProjectID from projectdetails where Name = '".$proj."';");
                    if(mysql_num_rows($fetque))
                    {
                        while($projid = mysql_fetch_assoc($fetque))
                        {
                            $_SESSION['pid'] = $projid['ProjectID'];
                        }
                    }
                    if($proj == "")
                    {
                        ?>
                        <script>alert("Please select a project");</script>
                        <?php
                    }
                    else
                    {
                        ?><script>location.href = "forecast.php";</script><?php
                    }
                }
            ?>
    </body>
</html>