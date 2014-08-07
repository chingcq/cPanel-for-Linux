<html>
<head>
<title><? echo $pageTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<link href="default.css" media="all" rel="stylesheet" type="text/css" />

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
				  <li><a href='<? echo WEB_ROOT; ?>settings/'>Settings</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>shop/'>Shop</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>mysql/'>MySQL</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>mail/'>Mail</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>domain/'>Domain</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>ftp/'>FTP</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>dns/'>DNS</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>clients/'>Clients</a></li>
				  <li><a href='<? echo WEB_ROOT; ?>index.php?logout'>Logout</a></li>
			   </ul>
</div>
</td></tr></table>

</td></tr><tr><td>
<table><tr><td valign=top>
<? #require_once ('template/submenu.php'); ?>
</td>
<td>

<? require_once $path; ?>

</td></tr></table>
</body>
</html>
