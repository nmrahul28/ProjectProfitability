<?php
//this page is a copy of resources13 page
require("./connection2.php");//has all connection(bewtween db and project (code)) related commands
session_start();

$temp1=0;//variable to address an year
$temp2=0;//variable to address a row
$submitted=0;//flag to check submit

$bands=array('P2','P1','U4','U3','U2','U1'); //has all bands listed in an array
$onsals=array(0,0,0,0,0,0);//initialise the values of offshore salaries with 0
$offsals=array(0,0,0,0,0,0);//initailise the values of onsite salaries with 0
$onbandcont=array();//array to store contributions of onsite resources 
$offbandcont=array();//array to store contributions of offshore resources 
$offmonthlycont=array(array(array()));//3d array to store the values of offshore contributions, yearwise, monthwise and band wise
$onmonthlycont=array(array(array()));//3d array to store the values of onsite contributions, yearwise, monthwise and band wise

$offyearlycont=array();//to store yearly offshore contributions 
$onyearlycont=array();//to store yearly onsite contributions 

$yearlycont=array();//sum of yearly contributions

$onsum=array(0,0,0,0,0,0);//to count number of onsite resources of the project
$offsum=array(0,0,0,0,0,0);//to count no of offshore rsources of the project
$totalcont=0;//to store the total contribution of the all resources

$projectid=$_SESSION['pid'];//should fetch the project id from the previous page
$projectname="";//should fetch from database, 'projectdetails' table
$projectrevenue=0;//should fetch from database, 'projectdetails' table
$projectdetails="";//should fetch from database, 'projectdetails' table
$noofmonths=0;//should fetch from database, 'projectdetails' table
$noofyears=0;//should fetch from database, 'projectdetails' table

$projectmanagerid="";//should fetch from database, 'projectdetails' table
$projectmanagername="";//should fetch from database, 'projectdetails' table
$programmanagerid="";//should fetch from database, 'projectdetails' table
$programmanagername="";//should fetch from database, 'projectdetails' table
$ibuheadid="";//should fetch from database, 'projectdetails' table
$ibuheadname="";//should fetch from database, 'projectdetails' table
$ibgheadid="";//should fetch from database, 'projectdetails' table
$ibgheadname="";//should fetch from database, 'projectdetails' table

$row=0;
$col=0;
$table="";//part of body storing one tabkle(one year)
$tables="";//part of body containg all tables in the page
$form="";//total body of the page from 'Year' to 'save','submit','clearall'
$results="";//part of the body to print the project details like profit, toatal contribution 
$updatevaluesquery="";//a string to store a command for updating the entered values in a row in the page 
$number=0;

$query="";//appended updatevaluesquery commands of all the updates in the page for all tables
$resupquery="";//result of updatevaluesquery

$projectdetailsquery="SELECT * FROM `projectdetails` WHERE `ProjectID`=".$projectid."";
$resprojectdetailsquery=mysqli_query($conn,$projectdetailsquery);
$row1=mysqli_fetch_assoc($resprojectdetailsquery);

$projectname=$row1['Name'];
$projectrevenue=$row1['Revenue'];
$noofmonths=$row1['NoOfMonths'];
$noofyears=$row1['NoOfYears'];
$ibuheadid=$row1['IBUHeadID'];
$ibgheadid=$row1['IBGHeadID'];
$programmanagerid=$row1['ProgramManagerID'];
$projectmanagerid=$row1['ProjectManagerID'];
$startdate=$row1['StartDate'];
$enddate=$row1['EndDate'];

$ids=array($ibgheadid,$ibuheadid,$programmanagerid,$projectmanagerid);
$names=array();
$number=array(array());

for($num=0;$num<4;$num++)
{
    $empdetailsquery="SELECT * FROM `empdetails` WHERE `ID`='".$ids[$num]."';";
    $resempdetailsquery=mysqli_query($conn,$empdetailsquery);
    $row2=mysqli_fetch_assoc($resempdetailsquery);
    $names[$num]=$row2['FName']." ".$row2['LName'];
}

