<?
switch($submenu){
	case 'clients' :
	$submenu = "";
	break;	

	case 'dns' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "mysql/index.php?view=view>MySQL list</a></li><li><a href=" . WEB_ROOT . "mysql/index.php?view=add>Add MySQL</a></li><li><a href=" . WEB_ROOT . "mysql/index.php?view=search>Search MySQL</a></li></ul></li></ul></li></ul><ul></div>";
	break;
	
	case 'domain' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "domain/index.php?view=view>Domain list</a></li><li><a href=" . WEB_ROOT . "domain/index.php?view=add>Add Domain</a></li><li><a href=" . WEB_ROOT . "domain/index.php?view=search>Search Domain</a></li></ul></li></ul></li></ul>	<ul></div>";
	break;
	
	case 'ftp' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "FTP/index.php?view=view>FTP list</a></li><li><a href=" . WEB_ROOT . "FTP/index.php?view=add>Add FTP</a></li><li><a href=" . WEB_ROOT . "FTP/index.php?view=search>Search FTP</a></li></ul></li></ul></li></ul><ul></div>";
	break;
	
	case 'email' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "mail/index.php?view=view>Email list</a></li>	<li><a href=" . WEB_ROOT . "mail/index.php?view=add>Add Email</a></li><li><a href=" . WEB_ROOT . "mail/index.php?view=search>Search Email</a></li></ul> </li> </ul></li></ul><ul></div>";
	break;
	
	case 'mysql' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "mysql/index.php?view=view>MySQL list</a></li><li><a href=" . WEB_ROOT . "mysql/index.php?view=add>Add MySQL</a></li><li><a href=" . WEB_ROOT . "mysql/index.php?view=search>Search MySQL</a></li></ul></li></ul></li></ul><ul></div>";
	break;
	
	case 'settings' :
	$submenu = "";
	break;	
	
	case 'shop' :
	$submenu = "<div id=menu><ul><li><h2>FTP Menu</h2><ul><li><a href=" . WEB_ROOT . "shop/index.php?view=view>Order list</a></li></ul></li></ul></li></ul><ul></div>";
	break;
	
	default :
	$submenu = '';
}
echo $submenu;
?>