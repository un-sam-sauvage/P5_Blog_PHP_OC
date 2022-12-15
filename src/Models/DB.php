<?php

namespace App\Models;

use mysqli;

class DB
{
	private mysqli $db;

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
	 * @param array $params the params to change in the prepared query
	 * 
	 * @param string $type the type of all params given (if two string => "ss" if one string one int "si"...)
	 * 
	 * @return array|void return the result in an assoc array
	 * 
	 */
	public function select(string $query, array $params, string $type)
	{
		$preparedQuery = $this->db->prepare($query);
		$preparedQuery->bind_param($type, ...$params);
		$preparedQuery->execute();
		return mysqli_fetch_assoc($preparedQuery);
	}

	/**
	 * Samuel Barbeau 28/10/2022
	 * Function to exectue any type a request to mysql server
	 * 
	 * @param string the query to execute
	 * 
	 * @param array $params the params to change in the prepared query
	 * 
	 * @param string $type the type of all params given (if two string => "ss" if one string one int "si"...)
	 * 
	 * @return mixed the result of the query
	 */
	public function query(string $query, array $params, string $type)
	{
		$preparedQuery = $this->db->prepare($query);
		$preparedQuery->bind_param($type, ...$params);
		$preparedQuery->execute();
		return $preparedQuery;
	}

	public function selectWithoutPreparation (string $query) {
		return mysqli_fetch_assoc($this->db->query($query));
	}
}