$ibgheadname=$names[0];
$ibuheadname=$names[1];
$programmanagername=$names[2];
$projectmanagername=$names[3];
    
if($noofmonths%12==0&&$noofmonths%2==0)
{
    $noofyears=($noofmonths/12);
}
else
{
    $noofyears=floor($noofmonths/12)+1;
}

$projectdetails="<center><table style=\"width:40%;border:2px solid black;\"><tr><p><td>Project ID:</td><td>".$projectid."</td> </p></tr><tr><p><td>Project Name:</td><td>".$projectname."</td> </p></tr><tr><p><td>IBG Head:</td><td>".$ibgheadname."</td> </p></tr><tr><p><td>IBU Head :</td><td>".$ibuheadname."</td> </p></tr><tr><p><td>Program Manger :</td><td>".$programmanagername."</td> </p></tr><tr><p><td>Project Manager:</td><td>".$projectmanagername."</td> </p></tr><tr><p><td>Start Date :</td><td>".$startdate."</td> </p></tr><tr><p><td>End Date:</td><td>".$enddate."</td> </p></tr><tr><p><td>No of Months:</td><td>$noofmonths</td></p></tr><tr><p><td>Project Revenue:</td><td>$projectrevenue</td></p></tr></table></center>";



for($i=0;$i<=5;$i++)//to fetch from database and set all maxsals in an array 
{
    $onsalsquery="SELECT `maxSal` FROM `bandsal` WHERE `Location`='ONSITE' AND `Band`='".$bands[$i]."';";
    $resonsalquery=mysqli_query($conn,$onsalsquery);
    $row2=mysqli_fetch_assoc($resonsalquery);
    $onsals[$i]=$row2['maxSal'];
}

for($j=0;$j<=5;$j++)//to fetch from database and set all maxsals in an array 
{
    $offsalsquery="SELECT `maxSal` FROM `bandsal` WHERE `Location`='OFFSHORE' AND `Band`='".$bands[$j]."';";
    $resoffsalquery=mysqli_query($conn,$offsalsquery);
    $row3=mysqli_fetch_assoc($resoffsalquery);
    $offsals[$j]=$row3['maxSal'];
}

$form="<form action=\"Resources12.php\" method='post'><br>";
$tables=$form;
//$tables="<center><table style=\"width:40%;border:2px solid black;\"><tr></tr><tr><td>Revenue</td><td><input type = \"text\" name = \"revenue\" min=\"1\" max=\"1000000000\" value=\"$rev\" size = \"3\"</td></tr></table></center>".$form;

