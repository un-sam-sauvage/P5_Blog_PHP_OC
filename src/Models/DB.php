<?php

namespace App\Models;

use mysqli;

class DB
{
	private $db;

	public function __construct()
	{

		// On récupère les informations de connexion depuis le fichier .env.ini (à la racine du projet)
		$config = parse_ini_file(__DIR__ . '/../../.env.ini');

		$this->db = new mysqli($config['DB_HOST'], $config['DB_USERNAME'], $config['DB_PASSWORD'], $config['DB_NAME']);

		if ($this->db->connect_errno) {
			return "failed to connect to db";
		}
		return $this->db;
	}

	/**
	 * Samuel Barbeau 28/10/2022
	 * Function to execute a query on the mysql server only to SELECT data
	 * 
	 * @param string $query the SELECT query to execute
	 * 
	 * @return array|void return the result in an assoc array
	 */
	public function select(string $query)
	{
		return mysqli_fetch_assoc($this->db->query($query));
	}

	/**
	 * Samuel Barbeau 28/10/2022
	 * Function to exectue any type a request to mysql server
	 * 
	 * @param string the query to execute
	 * 
	 * @return mixed the result of the query
	 */
	public function query(string $query)
	{
		return $this->db->query($query);
	}
}
