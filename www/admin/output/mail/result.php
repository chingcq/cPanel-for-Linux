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
							'delete' 		=> array(	0 => 'tbl_email|email_id'));
				new process($this->registry, $array); 
				echo "<script>document.location='" . WEB_ROOT . "admin/mail/result'</script>"; 
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
		@$userid 		= trim($_POST['txtUser']);
		@$domain		= trim($_POST['txtDomain']);
		@$ftp_username	= trim($_POST['txtEmail']);

		if($userid == ""){
			if($ftp_username == ""){
			$sql23 = "`domain_id` = '$domain'";
			}if($domain == ""){
			$sql23 = "`email_name` LIKE '%$ftp_username%'";
			}else{
			$sql23 = "`email_name` LIKE '%$ftp_username%' AND `domain_id`='$domain'";
			}
		}elseif($domain == ""){
		$sql23 = "`email_name` LIKE '%$ftp_username%' AND `user_id`='$userid'";
		}else{
		$sql23 = "`domain_id`='$domain' AND `email_name` LIKE '%$ftp_username%' AND `user_id` = '$userid'";
		}
		
		$this->sql_2= "SELECT *
					FROM tbl_email
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
		print "<td>User</td>\n";
		print "<td>Domain name</td>\n";
		print "<td>Email</td>\n";
		print "<td width=\"70\">Modify</td>\n";
		print "<td width=\"70\">Delete</td>\n";
		print "</tr>\n";

		if ($this->numrows > 0) {
			$i = 0;
			foreach ($this->registry['conn']->query($this->sql) as $row){
				$sql2 = "SELECT * FROM buga WHERE user_id =" . $row['user_id'];
				$stmt2 = $this->registry['conn']->query($sql2);
				$obj2 = $stmt2->fetch(PDO::FETCH_OBJ);

				$sql3 = "SELECT * FROM tbl_domain WHERE domain_id =" . $row['domain_id'];
				$stmt3 = $this->registry['conn']->query($sql3);
				$obj3 = $stmt3->fetch(PDO::FETCH_OBJ);
				print '<tr class=row1>';
				print '<td><a href="' . WEB_ROOT . 'admin/clients/detail/&id=' . $row['user_id'] . '">' . $obj2->user_login . '</a></td>';
				print '<td>' . $obj3->domain_name . '</td>';
				print '<td>' . $row['email_name'] . '</td>';
				print '<td width="70" align="center"><a href="' . WEB_ROOT . 'admin/mail/modify/&id=' . $row['email_id'] . '">Modify</a></td>';
				print '<td width="70" align="center"><a href="javascript:deleteEntry(' . $row['email_id'] . ');">Delete</a></td>';
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