for($temp1=1;$temp1<=$noofyears;$temp1++)//temp1---table or year
{
    $onsum=array(0,0,0,0,0,0);
    $offsum=array(0,0,0,0,0,0);
    
    $table="<br><center><h2>Year ".$temp1."</h2></center><br><center><table style=\"width:80%;border:2px solid #FFFFFF;border-collapse:collapse;\">";
    for($temp2=1;$temp2<=17;$temp2++)//temp2----row in a table
    {
        $table.="<tr>";
        if($temp2==1) 
        {
            $table.="<center><td colspan=\"14\" style=\"border:2px solid #DDD;padding:15px;background-color:#FF0000;\" align = \"center\">&nbsp;<b>OFFSHORE</b></td></center>";
        }
        elseif($temp2==2) 
        {
            $table.="<td style=\"border:1px solid #DDD;padding:15px;\"> Band\Month</td><td>Month 1</td><td>Month 2</td><td>Month 3</td><td>Month 4</td><td>Month 5</td><td>Month 6</td><td>Month 7</td><td>Month 8</td><td>Month 9</td><td>Month 10</td><td>Month 11</td><td>Month 12</td><td>Contribution</td>";
        }
        elseif($temp2>=3 && $temp2<=8){
            for($col=1;$col<=14;$col++)
            {
                if($col==1)
                {
                    $table.="<td>Resource size - ".$bands[$temp2-3]."</td>";
                }
                elseif($col<=13)
                {
                    $varquery="SELECT `M".intval($col-1)."` FROM  `projectresources` WHERE `ProjectID`=$projectid AND `Year`=$temp1 AND `Band`='".$bands[$temp2-3]."' AND `Location`='OFFSHORE';"; 
                    $resvarquery=mysqli_query($conn,$varquery);
                    $row3=mysqli_fetch_assoc($resvarquery);
                    $val=$row3["M".intval($col-1).""];
                    $offsum[$temp2-3]=$offsum[$temp2-3]+$val;
                    $offmonthlycont[$temp1-1][$col-1][$temp2-3]=$val*$offsals[$temp2-3];
                    if($val==0) $val=NULL;
                    if($noofmonths%12!=0 && $temp1==$noofyears && ($col-1)>$noofmonths%12)
                    {
                        $str="<td><output type=\"number\" readonly=\"readonly\" name=t".$temp1."r".intval($temp2-2)."c".intval($col-1)." min=\"0\" max=\"99\" ></output></td>";
                    }
                    else
                    {
                        $str="<td><output type=\"number\" name=t".$temp1."r".intval($temp2-2)."c".intval($col-1)." size=\"2\" min=\"0\" max=\"99\" >$val</output></td>"; 
                    }
                    $table.=$str;
                }
                else
                {
                    $offbandcont[$temp2-3]=($offsum[$temp2-3]*$offsals[$temp2-3]);//band wise contribution calculation
                    $table.="<td><output name=t".$temp1."r".intval($temp2-2)."c".intval($col-1)." size=\"2\">".intval($offbandcont[$temp2-3])."(".floatval(($offbandcont[$temp2-3]/$projectrevenue)*100)."%)</output></td>";//calculation
                }
            }
        }
        elseif($temp2==9) 
        {
            for($col=1;$col<=14;$col++)
            {
                if($col==1)
                {
                    $table.="<td>Monthly Contribution</td>";
                }
                elseif($col<=13)
                {
//                    $offmonthlycont[$temp2-2]=($offsals[$temp2-3])*();
//                    $table.="<td><output name=\"\"></output></td>"; 
                    $table.="<td><output name=t".$temp1."r".intval($temp2-2)."c".intval($col-1)." size=\"2\">".intval(array_sum($offmonthlycont[$temp1-1][$col-1]))."(".floatval(((array_sum($offmonthlycont[$temp1-1][$col-1]))/$projectrevenue)*100)."%)</output></td>"; //calculation
                }
                else
                {
                    //if both array sums are equal...
                    $table.="<td style=\"color:#FF6262;\"><output><b>".array_sum($offbandcont)."(".floatval((array_sum($offbandcont)/$projectrevenue)*100)."%)</b></output></td>"; //calculation
                }
            }
        }
        elseif($temp2==10)
        {
            $table.="<center><td colspan=\"14\" style=\"border:2px solid #DDD;padding:15px;background-color:#FF0000;\" align = \"center\">&nbsp;<b>ONSITE</b></td></center>";
        }
        elseif($temp2>=11 && $temp2<=16)
        {
            for($col=1;$col<=14;$col++)
            {
                if($col==1)
                {
                   $table.="<td> Resourse size - ".$bands[$temp2-11]."</td>";
                }
                elseif($col<=13)
                {
                    $varquery="SELECT M".intval($col-1)." FROM  `projectresources` WHERE `ProjectID`=$projectid AND `Year`=$temp1 AND `Band`='".$bands[$temp2-11]."' AND `Location`='ONSITE';"; 
                    $resvarquery=mysqli_query($conn,$varquery);
                    $row3=mysqli_fetch_assoc($resvarquery);
                    $val=$row3['M'.intval($col-1)];
                    $onsum[$temp2-11]+=$val;
                    $onmonthlycont[$temp1-1][$col-1][$temp2-11]=$val*$onsals[$temp2-11];
                    if($val==0)     $val=NULL;
                    if($noofmonths%12!=0 && $temp1==$noofyears && ($col-1)>$noofmonths%12)//if noofmonths exceeds then dont allow to take input
                    {
                        $str="<td><output type=\"number\" name=t".$temp1."r".intval($temp2-4)."c".intval($col-1)." size=\"2\" min=\"0\" max=\"99\" ></output></td>";
                    }
                    else
                    {
                        $str="<td><output type=\"number\" value=\"".$val."\" name=t".$temp1."r".intval($temp2-4)."c".intval($col-1)." size=\"2\"  min=\"0\" max=\"99\" ></output></td>";
                    }
                    $table.=$str;
                    $onyearlycont[$temp1-1]=array_sum($onmonthlycont[$temp1-1]);
                }
                else
                {
                    $onbandcont[$temp2-11]=($onsum[$temp2-11]*$onsals[$temp2-11]);//contribution calculation
                    $table.="<td><output name=t".$temp1."r".intval($temp2-10)."c".intval($col-1)." size=\"2\">".intval($onbandcont[$temp2-11])."(".floatval(($onbandcont[$temp2-11]/$projectrevenue)*100)."%)</output></td>"; //calculation
                }
            }
        }
        else    //    elseif($temp2==17) 
        {
            for($col=1;$col<=14;$col++)
            {
                if($col==1)
                {
                    $table.="<td>Monthly Contribution</td>";
                }
                elseif($col<=13)
                {
                    $table.="<td><output name=t".$temp1."r".intval($temp2-11)."c".intval($col-1)." size=\"2\">".intval(array_sum($onmonthlycont[$temp1-1][$col-1]))."(".floatval((array_sum($onmonthlycont[$temp1-1][$col-1])/$projectrevenue)*100)."%)</output></td>"; //calculation
                }
                else
                {
//                    $table.="<td style=\"color:#FF6262;\"><output name=\"\"><b>".array_sum($onbandcont)."</b></output></td>"; 
                    $table.="<td style=\"color:#FF6262;\"><output><b>".array_sum($onbandcont)."(".floatval((array_sum($onbandcont)/$projectrevenue)*100)."%)</b></output></td>"; //calculation
                }
            }
        }
        $table.="</tr>";    
    }
    $table.="</table><br>";
    $tables.=$table;
    
    $offyearlycont[$temp1-1]=array_sum($offmonthlycont[$temp1-1][1])+array_sum($offmonthlycont[$temp1-1][2])+array_sum($offmonthlycont[$temp1-1][3])+array_sum($offmonthlycont[$temp1-1][4])+array_sum($offmonthlycont[$temp1-1][5])+array_sum($offmonthlycont[$temp1-1][6])+array_sum($offmonthlycont[$temp1-1][7])+array_sum($offmonthlycont[$temp1-1][8])+array_sum($offmonthlycont[$temp1-1][9])+array_sum($offmonthlycont[$temp1-1][10])+array_sum($offmonthlycont[$temp1-1][11])+array_sum($offmonthlycont[$temp1-1][12]);
    $onyearlycont[$temp1-1]=array_sum($onmonthlycont[$temp1-1][1])+array_sum($onmonthlycont[$temp1-1][2])+array_sum($onmonthlycont[$temp1-1][3])+array_sum($onmonthlycont[$temp1-1][4])+array_sum($onmonthlycont[$temp1-1][5])+array_sum($onmonthlycont[$temp1-1][6])+array_sum($onmonthlycont[$temp1-1][7])+array_sum($onmonthlycont[$temp1-1][8])+array_sum($onmonthlycont[$temp1-1][9])+array_sum($onmonthlycont[$temp1-1][10])+array_sum($onmonthlycont[$temp1-1][11])+array_sum($onmonthlycont[$temp1-1][12]);
    $yearlycont[$temp1-1]=$offyearlycont[$temp1-1]+$onyearlycont[$temp1-1];
    
}

