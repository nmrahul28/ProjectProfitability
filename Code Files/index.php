<?php session_start(); ?>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login</title>
        <style type = "text/css"> /*Page division measurements*/
            #lt
            {
                width: auto;
                height: auto;
            }
            #md
            {
                width: auto;
                height: auto;
            }
            #rt
            {
                width: "30%";
                height: "70%";
            }
            #footer {           /*Footer style*/
               position: absolute;
               bottom:0;
               width:99%;
               height:50px;
            }
            .login
            {
                font-variant: small-caps;
            }
            input[type=text]
            {
                width: 100%;
                padding: 10px 10px 10px 30px;
                margin: 5px 0;
                box-sizing: border-box;
                border: none;
                border-bottom: 2px solid red;
                background-image: url('images/user.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
            }
            input[type=password]
            {
                width: 100%;
                padding: 10px 10px 10px 30px;
                margin: 5px 0;
                box-sizing: border-box;
                border: none;
                border-bottom: 2px solid red;
                background-image: url('images/password.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
            }
            input[type=email]
            {
                width: 100%;
                padding: 10px 10px 10px 30px;
                margin: 5px 0;
                box-sizing: border-box;
                border: none;
                border-bottom: 2px solid red;
                background-image: url('images/password.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
            }
        </style>
		<script language="javascript"> /*Login Validation*/
			function validate()
			{
				if(document.login.uname.value=="")
				{
					alert("Enter UserName");
					document.login.uname.focus();
					return false;
				}
				if(document.login.pwd.value=="")
				{
					alert("Enter Password");
					document.login.pwd.focus();
					return false;
				}
				else
				{
					return true;
				}
			}
        </script>
        <script>
//            $(document).ready(function () {
//                $("input").attr("autocomplete", "off");
//            });
//            login.setAttribute("autocomplete","off");
//            uname.setAttribute("autocomplete","off");
        </script>
        <script type="text/javascript">
            function mouseoverPass(obj) {
              var obj = document.getElementById('loginpwd');
              obj.type = "email";
            }
            function mouseoutPass(obj) {
              var obj = document.getElementById('loginpwd');
              obj.type = "password";
            }
        </script>
	</head>
	<body>
        <!-- Template Start-->
        <img src = "images/Logo%20left_01.png" height ="75" align = "left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <font face = "algerian" color = "#FF0000" size = "50">Project Profitability</font>
        <a href = "http://www.techmahindra.com/" target="_blank" title = "Go to Tech Mahindra official site"><img src = "images/Logo.png" height = "65" align = "right"></a>
        <font face = "Arial Narrow" color = "red" size = "4"><marquee behavior = "alternate" scrollamount = "3">Connected World. Connected Technologies.</marquee></font><br /><br />
        <table>
            <tr>
                <td width = "90.4%" align = "left"><b>Welcome</b></td>
                <td width = "*" align = "right"><img src = "images/question.png"><a href="help.php" target = "_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'" title = "Go to help page">Help</a> | <img src = "images/contact.png">&thinsp;<a href="contact.php" target="_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'" title = "Contact">Contact</a></td>
            </tr>
        </table>
        <hr>
<!--        Template End-->
        <br><br><br>
        <div id = "lt">
        <div id = "md">
            <br>
            <h3 align = "center" class = "login">Login</h3>
		<?php
            //PHP Code for form validation and dedirection of pages
			include("connection2.php");
			if(isset($_POST["login"]))
			{
				$user=($_POST['uname']);
				$pass=($_POST['pwd']);
                $_SESSION['user'] = $user;
                $_SESSION['pwd'] = $pass;
                $user = $_SESSION['user'];
                $pass = $_SESSION['pwd'];
                //Query to retrieve data from "loginaccess" table from database
				$res = mysqli_query("select * from loginaccess where username='$user' and password='$pass'");				if(mysqli_num_rows($res))
				{
                    //Query to retrieve Role and FName data from database
                    $ret = mysqli_query("select Role,FName from loginaccess where username = '$user'");
                    while($row = mysqli_fetch_assoc($ret)) {  //Fetching data from the database
                        $role = $row["Role"];
                        $en = $row["FName"];
                    }
                    switch($role)
                    {
                        case 'PM': if($pass == "Techm@123$"){ ?><script>alert("Welcome, You need to change your password first before you login");location.href = "newpassword.php";</script><?php } //Redirect to password changing page
                                    if($pass != "Techm@123$")
                                    {
                                        ?><script>alert("Log in Successfull"); location.href = "dashboardpm.php";</script><?php  
                                    }//Redirect to PM dashboard
                                    
                        case 'PGM': if($pass == "Techm@123$"){ ?><script>alert("Welcome, You need to change your password first before you login");location.href = "newpassword.php";</script><?php } //Redirect to password changing page
                                    if($pass != "Techm@123$")
                                    {
                                        ?><script>alert("Log in Successfull"); location.href = "dashboardpgm.php";</script><?php  
                                    }  //Redirect to PGM dashboard
                        case 'IBU': if($pass == "Techm@123$"){ ?><script>alert("Welcome, You need to change your password first before you login");location.href = "newpassword.php";</script><?php } //Redirect to password changing page
                                    if($pass != "Techm@123$")
                                    {
                                        ?><script>alert("Log in Successfull"); location.href = "dashboardibu.php";</script><?php  
                                    }  //Redirect to IBU dashboard
                        case 'IBG': if($pass == "Techm@123$"){ ?><script>alert("Welcome, You need to change your password first before you login");location.href = "newpassword.php";</script><?php } //Redirect to password changing page
                                    if($pass != "Techm@123$")
                                    {
                                        ?><script>alert("Log in Successfull"); location.href = "dashboardibg.php";</script><?php  
                                    }  //Redirect to IBG dashboard
                        case 'Admin': if($pass == "Techm@123$"){ ?><script>alert("Welcome, You need to change your password first before you login");location.href = "newpassword.php";</script><?php } //Redirect to password changing page
                                    if($pass != "Techm@123$")
                                    {
                                        ?><script>alert("Log in Successfull"); location.href = "dashboardadmin.php";</script><?php  
                                    }  //Redirect to Admin dashboard
                    }
                    $_SESSION['usname'] = $en;
                    $_SESSION['rname'] = $role;
				}
				else
				{
					?>
                    <script>
                        alert("Wrong Credentials"); //Appears a pop-up when wrong credentials are entered during login.
                    </script>
                    <?php
                    $var = 0;
				}                
			}
		?>
		<form name="login" method="post" action="" onsubmit="validate();" autocomplete="off">
			<center>
                <table>
                    <tr>
                        <td>Username</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><input type="text" id = "uname" name="uname"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><input type="password" name="pwd" id = "loginpwd"></td>
                        <td><img id = "eye" style="opacity:0.4;filter:alpha(opacity=40);" src = "images/eye_s.png" onMouseOver="mouseoverPass();" onMouseOut = "mouseoutPass();" title = "Show Password"></td>
                    </tr>
                    <tr>
                        <td align = "center"><button class = "btnsubmit" type="submit" name="login">Login</button>
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
                        <td></td>
                    </tr>
			    </table>
            </center>
		</form>
        <div id = "rt">
            </body>
            <center>
                <br><br><br><br><br><footer><hr><strong>Note: </strong>Some features may not work in Internet Explorer, Microsoft Edge and Firefox. Recommended to prefer&thinsp;&thinsp;<a href = "https://www.google.com/chrome/browser/desktop/index.html?brand=CHBD&gclid=EAIaIQobChMI3LWJ3_XQ1AIVz4VoCh00wgD9EAAYASAAEgJ4-vD_BwE" target = "_blank" style = "color:#000000;" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'"><b><font face = "Century Gothic" color = "#3879FC">G</font><font face = "Century Gothic" color = "#E13535">o</font><font face = "Century Gothic" color = "#EBB446">o</font><font face = "Century Gothic" color = "#3879FC">g</font><font face = "Century Gothic" color = "#26A432">l</font><font face = "Century Gothic" color = "#E13535">e</font>&thinsp;<font face = "Century Gothic" color = "#3879FC">Chrome</font></b></a></footer></center>
</html>