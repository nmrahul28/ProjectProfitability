<?php session_start(); include("connection1.php"); ?>
<html>
    <head>
        <title>New Password</title>
        <script type = "text/javascript">
            function pwdvalidate()
            {
                if(document.pwdform.epwd.value == document.pwdform.npwd.value)
                {
                    alert("Existing Password and New Password shouldn't be same.");
                    location.href = "resetpwd.php";
                }
                if(document.pwdform.npwd.value != document.pwdform.rnpwd.value)
                {
                    alert("Re-entered Password didn't match");
                    location.href = "resetpwd.php";
                }
            }
        </script>
        <style type = "text/css">
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
            input[type=text]
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
        <script type = "text/javascript">
            function mouseoverPass(obj) {
              var obj = document.getElementById('npwd');
                var obj1 = document.getElementById('rnpwd');
                var obj2 = document.getElementById('epwd');
              obj.type = "text";
                obj1.type = "text";
                obj2.type = "text";
            }
            function mouseoutPass(obj) {
              var obj = document.getElementById('npwd');
                var obj1 = document.getElementById('rnpwd');
                var obj2 = document.getElementById('epwd');
              obj.type = "password";
                obj1.type = "password";
                obj2.type = "password";
            }
        </script>
        <script type = "text/javascript">
            var pass_strength;
            function IsEnoughLength(str,length){
                if((str == null) || isNaN(length)) return false; else if (str.length < length) return false; return true;
            }
            function HasMixedCase(passwd){
                if(passwd.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) return true; else return false;
            }
            function HasNumeral(passwd){
                if(passwd.match(/[0-9]/))
                    return true;
                else
                    return false;
            }
            function HasSpecialChars(passwd)
            {
                if(passwd.match(/.[!,@,#,$,%,^,&,*,?,_,~]/))
                    return true;
                else
                    return false;
            }
            function CheckPasswordStrength(pwd)
            {
                if(IsEnoughLength(pwd,14) && HasMixedCase(pwd) && HasNumeral(pwd) && HasSpecialChars(pwd))
                    pass_strength = "<b><font style = 'color: #17E902;' size = '2'>Very Strong</font></b>";
                else if(IsEnoughLength(pwd,11) && HasMixedCase(pwd) && HasNumeral(pwd) && HasSpecialChars(pwd))
                    pass_strength = "<b><font style = 'color: #10AB00;' size = '2'>Strong</font></b>";
                else if(IsEnoughLength(pwd,8) && HasMixedCase(pwd) && HasNumeral(pwd) && HasSpecialChars(pwd))
                    pass_strength = "<b><font style = 'color: #E9BF02;' size = '2'>Good</font></b>";
                else if(IsEnoughLength(pwd,5) && HasMixedCase(pwd))
                    pass_strength = "<b><font style = 'color: #E98002;' size = '2'>Not Good</font></b>";
                else
                    pass_strength = "<b><font style = 'color: #E92802;' size = '2'>Weak</font></b>";
                document.getElementById('pwd_strength').innerHTML = pass_strength;
            }
            function StrengthRes()
            {
                pass_strength = "";
                document.getElementById('pwd_strength').innerHTML = pass_strength;
            }
        </script>
    </head>
    <body>
        <?php
//            if($_SESSION['rname'] == "" || $_SESSION['usname'] == "")
//            {
//                ?>
<!--//                <script>alert("Please login to continue");location.href = "Login.php";</script>-->
               <?php
//            }
//            $pwdcheck = mysql_query("select password from loginaccess where username = '".$_SESSION['user']."';");
//            $existpwd = mysql_fetch_assoc($pwdcheck);
//            if($existpwd['password'] != "Techm123$")
//            {
//                //If other than admin tries to access this page, redirects to login page.
//                ?>
<!--//                <script>alert("You have no access to this page");alert("You have been logged out. Please log in again.");location.href = "logout.php";</script>-->
                <?php
//            }
        ?>
        <img src = "images/Logo%20left_01.png" height ="75" align = "left">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <font face = "algerian" color = "#FF0000" size = "50">Project Profitability</font>
        <img src = "images/Logo.png" height = "65" align = "right">
        <font face = "Arial Narrow" color = "red" size = "4"><marquee behavior=alternate scrollamount = "3">Connected World. Connected Technologies.</marquee></font><br /><br />
        <table>
            <tr>
                <td width = "90.5%" align = "left"><b>Welcome</b></td>
                <td width = "*" align = "right"><img src = "images/question.png"><a href="help.php" target = "_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Help</a> | <img src = "images/contact.png">&thinsp;<a href="contact.php" target = "_blank" style = "color:#000000; text-decoration:none" onMouseOver = "this.style.color = '#FF0000'" onMouseOut = "this.style.color = '#000000'">Contact</a></td>
            </tr>
        </table>
        <hr><br><br><br><br><br><br>
        <?php
            if(isset($_POST["submit"]))
            {
                $epwd = $_POST['epwd'];
                $npwd = $_POST['npwd'];
                $rnpwd = $_POST['rnpwd'];
                $pwdque = mysql_query("select password from loginaccess where username = '".$_SESSION['user']."';");
                $oldpwd = mysql_fetch_assoc($pwdque);
                if($epwd != $oldpwd['password'])
                {
                    ?>
                    <script type = "text/javascript">alert("Existing Password is wrong.");location.href = "resetpwd.php";</script>
                    <?php
                }
                if($npwd == $_SESSION['usname'] || $npwd == $_SESSION['user'] || $npwd == $_SESSION['rname'] || $npwd == "Tech Mahindra" || $npwd == "TechMahindra" || $npwd == "Techmahindra" || $npwd == "techmahindra" || $npwd == "tech mahindra")
                {
                    ?>
                    <script type = "text/javascript">alert("Password shouldn't be same as Username or Employee name or Employye role or Organization name.");</script>
                    <?php
                }
                if($npwd == $rnpwd)
                {
                    $updatepwd = mysql_query("update loginaccess set password = '$npwd' where username = '".$_SESSION['user']."';");
                    ?>
                    <script type = "text/javascript">alert("Password reset Successful.");alert("Please fill in your details.");location.href = "profile.php"</script>
                    <?php
                }
            }
        ?>
        <fieldset>
            <center>
                <form name = "pwdform" method = "post" onsubmit = "pwdvalidate();">
                    <table>
                        <tr>
                            <td>Enter Existing Password<sup><font color = "#FF0000" size = "3">*</font></sup></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><input type = "password" id = "epwd" name = "epwd" required></td>
                            <td><img id = "eye" style = "opacity:0.4; filter: alpha(opacity=40);" src = "images/eye_s.png" onMouseOver = "mouseoverPass();" onMouseOut = "mouseoutPass();"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Enter New Password<sup><font color = "#FF0000" size = "3">*</font></sup></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><input type = "password" id = "npwd" name = "npwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password should have at least 1 UPPERCASE, 1 LOWERCASE, 1 NUMBER, MINIMUM of 8 Characters and at least ! Special Character(!,@,#,$,%,^,&,*,?,_,~)" required onkeyup="CheckPasswordStrength(this.value);" onkeydown="StrengthRes();"></td>
                            <td><img id = "eye" style="opacity:0.4;filter:alpha(opacity=40);" src = "images/eye_s.png" onMouseOver="mouseoverPass();" onMouseOut = "mouseoutPass();"></td>
                            <td width = "30%"><p id = "pwd_strength"></p></td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Re-enter New Password<sup><font color = "#FF0000" size = "3">*</font></sup></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><input type = "password" id = "rnpwd" name = "rnpwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password should have at least 1 UPPERCASE, 1 LOWERCASE, 1 NUMBER and MINIMUM of 8 Characters" required></td>
                            <td><img id = "eye" style="opacity:0.4;filter:alpha(opacity=40);" src = "images/eye_s.png" onMouseOver="mouseoverPass();" onMouseOut = "mouseoutPass();"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align = "center"><button class = "btnSubmit" type = "submit" name = "submit">Change Password</button>
                                <style type = "text/css">
                                    .btnSubmit
                                    {
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
                                    .btnsubmit:active {
                                      background-color: #FF0000;
                                      box-shadow: 0 5px rgba(0,0,0,0.2);
                                      transform: translateY(4px);
                                    }
                                </style>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </form>
            </center>
        </fieldset>
        <div align = "right"><font color = '#FF0000' size = "2"><i>* Make sure that new password is not similar to your username, name, role or organization name.</i></font></div>
    </body>
</html>