$form=$tables."<br><button class=\"btnButton\" type=\"submit\" name=\"save\">SAVE</button><br><br><button class=\"btnButton\" type=\"submit\" name=\"submit\">SUBMIT</button><br><br><button class=\"btnButton\" type=\"submit\" name=\"clearall\">CLEAR ALL</button><br></form>";
     
    $results.="<div style=background-color:#eee;width:43%;><br>";
    
    for($temp1=1;$temp1<=$noofyears;$temp1++)
    {
        $results.="<div style=background-color:#e7e7e7;width:80%;>"; 
        $results.="<p><output>Year $temp1 Offshore contribution : <b>".intval($offyearlycont[$temp1-1])."</b></output></p>";
        $results.="<p><output>Year $temp1 Onsite contribution : <b>".intval($onyearlycont[$temp1-1])."</b></output></p>";
        $results.="</div><div style=background-color:#cccccc;width:50%;>";
        $results.="<p><output>Year $temp1 total contribution : <b>".intval($yearlycont[$temp1-1])."</b></output></p></div>"; 
        $totalcont+=$yearlycont[$temp1-1];
    }

    $results.="<br></div><br><br><div style=background-color:#bfbfbf;width:20%;>";
    $results.="<br><strong><i>Total Contribution: ".floatval(($totalcont/$projectrevenue)*100)."%</i></strong><br><br>";

    $results.="<strong><i>Profit: ".floatval((($projectrevenue-$totalcont)/$projectrevenue)*100)."%</i></strong><br><br></div>";

