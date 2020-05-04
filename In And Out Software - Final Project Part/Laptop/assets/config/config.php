<?php
class config{
	//config file for hosts, username, password and the database name
	public function __construct(){}
	public function cnx(){
		$host = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "mydatabase";

			$db = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $username, $password);
			return $db;
	}
}
?>