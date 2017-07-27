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
$table="";//part of body storing one table(one year)
$tables="";//part of body containg all tables in the page
$form="";//total body of the page from 'Year' to 'save','submit','clearall'
$results="";//part of the body to print the project details like profit, toatal contribution 
$updatevaluesquery="";//a string to store a command for updating the entered values in a row in the page 
$number=0;

$query="";//appended updatevaluesquery commands of all the updates in the page for all tables
$resupquery="";//result of updatevaluesquery

$projectdetailsquery="SELECT * FROM `projectdetails` WHERE `ProjectID`='".$projectid."';";
$resprojectdetailsquery=mysqli_query($conn,$projectdetailsquery);
$row1=mysqli_fetch_assoc($resprojectdetailsquery);

$projectname=$row1['Name'];
$projectrevenue=$row1['Revenue'];
$noofmonths=$row1['NoOfMonths'];
$noofyears=$row1['NoOfYears'];
$ibuheadname=$row1['IBUHead'];
$ibgheadname=$row1['IBGHead'];
$programmanagername=$row1['ProgramManager'];
$projectmanagername=$row1['ProjectManager'];
$startdate=$row1['StartDate'];
$enddate=$row1['EndDate'];
$currency=$row1['Currency'];

$number=array(array());

if($noofmonths%12==0&&$noofmonths%2==0)
{
    $noofyears=($noofmonths/12);
}
else
{
    $noofyears=floor($noofmonths/12)+1;
}

$projectdetails="<font><center><table style=\"width:90%;border:2px solid black;\"><tr><p><td><b>Project ID:</b></td><td>".$projectid."</td> </p><p><td><b>Project Name:</b></td><td>".$projectname."</td> </p></tr><tr><p><td><b>IBG Head:</b></td><td>".$ibgheadname."</td> </p><p><td><b>IBU Head :</b></td><td>".$ibuheadname."</td> </p></tr><tr><p><td><b>Program Manger :</b></td><td>".$programmanagername."</td> </p><p><td><b>Project Manager:</b></td><td>".$projectmanagername."</td> </p></tr><tr><p><td><b>Start Date :</b></td><td>".$startdate."</td> </p><p><td><b>End Date:</b></td><td>".$enddate."</td> </p></tr><tr><p><td><b>No of Months:</b></td><td>$noofmonths</td></p><p><td><b>Project Revenue:</b></td><td>$projectrevenue</td></p></tr></table></center></font>";


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

$form="<form action=\"\" method='post'><br>";
$tables=$form."<h1 align = 'center' class = 'tabletitle'>Forecasted Details</h1>";