if(isset($_POST['save']))
{
//    $("body").css("cursor", "progress");
    ?>
<!--
    <script type="text/javascript">
        window.onload=function(){
            document.body.style.cursor='auto';
        }
    </script>
-->
    <?php
    for($temp1=1;$temp1<=$noofyears;$temp1++)//temp1---year
    {
        $updatevaluesquery="";
        
        for($k=1;$k<=12;$k++)//rows
        {
                $var[1]= $_POST['t'.$temp1.'r'.$k.'c1']; 
                if($_POST['t'.$temp1.'r'.$k.'c1']==NULL) $var[1]=0;
                $var[2]= $_POST['t'.$temp1.'r'.$k.'c2'];           
                if($_POST['t'.$temp1.'r'.$k.'c2']==NULL) $var[2]=0;
                $var[3]= $_POST['t'.$temp1.'r'.$k.'c3'];       
                if($_POST['t'.$temp1.'r'.$k.'c3']==NULL) $var[3]=0;
                $var[4]= $_POST['t'.$temp1.'r'.$k.'c4'];       
                if($_POST['t'.$temp1.'r'.$k.'c4']==NULL) $var[4]=0;
                $var[5]= $_POST['t'.$temp1.'r'.$k.'c5'];       
                if($_POST['t'.$temp1.'r'.$k.'c5']==NULL) $var[5]=0;
                $var[6]= $_POST['t'.$temp1.'r'.$k.'c6'];       
                if($_POST['t'.$temp1.'r'.$k.'c6']==NULL) $var[6]=0;
                $var[7]= $_POST['t'.$temp1.'r'.$k.'c7'];       
                if($_POST['t'.$temp1.'r'.$k.'c7']==NULL) $var[7]=0;
                $var[8]= $_POST['t'.$temp1.'r'.$k.'c8'];       
                if($_POST['t'.$temp1.'r'.$k.'c8']==NULL) $var[8]=0;
                $var[9]= $_POST['t'.$temp1.'r'.$k.'c9'];       
                if($_POST['t'.$temp1.'r'.$k.'c9']==NULL) $var[9]=0;
                $var[10]= $_POST['t'.$temp1.'r'.$k.'c10'];     
                if($_POST['t'.$temp1.'r'.$k.'c10']==NULL) $var[10]=0;
                $var[11]= $_POST['t'.$temp1.'r'.$k.'c11'];     
                if($_POST['t'.$temp1.'r'.$k.'c11']==NULL) $var[11]=0;
                $var[12]= $_POST['t'.$temp1.'r'.$k.'c12'];     
                if($_POST['t'.$temp1.'r'.$k.'c12']==NULL) $var[12]=0;
            
              if($k<=6)  
                {
                    $loc='OFFSHORE';
                    $band=$bands[$k-1];
                }
                else 
                {
                    $loc='ONSITE';
                    $band=$bands[$k-7];
                }          
                
                $updatevaluesquery .= "UPDATE `projectresources` SET `M1`=$var[1],`M2`=$var[2],`M3`=$var[3],`M4`=$var[4],`M5`=$var[5],`M6`=$var[6],`M7`=$var[7],`M8`=$var[8],`M9`=$var[9],`M10`=$var[10],`M11`=$var[11],`M12`=$var[12] WHERE `ProjectID`=$projectid AND  `Year`=".intval($temp1)." AND `LOCATION`='$loc' AND `Band`='".$band."';";
        }
        $query=$query.$updatevaluesquery;
    }
    
    $resupvalquery = mysqli_multi_query($conn,$query) or trigger_error("Query Failed! SQL:  - Error: ".mysqli_error(), E_USER_ERROR) ;
    
    if($resupvalquery) 
    {
        echo "executed";//if part of the query runs, it echos 'executed'
//        print_r($resupvalquery);//what all queries in '$query'
    }
  //  header('location:./Resources8.php');
    
    //echo "<meta http-equiv='refresh' content='0;url='http://localhost/ProjectProfitability/Resources8.php'>";
    header("Refresh:2; url=Resources12.php");
}
//header("Refresh:0; url=Resources8.php");

