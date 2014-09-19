<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <TR><td><h1></h1></td></TR>
  <tr>
    <td>
	<?php
	$conn = mysql_connect("localhost","root","");
$db=mysql_select_db("sekretariat");
	$isSubmit="0";
	//global $conn;
	?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Login | Layanan Hukum dan Organisasi</title>
            <!--    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.shinyblue.css')}}">-->
            <link rel="stylesheet" type="text/css" href="../sekretariat/template/css/style.default.css">
            <link rel="stylesheet" type="text/css" href="../sekretariat/template/css/rulycon.css">
            <link rel="stylesheet" type="text/css" href="../sekretariat/template/css/rulycons.min.css">
            <link rel="stylesheet" type="text/css" href="../sekretariat/template/css/hukor.css">


            <script src="../sekretariat/template/js/jquery-1.10.1.min.js"></script>
            <script src="../sekretariat/template/js/jquery-migrate-1.1.1.min.js"></script>
            <script src="../sekretariat/template/js/jquery-ui.js"></script>
            <script src="../sekretariat/template/js/modernizr.min.js"></script>
            <script src="../sekretariat/template/js/bootstrap.min.js"></script>
            <script src="../sekretariat/template/js/custom.js"></script>
            <script src="../sekretariat/template/js/jquery.cookie.js"></script>


            <!-- Favicons -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144"
                  href="../sekretariat/template/ico/apple-touch-icon-144-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="114x114"
                  href="../sekretariat/template/ico/apple-touch-icon-114-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="72x72"
                  href="../sekretariat/template/ico/apple-touch-icon-72-precomposed.png">
            <link rel="apple-touch-icon-precomposed" href="../sekretariat/template/ico/apple-touch-icon-57-precomposed.png">
            <link rel="shortcut icon" href="../sekretariat/template/ico/favicon.ico">
            <script type="text/javascript">
                        jQuery(document).ready(function(){
                            jQuery('#login').submit(function(){
                                var u = jQuery('#username').val();
                                var p = jQuery('#password').val();
                                if(u == '' && p == '') {
                                    jQuery('.login-alert').fadeIn();
                                    return false;
                                }
                            });
                        });
            </script>
        </head>

        <body class="loginpage">
        <div class="loginpanel">
            <div class="loginpanelinner">
                <div class="logo animate3 bounceIn">
                                <img class="inputwrapper animate0 bounceIn" src="../sekretariat/template/images/logo-only.png" alt=""/>
<!--                    <h4>-->
<!--                        <span>Biro Hukum dan Organisasi</span><br>-->
<!--                        <span>Kementerian Pendidikan dan Kebudayaan</span><br>-->
<!--                        <span>Republik Indonesia</span>-->
<!--                    </h4>-->
                </div>
                <!--        {{-- form login--}}-->
                <!--        {{ Form::open(array('action' => 'LoginController@signin_admin', 'method' => 'post', 'id'=>'user-sign-in-form',-->
                <!--        'class' =>'front-form', 'autocomplete' => 'off')) }}-->
                <div class="nav nav-tabs">
<!--                    <h3> Daftar Surat Masuk</h3>-->
                </div>
                <form method=post action="index.php" class="front-from" id="user-sign-in-form" >
                    <input type=hidden name=isSubmit value=1>
                    <div class="inputwrapper animate1 bounceIn">
                        <input type=text name=userid class=text_input size=12 value="" placeholder="Masukkan username disini...">
                    </div>
                    <div class="inputwrapper animate2 bounceIn">
                        <input type=password name=password size=12 class=text_input value="" placeholder="Masukkan password disini...">
                    </div>
                    <div class="inputwrapper animate3 bounceIn">
<!--                        <button class="btn" id="btn-signin" type="submit" name=submit>Login</button>-->
                        <input type=submit name=submit class=btn id="btn-signin" value="Login">
                        <p style="color:#2980b9; text-align: center; font-size: 12px;">&copy; 2014 Biro Hukum dan Organisasi</p>
                    </div>
                </form>

            </div><!--loginpanelinner-->

        </div><!--loginpanel-->


        <div class="loginfooter">
<!--            <p style="color:#2980b9;">&copy; 2014 Biro Hukum dan Organisasi</p>-->
        </div>

        </body>
        </html>
<!--	<table align="center"><tr><td><fieldset><legend>User Login :</legend>-->
<!--	<form method=post action="index.php">-->
<!---->
<!--	<table border=0>-->
<!--	<input type=hidden name=isSubmit value=1>-->
<!--	<tr ><td colspan=2 ></td></tr>-->
<!--	<tr><td align=right>User Id : </td>-->
<!--	      <td><input type=text name=userid class=txt_input size=12 value="" ></td></tr>-->
<!--	<tr><td align=right>Password : </td>-->
<!--	      <td><input type=password name=password size=12 class=txt_input value="" ></td></tr>-->
<!--	<tr><td colspan="2" align="center">-->
<!--	--><?php
//	$codes = rand(5555,2);
////	$_SESSION['codese'] = $codes;
////	echo "<h3>".$_SESSION['codese']."</h3>"; ?>
<!--	put the code :<br />-->
<!--	<input type=text name=code class=txt_input size=12 value="" >-->
<!--	</td></tr>-->
<!--	<tr><td colspan="2" align="center"><input type=submit name=submit class=button value="Login"></td></tr>-->
<!--	</table>-->
<!--	</form>-->
<!--	</fieldset></td></tr>-->
<!--	<tr><td>-->
<!--	</td></tr></table>-->
<!---->
<!---->
<!--	</td>-->
<!--  </tr>-->
<!---->
<!--</table>-->





