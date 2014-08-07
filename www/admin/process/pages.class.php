<?php
/**
 * This class creates page
 * to use it needs $sql query, next lines will set up the sql query
 * $sql = "SELECT * FROM `tblable` ORDER BY 'id' DESC";
 * $pages = new pages($this->registry);
 * $sql = $pages->setSQL($sql);
 * to display and process pages used next line
 * $pages->pages($sql);
 */
class pages
{
	/**
	 * Declaring all variables
	 */
	protected $registry;
	private $sql;
	private $numrows;
	private $rowsPerPage = '20';
	private $string;
	private $page;
	private $result;
	private $numLinks = '5';
	private $maxpages;
	private $self;
	private $next;
	private $last;
	private $prev;
	private $first;
	private $pagingLink = array();
	public $link;

	function __construct($registry)
	{
		$this->registry = $registry;
	}

	/** 
	 * Process which generates links
	 */
	public function pages($sql)
	{
		/**
		 * Running function getURL to set $page value
		 * then getting link of current form
		 * setting default string with page number for current page
		 * then $string used to remove from $self to get clean link to the form
		 * set $sql var
		 * executing $sql query
		 * finding out amount of rows in database under that query
		 * setting $maxpages by deviding $numrows by $rowsPerPage
		 * if we can have more then one page then we do next.
		 * now we have needed values to declare "border links", so we start function getLinks()
		 * then we declare pages in getPaginLink()
		 * after output links in showLinks()
		 */
		pages::getURL();
		$this->self = $_SERVER['REQUEST_URI'];
	    $string = "&page=" . $this->page;
	 	$this->self = str_replace($string, '', $this->self);
		$this->sql = $sql;
		$this->result = $this->registry['conn']->query($this->sql);
		$this->numrows = $this->result->rowCount();
		$this->maxpages = ceil($this->numrows/$this->rowsPerPage);
		if ($this->maxpages > 1)
    	{
			pages::getLinks();
    		pages::getPagingLink();
			pages::showLinks();
    	}
	}
	/**
	 * setSQL($sql) - $sql will have no limit set.
	 * after using getURL() we find out $page value
	 * we will use $page value to values for limit in new $sql
	 * then we return new $sql string
	 */
	public function setSQL($sql)
	{
		$this->sql = $sql;
		pages::getURL();
		$offset = ($this->page - 1) * $this->rowsPerPage;
		$this->sql = $this->sql . " LIMIT $offset, $this->rowsPerPage";
		return $this->sql;
	}
	/**
	 * if url contains '&page=' then we get what page= contains eg www.test.com\index\&page=2 , $page = 2
	 * if we have no 'page' in url, then set $page equal to one.
	 * return $page value
	 */
	private function getURL()
	{
		if(isset($_GET['page']) && (int)$_GET['page'] > 0)
	    {
	        $this->page = (int)$_GET['page'];
	    }
	    else
	    {
	        $this->page = '1';
	    }
	    return $this->page;
	}

	private function getLinks()
	{
		/**
		 * if $page is more then 1 then we do next
		 * make new "local" $page var
		 * then check if it larger then 1
		 * if not then make link to first page.
		 * set $first to link to the first page.
		 * if $page 1 then make first and prev us nothing because we are on first page.
		 */
		if($this->page > 1)
	    {
	        $page = $this->page - 1;

	        if ($page > 1)
	        {
	            $this->prev = "<a href=" . $this->self . "&page=" . $page . ">[Prev]</a> ";
	        }
	        else
	        {
	            $this->prev = "<a href=" . $this->self . ">[Prev]</a>";
	        }

            $this->first = "<a href=" . $this->self . ">[First]</a> ";
        }
        else
        {
	        $this->prev  = '[Prev]';
	        $this->first = '[First]';
        }
		/**
		 * Now will set next and last links
		 * if $this->page less then max page then do next
		 * declaring local var $page.
		 * setting $this->next and $this->last
		 * else, if $this->page equal to $this->maxpages then dont output link
		 */
	    if ($this->page < $this->maxpages)
	    {
	        $page = $this->page + 1;

	        $this->next = "<a href=" . $this->self . "&page=" . $page . ">[Next]</a> ";
	        $this->last = "<a href=" . $this->self . "&page=" . $this->maxpages . ">[Last]</a> ";
	    }
	    else
	    {
	        $this->next = '[Next]';
	        $this->last = '[Last]';
	    }
	}

	private function getPagingLink()
	{
		/**
		 * we will craete $numLinks links between getLinks()
		 * first thing is that we set the first link which we will have. 
		 * eg $this->page = 7, $this->numLinks/2... $start = 5
		 * Because in given equation $start can become negitive, because
		 * $this->page can equal to 1, we can have negitive $start and we dont need it.
		 * we need $start to be minumum as 1. therefor we check if $start is less then 1,
		 * if yes, then set it as 1.
		 * then we need to set ending point for links.
		 * to make sure that we will not create more $end links then needed we set a limit using min($maxvalue, $currentvalue)
		 */
       	$start = $this->page - round($this->numLinks/2) + 1;
       	if($start < 1) { $start = 1; }
        $end   = $start + round($this->numLinks) - 1;
        $end   = min($this->maxpages, $end);
		/**
		 * Now we have every thing, so we can start generating links
		 * we will create them from $start to $end
		 */
        for($page = $start; $page <= $end; $page++)
        {
			/**
			 * If $page equal $this->page then display only page number
			 */
            if ($page == $this->page)
            {
                $this->pagingLink[] = "$page";
            }
            else
            {
				/**
				 * To make links look nicer, i will have for first page "basic" link without '&page'
				 * if not we will create full link with '&page=' value.
				 */
                if ($page == 1)
                {
                    $this->pagingLink[] = "<a href=" . $this->self . ">" . $page . "</a>";
                }
                else
                {
                    $this->pagingLink[] = "<a href=" . $this->self . "&page=" . $page .">" . $page . "</a> ";
                }
            }
        }
		/**
		 * Get all links in line and seperate using ' | '
		 * Then we are setting a format in which link bar will be displayed
		 */
      	$this->pagingLink = implode(' | ', $this->pagingLink);
       	$this->link = $this->first . $this->prev . $this->pagingLink . $this->next . $this->last;
 	}
	/**
	 * Outputs $this-link;
	 */
 	private function showLinks()
 	{
 		print $this->link;
 	}
}