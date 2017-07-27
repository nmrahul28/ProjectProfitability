<?php session_start(); $curr=""; include("connection1.php"); require("./connection2.php"); 
$ibgname = ""; $ibuname = ""; $pgmname = ""; $pmname = "";
?>
<html>
    <head>
        <title>New Project</title>
        <style>
            .t
            {
                font-variant: small-caps;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
          function preventBack(){window.history.forward();}
          setTimeout("preventBack()", 0);
          window.onunload=function(){null};
        </script>
        <script>
            function det()
            {
                if(document.form1.pname.value == "")
                    {
                        alert("Enter all the details to continue");
                        document.form1.pname.focus();
                        return false;
                    }
                if(document.form1.projectid.value == "")
                    {
                        alert("Enter all the details to continue");
                        document.form1.projectid.focus();
                        return false;
                    }
                if(document.form1.sdate.value == "")
                    {
                        alert("Enter all the details to continue");
                        document.form1.sdate.focus();
                        return false;
                    }
                if(document.form1.edate.value == "")
                    {
                        alert("Enter all the details to continue");
                        document.form1.edate.focus();
                        return false;
                    }
                if(document.form1.ibghead.value == "")
                    {
                        alert("Enter all teh details to continue");
                        document.form1.ibghead.focus();
                        return false;
                    }
                if(document.form1.ibuhead.value == "")
                    {
                        alert("Enter all teh details to continue");
                        document.form1.ibuhead.focus();
                        return false;
                    }
                if(document.form1.pgmanager.value == "")
                    {
                        alert("Enter all teh details to continue");
                        document.form1.pgmanager.focus();
                        return false;
                    }
                if(document.form1.pmanager.value == "")
                    {
                        alert("Enter all teh details to continue");
                        document.form1.pmanager.focus();
                        return false;
                    }
                if(document.form1.revenue.value == "")
                    {
                        alert("Enter all teh details to continue");
                        document.form1.revenue.focus();
                        return false;
                    }
            }
        </script>
    </head>
    <body>
        <img src = "images/Logo%20left_01.png" height ="75" align = "left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <font face = "algerian" color = "#FF0000" size = "50">Project Profitability</font>
        <a href = "http://www.techmahindra.com/"><img src = "images/Logo.png" height = "65" align = "right"></a>
        <font face = "Arial Narrow" color = "red" size = "3"><marquee behavior=alternate scrollamount = "3">Connected World. Connected Technologies.</marquee></font><br /><br />
        <table>
            <tr>
                <td width = "84.8%" align = "left"><b>Welcome <i><a href = "https://mybeatplus.techmahindra.com/" target = "_blank" style = "color:#999; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#999'"><?php echo $_SESSION['rname']; echo " (".$_SESSION['usname'].")"; ?></a></i></b></td>
                <td width = "*" align = "right"><img src = "images/question.png"><a href="help.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Help</a> | <img src = "images/contact.png">&thinsp;<a href="home.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Contact</a> | <img src = "images/Logout.png">&thinsp;<a href = "logout.php" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Logout</a></td>
            </tr>
        </table>
        <hr><br><br><br>
<!--        <h3 align = "center">Enter the details of the project</h3>-->
        <center>
            <?php
                
                $bands=array('P2','P1','U4','U3','U2','U1');
                $projectid="''";
            
                if(isset($_POST["submit"]))
                {
                    //store entered values
                    //run sql queries
                    //set check conditions
                    $flag = 0;
                    $pro = "";
                    $date1 = date_create($_POST['sdate']);//read start date
                    $date2 = date_create($_POST['edate']);//read end date
                    
                    $diff = date_diff($date1,$date2,TRUE);//set a check constraint for dates
//                    $sign= $diff->format("%R");
//                    die($sign);
                    $days = $diff->format("%R%a days");
                    $months = ceil($days/30);//assuming no of days in a month=30 
                    
                    //read entered details of a new project
                    $pname = $_POST['pname'];
                    $projectid = $_POST['projectid'];
                    $_SESSION['pid'] = $projectid;
                    $sdate = $_POST['sdate'];
                    $edate = $_POST['edate'];
                    $ibg = $_POST['ibg'];
                    $ibu = $_POST['ibu'];
                    $pm = $_POST['pm'];
                    $pgm = $_POST['pgm'];
                    $revenue= $_POST['revenue'];
//                    $revenue= 0;
                    $curr= $_POST['curr'];
                    $insertcurr= "";
                    
//                    die($ibg.$ibu.$pgm.$pm);
                    
//                    $ibgque = mysql_query("select FName,LName from loginaccess where username = '".$ibg."';");
//                    $ibuque = mysql_query("select FName,LName from loginaccess where username = '".$ibu."';");
//                    $pgmque = mysql_query("select FName,LName from loginaccess where username = '".$pgm."';");
//                    $pmque = mysql_query("select FName,LName from loginaccess where username = '".$pm."';");
                    
//                    die($ibgque.$ibuque.$pgmque.$pmque);
                    
//                    $ibgquefet = mysql_fetch_assoc($ibgque);
//                    $ibgname = $ibgquefet['FName']." ".$ibgquefet['LName'];
//                    
//                    $ibuquefet = mysql_fetch_assoc($ibuque);
//                    $ibuname = $ibuquefet['FName']." ".$ibuquefet['LName'];
//                    
//                    $pgmquefet = mysql_fetch_assoc($pgmque);
//                    $pgmname = $pgmquefet['FName']." ".$pgmquefet['LName'];
//                    
//                    $pmquefet = mysql_fetch_assoc($pmque);
//                    $pmname = $pmquefet['FName']." ".$pmquefet['LName'];
                    
//                    die("Names: ".$ibgname.$ibuname.$pgmname.$pmname." \\End");
                    
                    if(isset($_REQUEST["rad1"]))
                    {
                        $pro = $_REQUEST["rad1"];
                    }
                    $ind=1;
                    $vals="";
                    $noofyears=0;
                    
//                    calculate no of years 
                    if($months%12==0&&$months%2==0)
                    {
                        $noofyears=($months/12);
                    }
                    else
                    {
                        $noofyears=floor($months/12)+1;
                    }
                    if($days < 1)
                    {
                        ?>
                        <script type = "text/javascript">alert("Please choose proper dates.");</script>
                        <?php
                        $flag = 1;
                    }
                    
                    //if already exists
//                   insert the entered details into projectdetails table
                    if($flag == 0)
                    {
                        $insertdetails="INSERT INTO projectdetails(ProjectID,Name,StartDate,EndDate,IBGHead,IBUHead,ProgramManager,ProjectManager,NoOfMonths,NoOfYears,Type,Revenue,currency) VALUES('$projectid','$pname','$sdate','$edate','$ibg','$ibu','$pgm','$pm','$months','$noofyears','$pro','$revenue','$curr');";
                        
                     //-----------------------------------------------------------------------------------------

 //-------------------------------------------------------------------------------------------------------
                        
                        
                        if (!mysqli_query($conn,$insertdetails))
                        {
                            ?><script>alert("ERROR! Enter Valid Project Details <?php mysqli_error($conn); ?>");location.href = "NewProject.php";</script><?php  // mysqli_error($conn);
                        }
                        else
                        {
                            $resinsertdetails = mysqli_query($conn,$insertdetails);
                        }
                    }
                    
                    
                    
                    
//                  fetch no of years from projectdetails table
                    $yearsquery="SELECT `NoOfYears` FROM `projectdetails` WHERE ProjectID='$projectid';";
                    $resyearsquery=mysqli_query($conn,$yearsquery);
                    $row=mysqli_fetch_assoc($resyearsquery);
                    $noofyears=$row['NoOfYears'];                    
                    
                    //insert zeros in all years in projectresources table                
                    for($ind=1;$ind<=$noofyears*12;$ind++)
                    {
                        if($ind%12==0 && $ind%2==0)
                        {
                            $year=($ind/12);
                        }
                        else
                        {
                            $year=floor($ind/12)+1;
                        }
                        if(($ind-1)%12<=5) 
                        {    
                            $location='OFFSHORE';
                        }
                        else 
                        {
                            $location='ONSITE';
                        }
                            $band=$bands[intval(($ind-1)%6)];
                        
                        $vals.="('$projectid',$year,'$location','$band',0,0,0,0,0,0,0,0,0,0,0,0), ";
                    }
//                    for($year=1;$year<=$noofyears;$year++)
//                    {
//                     $vals.="($projectid,$year,'OFFSHORE','P2',0,0,0,0,0,0,0,0,0,0,0,0), ($projectid,$year,'OFFSHORE','P1',0,0,0,0,0,0,0,0,0,0,0,0),($projectid,$year,'OFFSHORE','U4',0,0,0,0,0,0,0,0,0,0,0,0), ($projectid,$year,'OFFSHORE','U3',0,0,0,0,0,0,0,0,0,0,0,0), ($projectid,$year,'OFFSHORE','U2',0,0,0,0,0,0,0,0,0,0,0,0), ($projectid,$year,'OFFSHORE','U1',0,0,0,0,0,0,0,0,0,0,0,0), ($projectid,$year,'ONSITE','P2',0,0,0,0,0,0,0,0,0,0,0,0),($projectid,$year,'ONSITE','P1',0,0,0,0,0,0,0,0,0,0,0,0), ($projectid,$year,'ONSITE','U4',0,0,0,0,0,0,0,0,0,0,0,0), ($projectid,$year,'ONSITE','U3',0,0,0,0,0,0,0,0,0,0,0,0),($projectid,$year,'ONSITE','U2',0,0,0,0,0,0,0,0,0,0,0,0), ($projectid,$year,'ONSITE','U1',0,0,0,0,0,0,0,0,0,0,0,0),";
//                    }
//                    die($vals."");
                    
                    $insertzerosquery="INSERT INTO `projectresources` (`ProjectID`, `Year`, `Location`, `Band`, `M1`, `M2`, `M3`, `M4`, `M5`, `M6`, `M7`, `M8`, `M9`, `M10`, `M11`, `M12`) VALUES ".rtrim($vals,", ").";";
//                    die($insertzerosquery);
//                    
                    if (!mysqli_query($conn,$insertzerosquery))
                    {
                        $deleteentryquery="DELETE FROM `projectdetails` WHERE ProjectID='".$projectid."';";
                        $resdeleteentryquery=mysqli_query($conn,$deleteentryquery);
                        
                       die("<p style=\"color:red;\"> ERROR INSERTING ZEROES".mysqli_error($conn)."</p>");
//         mysqli_query($conn,"DELETE FROM `projectdetails` WHERE  ProjectID=$projectid;");
                    }
                    else
                    {
                        $resinsertzeroesquery = mysqli_query($conn,$insertzerosquery);
                    }
                    
                    //set a check for dates
                    
                    //alert
                    ?>
                    
            <script type="text/javascript">
                alert("Project has been successfully created");
            </script>
            <?php
                    if($pro == "Development")
                    {
                        switch($_SESSION['rname'])
                        {
                            case 'PGM': ?><script>location.href = "DevResources.php"</script><?php
                            case 'IBU': ?><script>location.href = "DevResources.php"</script><?php
                            case 'IBG': ?><script>location.href = "DevResources.php"</script><?php
                            case 'Admin': ?><script>location.href = "DevResources.php"</script><?php
                        }
                    }
                    elseif($pro == "Support")
                    {
                        switch($_SESSION['rname'])
                        {
                            case 'PGM': ?><script>location.href = "SupResources.php"</script><?php
                            case 'IBU': ?><script>location.href = "SupResources.php"</script><?php
                            case 'IBG': ?><script>location.href = "SupResources.php"</script><?php
                            case 'Admin': ?><script>location.href = "SupResources.php"</script><?php
                        }
                    }
                }
            ?>    
            
            <form name = "form1" method="post" onsubmit = "det();" autocomplete="off">
                <fieldset>
                    <div align = "center">
                        <font class = "t" color = "#FF0000" size = "5">Enter the details of the project</font>
                    </div>
                    <div align = "right">
                        <table>
                            <tr>
                                <td><img src = "images/Cancel.png"></td>
                                <td><a 
                                <?php
                                       switch($_SESSION['rname'])
                                       {
                                           case 'PGM':?>href = "dashboardpgm.php"<?php
                                           case 'IBU':?>href = "dashboardibu.php"<?php
                                           case 'IBG':?>href = "dashboardibg.php"<?php
                                           case 'Admin':?>href = "project.php"<?php
                                       }
                                ?>
                                style = "color:#000000;text-decoration:none;" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Cancel</a></td>
                            </tr>
                        </table>
                    </div>
                    <table>
                        <tr>
                            <td>Project ID</td>
                            <td><input type = "text" name = "projectid" size = "16"></td>
                            <td>&emsp;&emsp;</td>
                            <td>Project Name</td>
                            <td><input type = "text" name = "pname" size = "16"></td>
                            <td>&emsp;&emsp;</td>
                        </tr>
                        <tr>
                            <td>Start date</td>
                            <td><input type = "date" name = "sdate" id = "sdate"></td>
                            <td>&emsp;&emsp;</td>
                            <td>End date</td>
                            <td><input type = "date" name = "edate" id = "edate"></td>
                            <td>&emsp;&emsp;</td>
                        </tr>
                    </table>
                    <br><br>
                    <table>
                        <tr>
                            <td>IBG Head</td>
                            <td>
                                <input list="ibg" name="ibg">
                                <datalist id="ibg">
                                <?php
                                   
                                    $que = mysql_query("select FName from loginaccess where Role = 'IBG';");
                                  
                                    if(mysql_num_rows($que))
                                    {
                                        while($rs = mysql_fetch_array($que))
                                        {
                                            ?>
                                            <option value= " <?php echo $rs['FName']; ?>">
                                            <?php
                                        }
                                    }

                                ?>
                                </datalist>
                            </td>
                            <td>&emsp;&emsp;</td>
                            <td>IBU Head</td>
                            <td>
                                <input list="ibu" name="ibu">
                                <datalist id="ibu">
                                <?php
                                   
                                    $que = mysql_query("select FName from loginaccess where Role = 'IBU';");
                                  
                                    if(mysql_num_rows($que))
                                    {
                                        while($rs = mysql_fetch_array($que))
                                        {
                                            ?>
                                            <option value= " <?php echo $rs['FName']; ?>">
                                            <?php
                                        }
                                    }

                                ?>
                                </datalist>
                            </td>
                            <td>&emsp;&emsp;</td>
                        </tr>
                        <tr>
                            <td>Program Manager</td>
                            <td>
                                <input list="pgm" name="pgm">
                                <datalist id="pgm">
                                <?php
                                   
                                    $que = mysql_query("select FName from loginaccess where Role = 'PGM';");
                                  
                                    if(mysql_num_rows($que))
                                    {
                                        while($rs = mysql_fetch_array($que))
                                        {
                                            ?>
                                            <option value= " <?php echo $rs['FName']; ?>">
                                            <?php
                                        }
                                    }

                                ?>
                                </datalist>
                            </td>
                            <td>&emsp;&emsp;</td>
                            <td>Project Manager</td>
                            <td>
                                <input list="pm" name="pm">
                                <datalist id="pm">
                                <?php
                                   
                                    $que = mysql_query("select FName from loginaccess where Role = 'PM';");
                                  
                                    if(mysql_num_rows($que))
                                    {
                                        while($rs = mysql_fetch_array($que))
                                        {
                                            ?>
                                            <option value= " <?php echo $rs['FName']; ?>">
                                            <?php
                                        }
                                    }

                                ?>
                                </datalist>
                            </td>
                            <td>&emsp;&emsp;</td>
                        </tr>
                    </table>
                    <br><br>
                    <table>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                           
                            <td>&emsp;<input type = "radio" name = "rad1" value = "Development">Development</td>
                            <td></td>
                            <td><input type = "radio" name = "rad1" value = "Support">Support</td>
                            <td></td>
                        </tr>
                        <tr></tr>
                        <tr></tr>
                      
                      
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Revenue</td>
                            <td><input type = "text" name = "revenue" size = "16"></td>
                            <td></td>
                            <td> <select name="curr">
                                        <option value="USD" selected="selected">United States Dollars</option>
                                        <option value="EUR">Euro</option>
                                        <option value="GBP">United Kingdom Pounds</option>
                                        <option value="DZD">Algeria Dinars</option>
                                        <option value="ARP">Argentina Pesos</option>
                                        <option value="AUD">Australia Dollars</option>
                                        <option value="ATS">Austria Schillings</option>
                                        <option value="BSD">Bahamas Dollars</option>
                                        <option value="BBD">Barbados Dollars</option>
                                        <option value="BEF">Belgium Francs</option>
                                        <option value="BMD">Bermuda Dollars</option>
                                        <option value="BRR">Brazil Real</option>
                                        <option value="BGL">Bulgaria Lev</option>
                                        <option value="CAD">Canada Dollars</option>
                                        <option value="CLP">Chile Pesos</option>
                                        <option value="CNY">China Yuan Renmimbi</option>
                                        <option value="CYP">Cyprus Pounds</option>
                                        <option value="CSK">Czech Republic Koruna</option>
                                        <option value="DKK">Denmark Kroner</option>
                                        <option value="NLG">Dutch Guilders</option>
                                        <option value="XCD">Eastern Caribbean Dollars</option>
                                        <option value="EGP">Egypt Pounds</option>
                                        <option value="FJD">Fiji Dollars</option>
                                        <option value="FIM">Finland Markka</option>
                                        <option value="FRF">France Francs</option>
                                        <option value="DEM">Germany Deutsche Marks</option>
                                        <option value="XAU">Gold Ounces</option>
                                        <option value="GRD">Greece Drachmas</option>
                                        <option value="HKD">Hong Kong Dollars</option>
                                        <option value="HUF">Hungary Forint</option>
                                        <option value="ISK">Iceland Krona</option>
                                        <option value="INR">India Rupees</option>
                                        <option value="IDR">Indonesia Rupiah</option>
                                        <option value="IEP">Ireland Punt</option>
                                        <option value="ILS">Israel New Shekels</option>
                                        <option value="ITL">Italy Lira</option>
                                        <option value="JMD">Jamaica Dollars</option>
                                        <option value="JPY">Japan Yen</option>
                                        <option value="JOD">Jordan Dinar</option>
                                        <option value="KRW">Korea (South) Won</option>
                                        <option value="LBP">Lebanon Pounds</option>
                                        <option value="LUF">Luxembourg Francs</option>
                                        <option value="MYR">Malaysia Ringgit</option>
                                        <option value="MXP">Mexico Pesos</option>
                                        <option value="NLG">Netherlands Guilders</option>
                                        <option value="NZD">New Zealand Dollars</option>
                                        <option value="NOK">Norway Kroner</option>
                                        <option value="PKR">Pakistan Rupees</option>
                                        <option value="XPD">Palladium Ounces</option>
                                        <option value="PHP">Philippines Pesos</option>
                                        <option value="XPT">Platinum Ounces</option>
                                        <option value="PLZ">Poland Zloty</option>
                                        <option value="PTE">Portugal Escudo</option>
                                        <option value="ROL">Romania Leu</option>
                                        <option value="RUR">Russia Rubles</option>
                                        <option value="SAR">Saudi Arabia Riyal</option>
                                        <option value="XAG">Silver Ounces</option>
                                        <option value="SGD">Singapore Dollars</option>
                                        <option value="SKK">Slovakia Koruna</option>
                                        <option value="ZAR">South Africa Rand</option>
                                        <option value="KRW">South Korea Won</option>
                                        <option value="ESP">Spain Pesetas</option>
                                        <option value="XDR">Special Drawing Right (IMF)</option>
                                        <option value="SDD">Sudan Dinar</option>
                                        <option value="SEK">Sweden Krona</option>
                                        <option value="CHF">Switzerland Francs</option>
                                        <option value="TWD">Taiwan Dollars</option>
                                        <option value="THB">Thailand Baht</option>
                                        <option value="TTD">Trinidad and Tobago Dollars</option>
                                        <option value="TRL">Turkey Lira</option>
                                        <option value="VEB">Venezuela Bolivar</option>
                                        <option value="ZMK">Zambia Kwacha</option>
                                        <option value="EUR">Euro</option>
                                        <option value="XCD">Eastern Caribbean Dollars</option>
                                        <option value="XDR">Special Drawing Right (IMF)</option>
                                        <option value="XAG">Silver Ounces</option>
                                        <option value="XAU">Gold Ounces</option>
                                        <option value="XPD">Palladium Ounces</option>
                                        <option value="XPT">Platinum Ounces</option>
                              
                                </select></td>
                    </tr>
                        <tr>
                           
                        </tr>
                    </table>
                    <br><br>
                    <table>
                        <tr>
                            <td></td>
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
                            <td><button class = "btnSubmit1" type = "reset" name = "reset">Reset</button>
                                <style type = "text/css">
                                    .btnSubmit1{
                                        color: #FF0000;
                                        background: #D5D5D5;
                                        font-weight: bold;
                                        border: 1px solid #D5D5D5;
                                        border-radius: 8px;
                                        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
                                    }
                                    .btnSubmit1:hover {
                                      color: #FFF;
                                      background: #FF0000;
                                    }
                                </style>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </center>
    </body>
</html>