if(isset($_POST['submit']))
{
    header('location:./FinalResources.php');
}

if(isset($_POST['clearall']))
{
    ?>
    <script type="text/javascript">
          if (confirm("This will erase all the previously entered data"))
              {
                  <?php
                    $clearallquery="DELETE FROM `projectresources` WHERE `ProjectID`=$projectid ;";
                    $resclearallquery=mysqli_query($conn,$clearallquery);
    
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
                        
                        $vals.="($projectid,$year,'$location','$band',0,0,0,0,0,0,0,0,0,0,0,0), ";
                    }
                    $insertzerosquery="INSERT INTO `projectresources` (`ProjectID`, `Year`, `Location`, `Band`, `M1`, `M2`, `M3`, `M4`, `M5`, `M6`, `M7`, `M8`, `M9`, `M10`, `M11`, `M12`) VALUES ".rtrim($vals,", ").";";
                    if (!mysqli_query($conn,$insertzerosquery))
                    {
                        $deleteentryquery="DELETE FROM `projectdetails` WHERE ProjectID=$projectid;";
                        $resdeleteentryquery=mysqli_query($conn,$deleteentryquery);
                        
                       die("<p style=\"color:red;\"> ERROR INSERTING ZEROES<br>".mysqli_error($conn)."</p>");
                    }
                    else
                    {
                        $resinsertzeroesquery = mysqli_query($conn,$insertzerosquery);
                    }
                    ?>
              }
    </script>
<!--
 //----------creating set of rows with zeroes related to this project------------------
 //insert zeros in all years in projectresources table                           
-->                
    <?php      
//-----------------------------------done with creating a new project with zeros filled-------

    header('location:./Resources13.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<title> Resources </title>
    <link rel="stylesheet" type="text/css" href="ResourcePageStyles.css">
    <style type="text/css">
        tr:nth-child(even){background-color: #f2f2f2}
    </style>
    
   
</head>
    
<body>
    <?php 
        echo "<br><br>".$projectdetails;
        echo $form."<br>";
        echo "<br>".$results;
    ?>
    <br><br>
    <div style=border-left:6pxsolid#ffeb3b;background-color:#ffffcc;width:43%;>
    <br><h><strong>NOTE: </strong></h>
    <p>Contribution : Sum of resource cost.</p>
    <p>Monthly Contribution : Sum of resource cost in the month.</p>
    <p style="color:#FF6262;">Contribution = Total resource contribution from that location in that year.</p>        
    <p>Yearly Contribution : Total resource contribution in that year.</p>
        <p><strong><i>Total Contribution : Total resource contribution of the project.</i></strong></p>
        <p><strong><i>Profit : (Revenue-total contribution)/revenue*100.</i></strong></p><br>
    </div>
</body>
</html>