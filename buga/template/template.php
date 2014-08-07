<html>
<head>
<title><? echo $pageTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<link href="<? echo WEB_ROOT; ?>buga/default.css" media="all" rel="stylesheet" type="text/css" />

</head>
<body topmargin="8" leftmargin="8" marginheight="8" marginwidth="8">
<table align=left><tr><td>

<table><tr><td>
<h1>buga panel - <? //echo $pageTitle; ?></h1>
</td></tr></table>

</td></tr><tr><td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align=left>
           <tr>
            <td>
<div id="centeredmenu" class="centeredmenu">
			   <ul>
				  <li><a href='<? echo WEB_ROOT; ?>buga/settings/'>Settings</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>buga/shop/'>Orders</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>buga/mail/'>Mail</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>buga/domain/'>Domain</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>buga/ftp/'>FTP</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>buga/logout.php'>Logout</a></li>
			   </ul>
</div>
</td></tr></table>

</td></tr><tr valign="top"><td>
<table><tr valign="top"><td valign=top>
<? require_once (SRV_ROOT . '/template/submenu.php'); ?>
</td>
<td valign="top">

<? require_once $path; ?>

</td></tr></table>
</body>
</html>
