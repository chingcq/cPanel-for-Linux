<?
switch($submenu){
	case 'clients' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "buga/clients/>Clients list</a></li><li><a href=" . WEB_ROOT . "buga/clients/add/>Add Client</a></li><li><a href=" . WEB_ROOT . "buga/clients/search/>Search Client</a></li></ul></li></ul></li></ul><ul></div>";
	break;

	case 'dns' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "buga/dns/>DNS list</a></li><li><a href=" . WEB_ROOT . "buga/dns/add/>Add DNS</a></li><li><a href=" . WEB_ROOT . "buga/dns/search/>Search MySQL</a></li></ul></li></ul></li></ul><ul></div>";
	break;

	case 'settings' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "buga/settings/change>Change your details</a></li><li><a href=" . WEB_ROOT . "buga/settings/pass>Change password</a></li></ul></li></ul></li></ul>	<ul></div>";
	break;

	case 'domain' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "buga/domain/>Domain list</a></li><li><a href=" . WEB_ROOT . "buga/domain/add>Add Domain</a></li><li><a href=" . WEB_ROOT . "buga/domain/search>Search Domain</a></li></ul></li></ul></li></ul>	<ul></div>";
	break;

	case 'ftp' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "buga/ftp/>FTP list</a></li><li><a href=" . WEB_ROOT . "buga/ftp/add/>Add FTP</a></li><li><a href=" . WEB_ROOT . "buga/ftp/search/>Search FTP</a></li></ul></li></ul></li></ul><ul></div>";
	break;

	case 'mail' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "buga/mail/>Email list</a></li>	<li><a href=" . WEB_ROOT . "buga/mail/add>Add Email</a></li><li><a href=" . WEB_ROOT . "buga/mail/search>Search Email</a></li></ul> </li> </ul></li></ul><ul></div>";
	break;

	case 'mysql' :
	$submenu = "<div id=menu><ul><li><h2>Site Menu</h2><ul><li><a href=" . WEB_ROOT . "buga/mysql/>MySQL list</a></li><li><a href=" . WEB_ROOT . "buga/mysql/add>Add MySQL</a></li><li><a href=" . WEB_ROOT . "buga/mysql/search>Search MySQL</a></li></ul></li></ul></li></ul><ul></div>";
	break;

	case 'shop' :
	$submenu = "<div id=menu><ul><li><h2>FTP Menu</h2><ul><li><a href=" . WEB_ROOT . "buga/shop/>Order list</a></li><li><a href=" . WEB_ROOT . "buga/shop/search>Search order</a></li></ul></li></ul></li></ul><ul></div>";
	break;

	default :
	$submenu = '';
}
echo $submenu;
?>