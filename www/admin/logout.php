<?php
$path = 'library/config.php';
$file = basename($path);
include("./library/".basename($file));

if(isset($_SESSION['errorMessage']))
{
	$errorMessage = "<div align=center>" . $_SESSION['errorMessage'] . "</div>";
}


	$auth = new auth($registry);
	$registry->__set('auth', $auth);
	$auth->doLogout();


?>
<html>
<head>
<title>Logout</title>
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
          <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
           <tr align="center">
            <td colspan="3">&nbsp;</td>
           </tr>
           <tr class="text">
            <td align=center>You were logged out!</td>
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