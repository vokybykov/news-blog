<?php
	namespace App\Core;
	
	use PDO;
	
	class Database {
		
		public static function connect() {
			$dsn = "mysql:dbname=".DB_NAME.";host=".DB_HOST;
			return new PDO($dsn, DB_USER, DB_PASS);
		}
	}