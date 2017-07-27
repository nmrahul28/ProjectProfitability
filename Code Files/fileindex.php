<?php
    include("connection1.php");
    set_include_path(get_include_path().PATH_SEPARATOR.'Classes/');
    include 'PHPExcel/IOFactory.php';
    $inputfilename = "UsersList.xls";
    try
    {
        $objPHPExcel = PHPExcel_IOFactory::load($inputfilename);
    }
    catch(Exceptio $e)
    {
        die('Error loading file"'.pathinfo($inputfilename,PATHINFO_BASENAME).'": '.getMessage());
    }

    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    $arrayCount = count($allDataInSheet);
    for($i=2;$i<=$arrayCount;$i++)
    {
        $col1 = trim($allDataInSheet[$i]["A"]);
        $col2 = trim($allDataInSheet[$i]["B"]);
        $col3 = trim($allDataInSheet[$i]["C"]);
        
        $query = "SELECT FName FROM loginaccess WHERE FName = '$col1'";
        $sql = mysql_query($query);
        $recResult = mysql_fetch_array($sql);
        $existName = $recResult["FName"];
        if($existName=="") {
            $insertTable= mysql_query("insert into loginaccess(FName, username, Role) values('".$col1."', '".$col2."', '".$col3."');");
            $msg = 'Record has been added.';
        }
        else
        {
            $msg = 'Record already exist.';
        }
    }
    echo $msg;
?>