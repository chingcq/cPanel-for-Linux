<?php
class pages
{
	protected $register;
	private $sql;
	private $numrows;
	private $rowsPerPage;
	private $String;
	private $page;
	private $numLinks;
	private $maxpages;
	private $self;
	private $next;
	private $last;
	private $prev;
	private $first;
	private $pagingLink;
	public $link;

	public function __construct($registry)
	{		$this->registry = $registry;
		$this->rowsPerPage = '10';
		$this->String = '';
		$this->numLinks    = '10';
	 	$this->self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	 	$this->pagingLink = array();
	}

	public function pages($sql)
	{
		pages::getURL();
		$this->sql = $sql;
		$offset = ($this->page - 1) * $this->rowsPerPage;
		$this->sql . " LIMIT $offset, $this->rowsPerPage";

		$this->result = $this->registry['conn']->query($this->sql);
		$this->numrows = $this->result->rowCount();		$this->maxpages = ceil($this->numrows/$this->rowsPerPage);
		pages::getLinks();
		if ($this->maxpages > 1)
    	{    		   pages::getPagingLink();
    	}
	}

	private function getURL()
	{		if(isset($_GET['page']) && (int)$_GET['page'] > 0)
	    {
	        $this->page = (int)$_GET['page'];
	    }
	    else
	    {
	        $this->page = '1';
	    }
	}

	private function getLinks()
	{			if ($this->page > 1)
	        {
	            $this->page = $this->page - 1;

	            if ($this->page > 1)
	            {
	                $this->prev = " <a href=\"$this->self?page=$this->page&$this->String/\">[Prev]</a> ";
	            }
	            else
	            {
	                $this->prev = " <a href=\"$this->self?$this->String\">[Prev]</a> ";
	            }

            	$this->first = " <a href=\"$this->self?$this->String\">[First]</a> ";
        	}
        	else
        	{
	            $this->prev  = '';
	            $this->first = '';
        	}

	        if ($this->page < $this->maxpages)
	        {
	            $this->page = $this->page + 1;

	            $this->next = " <a href=\"$this->self?page=$this->page&$this->String\">[Next]</a> ";
	            $this->last = " <a href=\"$this->self?page=$this->maxpages&$this->String\">[Last]</a> ";
	        }
	        else
	        {
	            $this->next = '';
	            $this->last = '';
	        }
	}

	private function getPagingLink()
	{
       	$start = $this->page - ($this->page % $this->numLinks) + 1;
        $end   = $start + $this->numLinks - 1;
        $end   = min($this->maxpages, $end);

        for($page = $start; $page <= $end; $page++)
        {
            if ($page == $this->page)
            {
                $this->pagingLink[] = " $page ";
            }
            else
            {
                if ($page == 1)
                {
                    $this->pagingLink[] = " <a href=\"$this->self?$this->String\">$this->page</a> ";
                }
                else
                {
                    $this->pagingLink[] = " <a href=\"$this->self?page=$this->page&$this->String\">$this->page</a> ";
                }
            }

        }

      	$this->pagingLink = implode(' | ', $this->pagingLink);
       	$this->link = $this->first . $this->prev . $this->pagingLink . $this->next . $this->last;
 	}

 	public function showLinks()
 	{
 		echo $this->link;
 	}
}
