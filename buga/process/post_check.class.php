<?
class post_check
{
	public function post_check($str)
	{
		$str = mysql_real_escape_string(stripslashes($_POST[$feld])) ;
	}
}
?>