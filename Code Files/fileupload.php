<html>
    <head>
        <title>File Upload</title>
    </head>
    <body>
        <?php
            include("connection1.php");
            $uploadstatus = 0;
            if(isset($_POST["submit"]))
            {
                if(isset($_FILES["file"]))
                {
                    if($_FILES["file"]["error"] > 0)
                    {
                        echo "Return code: ".$_FILES["file"]["error"];
                    }
                    else
                    {
                        if(file_exists($_FILES["files"]["name"]))
                        {
                            unlink($_FILES["files"]["name"]);
                        }
                        $storagename = "UsersList.xls";
                        move_uploaded_file($_FILES["file"]["tmp_name"], $storagename);
                        $uploadstatus = 1;
                        ?>
                        <script>alert("Record has been added");</script>
                        <?php
                    }
                }
                else
                {
                    echo "No file selected";
                }
            }
        ?>
        <center>
            <form name = "upform" action = "fileindex.php" method = "post">
                Upload the Excel file:
                <input type = "file" name = "file" id = "file"><br><br>
                <button class = "btnSubmit" type = "submit" name = "submit">Submit</button>
                <style type = "text/css">
                    .btnSubmit{
                        color: #FF0000;
                        background: #D5D5D5;
                        font-weight: bold;
                        border: 1px solid #D5D5D5;
                    }
                    .btnSubmit:hover {
                      color: #FFF;
                      background: #FF0000;
                    }
                </style>
            </form>
        </center>
    </body>
</html>