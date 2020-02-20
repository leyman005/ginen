<?php

class Connection
{
	private static $sHostname;
	private static $sUsername;
	private static $sPassword;
	private static $sDBname;
	public  static $con = null;

	public static function database()
	{
		if($_SERVER["HTTP_HOST"] === "localhost")
		{
			self::$sHostname = 'localhost';
			self::$sUsername = 'admin';
			self::$sPassword = 'dashley';
			self::$sDBname 	 = 'ginen_db';
		}
		else
		{	
			self::$sHostname = 'localhost';
			self::$sUsername = 'ginencoz_manley';
			self::$sPassword = 'k7jW]0izAsN=';
			self::$sDBname 	 = 'ginencoz_db';
		}
		
		if(self::$con == null)
		{
			self::$con = new mysqli(self::$sHostname, self::$sUsername, self::$sPassword, self::$sDBname);
		}
				
		return self::$con;
	}
}