<?php

class Page
{
	private $title;
	private $body;
	
	/**
     * @var Author
     */
	private $author;

	private $comments = [];

	private $date;

	function __construct(string $title, string $body, Author $author)
	{
		$this->title = $title;
		$this->body = $body;
		$this->author = $author;
		$this->date = new \DateTime();

		// Add this page to the author
		$this->author->addPage($this);
	}

	public function addComment(string $comment)
	{
		$this->comments[] = $comment;
	}

	public function __clone()
	{
		// Clone title only with some modification
		$this->title = "Copy of .." . $this->title;
		
		// Add this page to this author
		$this->author->addPage($this);

		// don't copy the comments
		$this->comments = [];

		$this->date = new \DateTime();
	}
}

class Author
{
	private $name;
	private $pages;

	function __construct(string $name)
	{
		$this->name = $name;
	}

	public function addPage(Page $page)
	{
		$this->pages[] = $page;
	}

	public function getPages()
	{
		return $this->pages;
	}
}


// Client Code

$author = new Author("Ahmed Hdeawy");

$page = new Page("New Page", "Page body", $author);

$page->addComment("New Comments");

$page2 = clone $page;

print_r($page2);