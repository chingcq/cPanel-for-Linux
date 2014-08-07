<?php
?>
<script>
function deleteEntry(Id, url, tbl)
{
	if (confirm('Delete this entry?')) {
		window.location.href = '&action=deleteEntry&Id=' + Id;
	}
}
</script>
<?
 		$action = isset($_GET['action']) ? $_GET['action'] : ''; 
		switch ($action) { 
			case 'deleteEntry' :
				$array = array('type' 			=> 'delete',
						'class'			=> 'domain',
							'delete' 		=> array(	0 => 'domains|id'));
				new process($this->registry, $array); 
				echo "<script>document.location='" . WEB_ROOT . "buga/domain/'</script>"; 
			break;
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

		@$domain		= trim($_POST['txtDomain']);


			$sql23 = "`name` LIKE '%$domain%' AND `user_id` = '" . $_SESSION['number'] . "'";


		$this->sql_2= "SELECT *
					FROM domains
					WHERE $sql23";
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
		print "<td>Domain name</td>\n";
		print "<td width=\"70\">Modify</td>\n";
		print "<td width=\"70\">Delete</td>\n";
		print "</tr>\n";

		if ($this->numrows > 0) {
			$i = 0;
			foreach ($this->registry['conn']->query($this->sql) as $row){
				$sql2 = "SELECT * FROM buga WHERE user_id =" . $row['user_id'];
				$stmt2 = $this->registry['conn']->query($sql2);
				$obj2 = $stmt2->fetch(PDO::FETCH_OBJ);

				$sql3 = "SELECT * FROM domains WHERE id =" . $row['id'];
				$stmt3 = $this->registry['conn']->query($sql3);
				$obj3 = $stmt3->fetch(PDO::FETCH_OBJ);
				print '<tr class=row1>';
				print '<td>' . $obj3->name . '</td>';
				print '<td width="70" align="center"><a href="' . WEB_ROOT . 'buga/domain/modify/&id=' . $row['id'] . '">Modify</a></td>';
				print '<td width="70" align="center"><a href="javascript:deleteEntry(' . $row['id'] . ');">Delete</a></td>';
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