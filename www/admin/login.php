<?php
$path = 'library/config.php';
$file = basename($path);
include("./library/".basename($file));

if(isset($_POST['txtUserName']))
{
	$conn = new PDO('mysql:host=localhost;dbname=hosting', 'root', '');
	$registry->__set('conn', $conn);
	$auth = new auth($registry);
	$auth->doLogin();
}


?>
<html>
<head>
<title>Login</title>
<meta http-equiv=Content-Type content="text/html; charset=windows-1251" />
<link href="include/default.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="1" class="graybox">
<tr>
  <td valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="20">
    <tr>
     <td class="contentArea"> <form method="post" name="frmLogin" id="frmLogin">
       <p>&nbsp;</p>
       <table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#336699" class="entryTable">
        <tr id="entryTableHeader">
         <td align=center>:: Login ::</td>
        </tr>
        <tr>
         <td class="contentArea">
         <div class="errorMessage" align="center"><div align=center>
<?
if(isset($_SESSION['errorMessage']))
{
	echo  $_SESSION['errorMessage'];
	unset($_SESSION['errorMessage']);
}
?>
</div></div>
          <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
           <tr align="center">
            <td colspan="3">&nbsp;</td>
           </tr>
           <tr class="text">
            <td width="100" align="right">Login</td>
            <td width="10" align="center">:</td>
            <td><input name="txtUserName" type="text" class="box" id="txtUserName" value="" size="10" maxlength="20"></td>
           </tr>
           <tr>
            <td width="100" align="right">Password</td>
            <td width="10" align="center">:</td>
            <td><input name="txtPassword" type="password" class="box" id="txtPassword" value="" size="10"></td>
           </tr>
           <tr>
            <td colspan="2">&nbsp;</td>
            <td><input name="btnLogin" type="submit" class="box" id="btnLogin" value="Login"></td>
           </tr>
          </table></td>
        </tr>
       </table>
       <p>&nbsp;</p>
      </form></td>
    </tr>
   </table></td>
</tr>
</table>
<p>&nbsp;</p>
</body>
</html>