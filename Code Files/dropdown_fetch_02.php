<?php 
//mysql_connect("localhost", "root", "");
//mysql_select_db("projectprofitability");
session_start();
include("connection1.php");
if(isset($_POST['first_drpdwn_change']))
{
	$ibu=$_POST['ibu_val'];
	$quer = mysql_query("select Name from projectdetails where ProjectManager = '$ibu' ");
	if(mysql_num_rows($quer))
	{
        
		while($fet=mysql_fetch_array($quer))
		{
			   $pgmfet = $fet['Name'];
			   echo "<option value=".$pgmfet.">".$pgmfet."</option>";
		 }
	}
}
?>
