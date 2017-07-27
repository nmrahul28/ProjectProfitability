<?php session_start();  
$con="";
$cond="";
?>
<html>
   
    <head>
        <title>Member's Access Page</title>
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
        <hr><br>
        <form method = "post">
            <center>
                <div class = "addremove">
                    <button class = "selectopt">Add/Remove Associate</button>
                    <div class = "selectar">
                        <a href = "addmember.php" id = "madd">&emsp;Add an Associate</a>
                        <a href = "removemember.php" id = "del">&emsp;&emsp;Remove an associate</a>
                    </div>
                </div>
                <br><br><br><br>
                <fieldset>
                    <table>
                        <tr>
                                <td><label>Role: </label><select name = "emprole" id = "emprole">
                                    <option value ="">Any</option>
                                    <option value = "Admin"> Admin</option>
                                    <option value = "IBG"> IBG</option>
                                    <option value = "IBU"> IBU</option>
                                    <option value = "PGM"> PGM</option>
                                    <option value = "PM"> PM</option>
                                     <?php
                                    if($_POST["emprole"]!="")
                                    {
                                        $con="Role = '".$_POST['emprole']."'";
                                        $cond = " where ".$con;
                                    }
                                    ?>
                                </select>
                                </td> 

                            <td><button class = "btnAdd" type = "submit" name = "submit">SUBMIT</button></td>
                        </tr>
                    </table>
                    <br>
                     <table>
                       <tr>
                           <td>Search by:</td><td><input class="w3-input w3-border w3-padding" type="text" placeholder="Employee name.." id="myName" onkeyup="ename()"></td>                
                        </tr>
                  </table>
                    
                </fieldset>
                <br>
                <fieldset>
                    <?php
                 
                       if(isset($_POST["submit"]) &&  ($_POST['emprole']!=""))
                       {
                            $tab = mysql_query("select FName,LName,username,Role from loginaccess ".$cond." order by Role ASC;");
                           echo "<div>Showing ".$con."<br></div>";
                             
                       }
                    else
                    {
                         $tab = mysql_query("select FName,LName,username,Role from loginaccess order by Role ASC;");
                        echo "<div>No Filters<br></div>";
                        
                    }
                   
                    ?>
                    <table style="border: 1px solid #DDD; text-align: left; border-collapse: collapse; width: 90%;" id="myTable">
                        <tr>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Employee Name</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Employee ID</font></th>
                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Role</font></th>
<!--                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Band</font></th>-->
<!--                            <th style="border: 2px solid #DDD; text-align: left; padding: 15px; background-color: #FF0000;"><font color = "#FFFFFF">Location</font></th>-->
                        </tr>
                        
                        <?php
                            if(mysql_num_rows($tab))
                            {
                                while($tabv = mysql_fetch_assoc($tab))
                                {
                                    ?>
                                    <tr>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['FName']." ".$tabv['LName']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['username']; ?></td>
                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['Role']; ?></td>
<!--                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['band']; ?></td>-->
<!--                                        <td style="border: 1px solid #DDD; text-align: left; padding: 15px;"><?php echo $tabv['Location']; ?></td>-->
                                        
                                    </tr>
                        
                        
                                    <?php
                                }
                            }
                        ?>  
                    </table>
                      <script>
                        function ename() {
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
                          
                          
                          
                          function eid() {
                          var input, filter, table, tr, td, i;
                          input = document.getElementById("myId");
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
                          
                          
                          
                          function erole() {
                          var input, filter, table, tr, td, i;
                          input = document.getElementById("myRole");
                          filter = input.value.toUpperCase();
                          table = document.getElementById("myTable");
                          tr = table.getElementsByTagName("tr");
                          for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[2];
                            if (td) {
                              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                              } else {
                                tr[i].style.display = "none";
                              }
                            }
                          }
                        }
                          
                          
                          function eband() {
                          var input, filter, table, tr, td, i;
                          input = document.getElementById("myBand");
                          filter = input.value.toUpperCase();
                          table = document.getElementById("myTable");
                          tr = table.getElementsByTagName("tr");
                          for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[3];
                            if (td) {
                              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                              } else {
                                tr[i].style.display = "none";
                              }
                            }
                          }
                        }
                          
                          
                          function elocation() {
                          var input, filter, table, tr, td, i;
                          input = document.getElementById("myLocation");
                          filter = input.value.toUpperCase();
                          table = document.getElementById("myTable");
                          tr = table.getElementsByTagName("tr");
                          for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[4];
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
                    <style type="text/css">
                        tr:nth-child(even){background-color: #f2f2f2}
                    </style>
                </fieldset>
            </center>
        </form>
        <button onclick="topFunction()" id="myBtn" title="Go to top">^</button>

        <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
        </script>
    </body>
</html>