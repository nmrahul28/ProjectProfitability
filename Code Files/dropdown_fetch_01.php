<?php 
//mysql_connect("localhost", "root", "");
//mysql_select_db("projectprofitability");
session_start();
include("connection1.php");
if(isset($_POST['first_drpdwn_change']))
{
	$ibu=$_POST['ibu_val'];
	$quer = mysql_query("select ProjectManager from projectdetails where ProgramManager = '$ibu' group by ProjectManager ");
	if(mysql_num_rows($quer))
	{
        
		while($fet=mysql_fetch_array($quer))
		{
			   $pgmfet = $fet['ProjectManager'];
			   echo "<option value=".$pgmfet.">".$pgmfet."</option>";
		 }
	}
}
if(isset($_POST['third_drpdwn_change']))
{
    $pm = $_POST['pm_val'];
    $quer = mysql_query("select Name from projectdetails where ProjectManager = '$pm' ");
    if(mysql_num_rows($quer))
    {
        while($fet = mysql_fetch_array($quer))
        {
            $pjfet = $fet['Name'];
            echo "<option value=".$pjfet.">".$pjfet."</option>";
        }
    }
}
?>
