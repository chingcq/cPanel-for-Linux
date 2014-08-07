<?
class post_check
{
	public function post_check($string)
	{
		$felder = $string;
		$felder = explode (' ' , $felder) ;
		foreach ($felder as $feld)
		{
		    $$feld = mysql_real_escape_string(stripslashes($_POST[$feld])) ;
		}
	}
}
?>