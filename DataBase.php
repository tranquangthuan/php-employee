<?php
class DataBase {
	private static $dbHost = "localhost";
	private static $dbName = "demo";
	private static $dbUsername = "root";
	private static $dbPassword = "";
	private static $connt = null;
	public function __construct() {
		die ( "Init function not allow" );
	}
	public static function connect() {
		if (self::$connt == null) {
			try {
				self::$connt = new PDO ( "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUsername, self::$dbPassword );
			} catch ( PDOException $e ) {
				die ( $e->getMessage () );
			}
		}
		return self::$connt;
	}
	public static function disconnect() {
		self::$connt = null;
	}
}

?>