<?php session_start(); ?>
<html>

    <head>
        <title>Project Details</title>
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
        <style type = "text/css">
            #myBtn {
              display: none;
              position: fixed;
              bottom: 20px;
              right: 30px;
              z-index: 99;
              border: none;
              outline: none;
              background-color: red;
              color: white;
              cursor: pointer;
              padding: 15px;
              border-radius: 10px;
            }

            #myBtn:hover {
              background-color: #555;
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
                background-image: url('images/memadd.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
            }
            #del
            {
                background-image: url('images/memdel.png');
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
            #l
            {
                float: left;
            }
            #r
            {
                float: right;
            }
            #main
            {
                width: 85%;
            }
        </style>
    </head>
    <body>
        <?php include("connection1.php"); $res = ""; $res1 = ""; $res2 = ""; $res3 = ""; $res4 = ""; $res5 = ""; $i = "0"; 
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
        <a href = "http://www.techmahindra.com/"><img src = "images/Logo.png" height = "65" align = "right" title="Go to Tech Mahindra official site"></a>
        <font face = "Arial Narrow" color = "red" size = "4"><marquee behavior=alternate scrollamount = "3">Connected World. Connected Technologies.</marquee></font><br /><br />
        
        <table>
            <tr>
                <td width = "79.5%" align = "left"><b>Welcome <i><a href = "https://mybeatplus.techmahindra.com/" target = "_blank" style = "color:#999; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#999'"><?php echo $_SESSION['rname']; echo " (".$_SESSION['usname'].")"; ?></a></i></b></td>
                 <td width = "*" align = "right"><img src = "images/home.png">&thinsp;<a  href = "dashboardadmin.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'"
                    >Home</a> | <img src = "images/question.png"><a href="help.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Help</a> | <img src = "images/contact.png">&thinsp;<a href="contact.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Contact</a> | <img src = "images/Logout.png">&thinsp;<a href = "logout.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Logout</a></td>
            </tr>
        </table>
        <hr>
        <br>
        <center>
            <div id = "main">
                <div id = "l">
                    <div class = "addremove">
                        <button class = "selectopt">Add/Remove project</button>
                        <div class = "selectar">
                            <a href = "NewProject.php" id = "madd">&emsp;Add a project</a>
                            <a href = "removeproject.php" id = "del">&emsp;&emsp;Remove a project</a>
                        </div>
                    </div>
                </div>
                <div id = "r">
                    <form method = "post">
                        <center>
                            <select name = "allprojects[]">
                                <option value = "">----Projects List----</option>
                                <?php
                                    $proque = mysql_query("select ProjectID from projectdetails;");
                                    if(mysql_num_rows($proque))
                                    {
                                        while($proquefet = mysql_fetch_array($proque))
                                        {
                                            echo "<option value = '".$proquefet['ProjectID']."'>".$proquefet['ProjectID']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                            <br><br>
                            <button class = "btnSubmit" type = "submit" name = "resourcebutton">Add/Edit Resources</button>
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
                        </center>
                    </form>
                </div>
            </div>
        </center>
       <br><br>
        <center>
            <tr>
            <td>Search by : </td><td><input type="text" placeholder="Project name.." id="myName" onkeyup="pname()"></td>
            </tr>
        
            </center>
        <br><br>
        <?php
         $tab = mysql_query("select * from projectdetails order by Name ASC;") or die(mysql_error());
        ?>
         <center><table style="border: 1px solid #DDD; text-align: left; border-collapse: collapse; width: 90%;" id="myTable">
                        <tr>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Project Name</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Project ID</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">IBG</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">IBU</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">PGM</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">PM</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Planned Offshore Head Count</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Planned Onsite Head Count</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Actual Offshore Head Count</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Actual Onsite Head Count</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Estimated Contribution</font></th>
                              <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Actual Contribution</font></th>
                        </tr>
                        
                        <?php
                            if(mysql_num_rows($tab))
                            {
                                while($tabv = mysql_fetch_assoc($tab))
                                {
                                    ?>
                                    <tr>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['Name']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['ProjectID']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['IBGHead']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['IBUHead']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['ProgramManager']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['ProjectManager']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['PlannedOffshoreHeadCount']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['PlannedOnsiteHeadCount']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['ActualOffshoreHeadCount']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['ActualOnsiteHeadCount']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['PlannedContribution']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['ActualContribution']; ?></td>
                                        
                                    </tr>
                        
                        
                                    <?php
                                }
                            }
                        ?>  
             </table></center>
        
                      <script>
                        function pname() {
                          var input, filter, table, tr, td, i;
                          input = document.getElementById("myName");
                          filter = input.value.toUpperCase();
                          table = document.getElementById("myTable");
                          tr = table.getElementsByTagName("tr");
                          for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[0];
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
    </body>
    <?php
    if(isset($_POST["resourcebutton"]))
    {
        foreach($_REQUEST['allprojects'] as $selectedProject);
        if($selectedProject == "")
        {
            ?>
            <script>alert("Please select a project to Add/Edit Resources");location.href = "project.php";</script>
            <?php
        }
        $myquery = mysql_query("select Type from projectdetails where ProjectID = '".$selectedProject."';");
        $myquefet = mysql_fetch_assoc($myquery);
        $protype = $myquefet['Type'];
        $_SESSION['pid'] = $selectedProject;
        if($protype == "DEVELOPMENT"){
            ?><script>location.href = "DevResources.php";</script><?php
        }
        if($protype == "SUPPORT")
        {
            ?><script>location.href = "SupResources.php";</script><?php
        }
    }
    ?>
</html>