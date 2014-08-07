<script>
function deleteEntry(Id, url, tbl)
{
	if (confirm('Delete this entry?')) {
		window.location.href = '&action=deleteEntry&Id=' + Id;
	}
}
</script>
<?php
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'deleteEntry' :
        deleteEntry();
        break;

    default :
}

function deleteEntry()
{
    if (isset($_GET['Id']) && (int)$_GET['Id'] > 0) {
        $Id = (int)$_GET['Id'];
    } else {
        header('Location: index.php');
    }


    $sql = "DELETE FROM buga WHERE user_id = '$Id'; DELETE FROM tbl_userinfo WHERE user_id = '$Id'";
	$conn = new PDO('mysql:host=localhost;dbname=hosting', 'root', '');
    $conn->query($sql);
}

class search
{
	protected $registry;
	private $numrows;
	private $sql;
	private $sql_2;
	private $pages;

	public function __construct($registry)
	{
		$this->registry = $registry;
		search::doSearch();

	}

	public function doSearch()
	{
		@$username 		= trim($_POST['txtusername']);

		$this->sql_2= "SELECT * FROM `buga` WHERE `user_login` LIKE '%$username%'";
		$this->pages = new pages($this->registry);
		$this->sql = $this->pages->setSQL($this->sql_2);
		$result = $this->registry['conn']->query($this->sql);
		$this->numrows = $result->rowCount();
        search::showresult();
    }

    public function showresult()
    {
		print "<table border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"text\" width=\"800px\">\n";
		print "<tr align=\"center\" id=\"listTableHeader\">\n";
		print "<td>User</td>\n";
		print "<td width=\"70\">Modify</td>\n";
		print "<td width=\"70\">Delete</td>\n";
		print "</tr>\n";

		if ($this->numrows > 0) {
			$i = 0;
			foreach ($this->registry['conn']->query($this->sql) as $row){
				print '<tr class=row1>';
				print '<td><a href="' . WEB_ROOT . 'admin/clients/detail/&id=' . $row['user_id'] . '">' . $row['user_login'] . '</a></td>';
				print '<td width="70" align="center"><a href="' . WEB_ROOT . 'admin/clients/modify/&id=' . $row['user_id'] . '">Modify</a></td>';
				print '<td width="70" align="center"><a href="javascript:deleteEntry(' . $row['user_id'] . ');">Delete</a></td>';
				print '</tr>';
			}
			print "<tr>\n";
			print "<td colspan=\"5\" align=\"center\">\n";

			$this->pages->pages($this->sql_2);
			print "</td> \n";
			print "</tr> \n";

		}
		else
		{
			print "<tr> \n";
			print "<td colspan=\"5\" align=\"center\">No entries</td> \n";
			print "</tr> \n";

		}
		print "<tr> \n";
		print "<td colspan=\"5\">&nbsp;</td> \n";
		print "</tr> \n";
		print "</table> \n";
		print "<p>&nbsp;</p> \n";
		print "</form>\n";
	}
}
new search($this->registry);
?>