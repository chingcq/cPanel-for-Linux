<html>
<head>
<title><? echo $pageTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<link href="<? echo WEB_ROOT; ?>admin/default.css" media="all" rel="stylesheet" type="text/css" />

</head>
<body topmargin="8" leftmargin="8" marginheight="8" marginwidth="8">
<table align=left><tr><td>

<table><tr><td>
<h1>Admin panel - <? //echo $pageTitle; ?></h1>
</td></tr></table>

</td></tr><tr><td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align=left>
           <tr>
            <td>
<div id="centeredmenu" class="centeredmenu">
			   <ul>
				  <li><a href='<? echo WEB_ROOT; ?>admin/settings/'>Settings</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>admin/shop/'>Shop</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>admin/mysql/'>MySQL</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>admin/mail/'>Mail</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>admin/domain/'>Domain</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>admin/ftp/'>FTP</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>admin/dns/'>DNS</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>admin/clients/'>Clients</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>admin/logout.php'>Logout</a></li>
			   </ul>
</div>
</td></tr></table>

</td></tr><tr valign="top"><td>
<table><tr valign="top"><td valign=top>
<? require_once (SRV_ROOT . '/template/submenu.php'); ?>
</td>
<td valign="top">

<? require_once $path; ?>

</td></tr></table><br><br><br><br><br>
<font size=1><div align=center><a href=<? echo WEB_ROOT; ?>>Help</a></div></font>
</body>
</html>
