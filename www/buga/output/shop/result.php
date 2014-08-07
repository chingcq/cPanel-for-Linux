<?
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
		@$userid 		= $_SESSION['number'];
		@$order		= trim($_POST['txtOrder']);

		if($userid == ""){
			$sql23 = "`order_id` = '$order' AND user_id = '" . $_SESSION['number'] . "'";
		}elseif($order == ""){
			$sql23 = "`user_id` = '$userid'";
		}else{
			$sql23 = "`order_id` = '$order' AND `user_id = '$userid'";
		}

		$this->sql_2= "SELECT *
					FROM tbl_order
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
		print "<td>Order #</td>\n";
		print "<td>Amount</td>\n";
		print "<td>Order date</td>\n";
		print "<td>Status</td>\n";
		print "</tr>\n";

		if ($this->numrows > 0) {
			$i = 0;
			foreach ($this->registry['conn']->query($this->sql) as $row){
				$sql2 = "SELECT * FROM buga WHERE user_id =" . $row['user_id'];
				$stmt2 = $this->registry['conn']->query($sql2);
				$obj2 = $stmt2->fetch(PDO::FETCH_OBJ);

				$sql3 = "SELECT * FROM tbl_order_length WHERE order_id =" . $row['order_id'];
				$stmt3 = $this->registry['conn']->query($sql3);
				$obj3 = $stmt3->fetch(PDO::FETCH_OBJ);
				print '<tr class=row1>';
				print '<td width=10px><a href="' . WEB_ROOT . 'buga/shop/detail/&id=' . $row['order_id'] . '">' . $row['order_id'] . '</a></td>';
				print '<td>' . $obj3->order_length_mont . ' month</td>';
				print '<td>' . $row['order_date'] . '</td>';
				print '<td>' . $row['order_status'] . '</td>';
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