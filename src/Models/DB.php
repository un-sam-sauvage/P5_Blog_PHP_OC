<?php

namespace App\Models;

use mysqli;

class DB
{
	private $db_host = "localhost";
	private $db_password = "";
	private $db_user = "root";
	private $db_db = "socialnetwork";
	private $db;

	public function __construct()
	{
		$this->db = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_db);
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
