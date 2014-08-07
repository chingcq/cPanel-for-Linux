<?
switch($submenu){
	case 'clients' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "admin/clients/>Clients list</a></li><li><a href=" . WEB_ROOT . "admin/clients/add/>Add Client</a></li><li><a href=" . WEB_ROOT . "admin/clients/search/>Search Client</a></li></ul></li></ul></li></ul><ul></div>";
	break;

	case 'dns' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "admin/dns/>DNS list</a></li><li><a href=" . WEB_ROOT . "admin/dns/add/>Add DNS</a></li><li><a href=" . WEB_ROOT . "admin/dns/search/>Search MySQL</a></li></ul></li></ul></li></ul><ul></div>";
	break;

	case 'settings' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "admin/settings/stats>Statistics</a></li><li><a href=" . WEB_ROOT . "admin/settings/pass>Change password</a></li><li><a href=" . WEB_ROOT . "admin/settings/userlog>User log</a></li><li><a href=" . WEB_ROOT . "admin/settings/errorlog>Error log</a></li><li><a href=" . WEB_ROOT . "admin/settings/dns>DNS</a></li></ul></li></ul></li></ul>	<ul></div>";
	break;

	case 'domain' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "admin/domain/>Domain list</a></li><li><a href=" . WEB_ROOT . "admin/domain/add>Add Domain</a></li><li><a href=" . WEB_ROOT . "admin/domain/search>Search Domain</a></li></ul></li></ul></li></ul>	<ul></div>";
	break;

	case 'ftp' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "admin/ftp/>FTP list</a></li><li><a href=" . WEB_ROOT . "admin/ftp/add/>Add FTP</a></li><li><a href=" . WEB_ROOT . "admin/ftp/search/>Search FTP</a></li></ul></li></ul></li></ul><ul></div>";
	break;

	case 'mail' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "admin/mail/>Email list</a></li>	<li><a href=" . WEB_ROOT . "admin/mail/add>Add Email</a></li><li><a href=" . WEB_ROOT . "admin/mail/search>Search Email</a></li></ul> </li> </ul></li></ul><ul></div>";
	break;

	case 'mysql' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "admin/mysql/>MySQL list</a></li><li><a href=" . WEB_ROOT . "admin/mysql/add>Add MySQL</a></li><li><a href=" . WEB_ROOT . "admin/mysql/search>Search MySQL</a></li></ul></li></ul></li></ul><ul></div>";
	break;

	case 'shop' :
	$submenu = "<div id=menu><ul><li><h2>FTP Menu</h2><ul><li><a href=" . WEB_ROOT . "admin/shop/>Order list</a></li><li><a href=" . WEB_ROOT . "admin/shop/search>Search order</a></li><li><a href=" . WEB_ROOT . "admin/shop/set>Set price</a></li></ul></li></ul></li></ul><ul></div>";
	break;

	default :
	$submenu = '';
}
echo $submenu;
?>