for($temp1=1;$temp1<=$noofyears;$temp1++)//temp1---table or year
{
    $onsum=array(0,0,0,0,0,0);
    $offsum=array(0,0,0,0,0,0);
    
    $table="<center><h2>Year ".$temp1."</h2><table style=\"width:90%;border:2px solid #FFFFFF;border-collapse:collapse;\">";
    for($temp2=1;$temp2<=17;$temp2++)//temp2----row in a table
    {
        $table.="<tr>";
        if($temp2==1) 
        {
            $table.="<center><td colspan=\"15\" style=\"border:2px solid #DDD;padding:15px;background-color:#FF0000;\" align = \"center\">&nbsp;<b>OFFSHORE</b></td></center>";
        }
        elseif($temp2==2) 
        {
            $table.="<td style=\"border:1px solid #DDD;padding:15px;\"> Band\Month</td><td>Month 1</td><td>Month 2</td><td>Month 3</td><td>Month 4</td><td>Month 5</td><td>Month 6</td><td>Month 7</td><td>Month 8</td><td>Month 9</td><td>Month 10</td><td>Month 11</td><td>Month 12</td><td>Rate</td><td>Contribution</td>";
        }
        elseif($temp2>=3 && $temp2<=8){
            for($col=1;$col<=14;$col++)
            {
                if($col==1)
                {
                    $table.="<td>HeadCount :<br>".$bands[$temp2-3]."</td>";
                }
                elseif($col<=13)
                {
                    $varquery="SELECT `M".intval($col-1)."` FROM  `projectresources` WHERE `ProjectID`='$projectid' AND `Year`=$temp1 AND `Band`='".$bands[$temp2-3]."' AND `Location`='OFFSHORE';"; 
                    $resvarquery=mysqli_query($conn,$varquery);
                    $row3=mysqli_fetch_assoc($resvarquery);
                    $val=$row3["M".intval($col-1).""];
                    $offsum[$temp2-3]=$offsum[$temp2-3]+$val;
                    $offmonthlycont[$temp1-1][$col-1][$temp2-3]=$val*$offsals[$temp2-3];
                    if($val==0) $val=NULL;
                    if($noofmonths%12!=0 && $temp1==$noofyears && ($col-1)>$noofmonths%12)
                    {
                        $str="<td><output type=\"number\" readonly=\"readonly\" name=t".$temp1."r".intval($temp2-2)."c".intval($col-1)." size=\"2\" min=\"0\" max=\"99\" ></output></td>";
                    }
                    else
                    {
                        $str="<td><output type=\"number\" value=\"".$val."\" name=t".$temp1."r".intval($temp2-2)."c".intval($col-1)." size=\"2\" min=\"0\" max=\"99\" >$val</output></td>"; 
                    }
                    $table.=$str;
                }
                else
                {
                    $offbandcont[$temp2-3]=($offsum[$temp2-3]*$offsals[$temp2-3]);//band wise contribution calculation
                    $table.="<td><output name=t".$temp1."r".intval($temp2-2)."c".intval($col-1)." size=\"2\">".intval($offbandcont[$temp2-3])."<td>".number_format((($projectrevenue-($offbandcont[$temp2-3]))/$projectrevenue)*100,3)." %</output></td>";//calculation
                }
            }
        }
        elseif($temp2==9) 
        {
            for($col=1;$col<=14;$col++)
            {
                if($col==1)
                {
                    $table.="<td>Monthly Contribution($currency)</td>";
                }
                elseif($col<=13)
                {
                    $table.="<td><output name=t".$temp1."r".intval($temp2-2)."c".intval($col-1)." size=\"2\">".intval(array_sum($offmonthlycont[$temp1-1][$col-1]))."<br>(".number_format((($projectrevenue-array_sum($offmonthlycont[$temp1-1][$col-1]))/$projectrevenue)*100,3)."%)</output></td>"; //calculation
                }
                else
                {
                    //if both array sums are equal...
                    $table.="<td style=\"color:#FF6262;\"><output><b>".array_sum($offbandcont)."<td>".number_format(((($projectrevenue-array_sum($offbandcont)))/$projectrevenue)*100,3)." %</b></output></td>"; //calculation
                }
            }
        }
        elseif($temp2==10)
        {
            $table.="<center><td colspan=\"15\" style=\"border:2px solid #DDD;padding:15px;background-color:#FF0000;\" align = \"center\">&nbsp;<b>ONSITE</b></td></center>";
        }
        elseif($temp2>=11 && $temp2<=16)
        {
            for($col=1;$col<=14;$col++)
            {
                if($col==1)
                {
                   $table.="<td> HeadCount :<br>".$bands[$temp2-11]."</td>";
                }
                elseif($col<=13)
                {
                    $varquery="SELECT M".intval($col-1)." FROM  `projectresources` WHERE `ProjectID`='$projectid' AND `Year`=$temp1 AND `Band`='".$bands[$temp2-11]."' AND `Location`='ONSITE';"; 
                    $resvarquery=mysqli_query($conn,$varquery);
                    $row3=mysqli_fetch_assoc($resvarquery);
                    $val=$row3['M'.intval($col-1)];
                    $onsum[$temp2-11]+=$val;
                    $onmonthlycont[$temp1-1][$col-1][$temp2-11]=$val*$onsals[$temp2-11];
                    if($val==0)     $val=NULL;
                    if($noofmonths%12!=0 && $temp1==$noofyears && ($col-1)>$noofmonths%12)//if noofmonths exceeds then dont allow to take input
                    {
                        $str="<td><output type=\"number\"  readonly=\"readonly\" name=t".$temp1."r".intval($temp2-4)."c".intval($col-1)." size=\"2\" min=\"0\" max=\"99\" ></output></td>";
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
                    $table.="<td><output name=t".$temp1."r".intval($temp2-10)."c".intval($col-1)." size=\"2\">".intval($onbandcont[$temp2-11])."<td>".number_format((($projectrevenue-($onbandcont[$temp2-11]))/$projectrevenue)*100,3)." %</output></td>"; //calculation
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
                    $table.="<td><output name=t".$temp1."r".intval($temp2-11)."c".intval($col-1)." size=\"2\">".intval(array_sum($onmonthlycont[$temp1-1][$col-1]))."<br>(".number_format((($projectrevenue-array_sum($onmonthlycont[$temp1-1][$col-1]))/$projectrevenue)*100,3)."%)</output></td>"; //calculation
                }
                else
                {
                    $table.="<td style=\"color:#FF6262;\"><output><b>".array_sum($onbandcont)."<td>".number_format((($projectrevenue-(array_sum($onbandcont)))/$projectrevenue)*100,3)." %</b></output></td>"; //calculation
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

$form=$tables."</form>";

    $totcontributionquery="SELECT SUM(Contribution) FROM projectresources WHERE ProjectID='$projectid';";
    $rstotcont=mysqli_query($conn,$totcontributionquery);
    $fet=mysqli_fetch_assoc($rstotcont);
    $totalcontribution=$fet['SUM(Contribution)'];//formula and calculation

    $ratequery="SELECT SUM(Rate) FROM projectresources WHERE ProjectID='$projectid';";
    $rsratequery=mysqli_query($conn,$ratequery);
    $fet=mysqli_fetch_assoc($rsratequery);
    $totalrate=$fet['SUM(Rate)'];
    $profit=floatval((($projectrevenue-$totalrate)/$projectrevenue)*100);//formula and calculation
    
    $form=$tables." </fieldset></form>";

    $results.="<br><center><div style=background-color:#bfbfbf;width:20%;>";
    $results.="<br><strong><i>Total Contribution: ".$totalcontribution." %</i></strong><br><br>";

    $results.="<strong><i>Profit: ".$profit." %</i></strong><br><br></div></center>";
//-----------------------------------------------------------------------------------------------------

$table1="";//part of body storing one table(one year)
$tables1="";//part of body containg all tables in the page
$form1="";//total body of the page from 'Year' to 'save','submit','clearall'
$results1="";//part of the body to print the project details like profit, toatal contribution 
$updatevaluesquery="";//a string to store a command for updating the entered values in a row in the page 
$number=0;

$query="";//appended updatevaluesquery commands of all the updates in the page for all tables
$resupquery="";//result of updatevaluesquery

$form1="<form action=\"\" method='post'><br>";
$tables1=$form1."<h1 align = 'center' class = 'tabletitle'>Actual Details</h1>";

for($temp1=1;$temp1<=$noofyears;$temp1++)//temp1---table or year
{
    $onsum=array(0,0,0,0,0,0);
    $offsum=array(0,0,0,0,0,0);
    
    $table1="<center><h2>Year ".$temp1."</h2><table style=\"width:90%;border:2px solid #FFFFFF;border-collapse:collapse;\">";
    for($temp2=1;$temp2<=17;$temp2++)//temp2----row in a table
    {
        $table1.="<tr>";
        if($temp2==1) 
        {
            $table1.="<center><td colspan=\"15\" style=\"border:2px solid #DDD;padding:15px;background-color:#FF0000;\" align = \"center\">&nbsp;<b>OFFSHORE</b></td></center>";
        }
        elseif($temp2==2) 
        {
            $table1.="<td style=\"border:1px solid #DDD;padding:15px;\"> Band\Month</td><td>Month 1</td><td>Month 2</td><td>Month 3</td><td>Month 4</td><td>Month 5</td><td>Month 6</td><td>Month 7</td><td>Month 8</td><td>Month 9</td><td>Month 10</td><td>Month 11</td><td>Month 12</td><td>Rate</td><td>Contribution</td>";
        }
        elseif($temp2>=3 && $temp2<=8){
            for($col=1;$col<=14;$col++)
            {
                if($col==1)
                {
                    $table1.="<td>HeadCount :<br>".$bands[$temp2-3]."</td>";
                }
                elseif($col<=13)
                {
                    $varquery="SELECT `M".intval($col-1)."` FROM  `actualprojectresources` WHERE `ProjectID`='$projectid' AND `Year`=$temp1 AND `Band`='".$bands[$temp2-3]."' AND `Location`='OFFSHORE';"; 
                    $resvarquery=mysqli_query($conn,$varquery);
                    $row3=mysqli_fetch_assoc($resvarquery);
                    $val=$row3["M".intval($col-1).""];
                    $offsum[$temp2-3]=$offsum[$temp2-3]+$val;
                    $offmonthlycont[$temp1-1][$col-1][$temp2-3]=$val*$offsals[$temp2-3];
                    if($val==0) $val=NULL;
                    if($noofmonths%12!=0 && $temp1==$noofyears && ($col-1)>$noofmonths%12)
                    {
                        $str="<td><output type=\"number\" readonly=\"readonly\" name=t".$temp1."r".intval($temp2-2)."c".intval($col-1)." size=\"2\" min=\"0\" max=\"99\" ></output></td>";
                    }
                    else
                    {
                        $str="<td><output type=\"number\" value=\"".$val."\" name=t".$temp1."r".intval($temp2-2)."c".intval($col-1)." size=\"2\" min=\"0\" max=\"99\" >$val</output></td>"; 
                    }
                    $table1.=$str;
                }
                else
                {
                    $offbandcont[$temp2-3]=($offsum[$temp2-3]*$offsals[$temp2-3]);//band wise contribution calculation
                    $table1.="<td><output name=t".$temp1."r".intval($temp2-2)."c".intval($col-1)." size=\"2\">".intval($offbandcont[$temp2-3])."<td>".floatval(($offbandcont[$temp2-3]/$projectrevenue)*100)." %</output></td>";//calculation
                }
            }
        }
        elseif($temp2==9) 
        {
            for($col=1;$col<=14;$col++)
            {
                if($col==1)
                {
                    $table1.="<td>Monthly Contribution($currency)</td>";
                }
                elseif($col<=13)
                {
//                    $offmonthlycont[$temp2-2]=($offsals[$temp2-3])*();
//                    $table.="<td><output name=\"\"></output></td>"; 
                    $table1.="<td><output name=t".$temp1."r".intval($temp2-2)."c".intval($col-1)." size=\"2\">".intval(array_sum($offmonthlycont[$temp1-1][$col-1]))."<br>(".floatval(((array_sum($offmonthlycont[$temp1-1][$col-1]))/$projectrevenue)*100)."%)</output></td>"; //calculation
                }
                else
                {
                    //if both array sums are equal...
                    $table1.="<td style=\"color:#FF6262;\"><output><b>".array_sum($offbandcont)."<td>".floatval((array_sum($offbandcont)/$projectrevenue)*100)." %</b></output></td>"; //calculation
                }
            }
        }
        elseif($temp2==10)
        {
            $table1.="<center><td colspan=\"15\" style=\"border:2px solid #DDD;padding:15px;background-color:#FF0000;\" align = \"center\">&nbsp;<b>ONSITE</b></td></center>";
        }
        elseif($temp2>=11 && $temp2<=16)
        {
            for($col=1;$col<=14;$col++)
            {
                if($col==1)
                {
                   $table1.="<td> HeadCount :<br>".$bands[$temp2-11]."</td>";
                }
                elseif($col<=13)
                {
                    $varquery="SELECT M".intval($col-1)." FROM  `actualprojectresources` WHERE `ProjectID`='$projectid' AND `Year`=$temp1 AND `Band`='".$bands[$temp2-11]."' AND `Location`='ONSITE';"; 
                    $resvarquery=mysqli_query($conn,$varquery);
                    $row3=mysqli_fetch_assoc($resvarquery);
                    $val=$row3['M'.intval($col-1)];
                    $onsum[$temp2-11]+=$val;
                    $onmonthlycont[$temp1-1][$col-1][$temp2-11]=$val*$onsals[$temp2-11];
                    if($val==0)     $val=NULL;
                    if($noofmonths%12!=0 && $temp1==$noofyears && ($col-1)>$noofmonths%12)//if noofmonths exceeds then dont allow to take input
                    {
                        $str="<td><output type=\"number\"  readonly=\"readonly\" name=t".$temp1."r".intval($temp2-4)."c".intval($col-1)." size=\"2\" min=\"0\" max=\"99\" ></output></td>";
                    }
                    else
                    {
                        $str="<td><output type=\"number\" value=\"".$val."\" name=t".$temp1."r".intval($temp2-4)."c".intval($col-1)." size=\"2\"  min=\"0\" max=\"99\" ></output></td>";
                    }
                    $table1.=$str;
                    $onyearlycont[$temp1-1]=array_sum($onmonthlycont[$temp1-1]);
                }
                else
                {
                    $onbandcont[$temp2-11]=($onsum[$temp2-11]*$onsals[$temp2-11]);//contribution calculation
                    $table1.="<td><output name=t".$temp1."r".intval($temp2-10)."c".intval($col-1)." size=\"2\">".intval($onbandcont[$temp2-11])."<td>".floatval(($onbandcont[$temp2-11]/$projectrevenue)*100)." %</output></td>"; //calculation
                }
            }
        }
        else    //    elseif($temp2==17) 
        {
            for($col=1;$col<=14;$col++)
            {
                if($col==1)
                {
                    $table1.="<td>Monthly Contribution ($currency)</td>";
                }
                elseif($col<=13)
                {
                    $table1.="<td><output name=t".$temp1."r".intval($temp2-11)."c".intval($col-1)." size=\"2\">".intval(array_sum($onmonthlycont[$temp1-1][$col-1]))."<br>(".floatval((array_sum($onmonthlycont[$temp1-1][$col-1])/$projectrevenue)*100)."%)</output></td>"; //calculation
                }
                else
                {
                    $table1.="<td style=\"color:#FF6262;\"><output><b>".array_sum($onbandcont)."<td>".floatval((array_sum($onbandcont)/$projectrevenue)*100)." %</b></output></td>"; //calculation
                }
            }
        }
        $table1.="</tr>";    
    }
    $table1.="</table><br>";
    $tables1.=$table1;
    
    $offyearlycont[$temp1-1]=array_sum($offmonthlycont[$temp1-1][1])+array_sum($offmonthlycont[$temp1-1][2])+array_sum($offmonthlycont[$temp1-1][3])+array_sum($offmonthlycont[$temp1-1][4])+array_sum($offmonthlycont[$temp1-1][5])+array_sum($offmonthlycont[$temp1-1][6])+array_sum($offmonthlycont[$temp1-1][7])+array_sum($offmonthlycont[$temp1-1][8])+array_sum($offmonthlycont[$temp1-1][9])+array_sum($offmonthlycont[$temp1-1][10])+array_sum($offmonthlycont[$temp1-1][11])+array_sum($offmonthlycont[$temp1-1][12]);
    $onyearlycont[$temp1-1]=array_sum($onmonthlycont[$temp1-1][1])+array_sum($onmonthlycont[$temp1-1][2])+array_sum($onmonthlycont[$temp1-1][3])+array_sum($onmonthlycont[$temp1-1][4])+array_sum($onmonthlycont[$temp1-1][5])+array_sum($onmonthlycont[$temp1-1][6])+array_sum($onmonthlycont[$temp1-1][7])+array_sum($onmonthlycont[$temp1-1][8])+array_sum($onmonthlycont[$temp1-1][9])+array_sum($onmonthlycont[$temp1-1][10])+array_sum($onmonthlycont[$temp1-1][11])+array_sum($onmonthlycont[$temp1-1][12]);
    $yearlycont[$temp1-1]=$offyearlycont[$temp1-1]+$onyearlycont[$temp1-1];
    
}

    $form1=$tables1."</form>";

    $totcontributionquery="SELECT SUM(Contribution) FROM actualprojectresources WHERE ProjectID='$projectid';";
    $rstotcont=mysqli_query($conn,$totcontributionquery);
    $fet=mysqli_fetch_assoc($rstotcont);
    $totalcontribution1=$fet['SUM(Contribution)'];//formula and calculation

    $ratequery="SELECT SUM(Rate) FROM `actualprojectresources` WHERE ProjectID='$projectid';";
    $rsratequery=mysqli_query($conn,$ratequery);
    $fet=mysqli_fetch_assoc($rsratequery);
    $totalrate1=$fet['SUM(Rate)'];
    $profit1=floatval((($projectrevenue-$totalrate1)/$projectrevenue)*100);//formula and calculation
    
    $form1=$tables1." </fieldset></form>";

    $results1.="<br><center><div style=background-color:#bfbfbf;width:20%;>";
    $results1.="<br><strong><i>Total Contribution: ".$totalcontribution1." %</i></strong><br><br>";

    $results1.="<strong><i>Profit: ".$profit1." %</i></strong><br><br></div></center>";

?>
<!DOCTYPE html>
<html>
<head>
<title> Resources </title>
    <link rel="stylesheet" type="text/css" href="ResourcePageStyles.css">
    <style type="text/css">
        tr:nth-child(even){background-color: #f2f2f2}
        .tabletitle
        {
            font-variant: small-caps;
        }
    </style>
</head>
    
<body>
    <?php 
        echo "<br><br>".$projectdetails;
        echo $form;
        echo $results;
        
        echo $form1;
        echo $results1;
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