<?php

class Singleton
{
	private static $instance = null;
	protected static $incremnter = 0;

	private function __construct()
	{
		
	}

	public static function getInstance()
	{
		$class = static::class;

		if (self::$instance == null) {
			self::$instance = new static();	
		}

		return self::$instance;
	}

	public static function counter()
	{
		return ++self::$incremnter;
	}
}

$s1 = Singleton::getInstance();
$s2 = Singleton::getInstance();

echo $s1::counter() . "\n";
echo $s2::counter() . "\n";

if ($s1 === $s2) {
    echo "Singleton works, both variables contain the same instance.";
} else {
    echo "Singleton failed, variables contain different instances.";
}