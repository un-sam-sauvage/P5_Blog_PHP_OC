<?php

namespace App\Models;

use Exception;


class UserModel
{
	private int $id;
	private DB $db;

	public function __construct()
	{
		$this->db = new DB();
	}

	public function checkIfLogin($username, $password)
	{

		$hash = $this->db->select('SELECT password, id FROM users WHERE username = ? OR email = ?', array($username, $username), "ss");
		if (empty($hash)) {
			return false;
		} else {
			$this->id = $hash["id"];
			$hash = $hash["password"];
			return password_verify($password, $hash);
		}
	}

	public function getUserId()
	{
		if (isset($this->id))
			return $this->id;
		return false;
	}

	public function CheckIfUsernameOrEmailExist($username, $email)
	{
		$response = array();
		$result = $this->db->select("SELECT username FROM users WHERE username = ?", array($username) , "s");

		if (empty($result)) $response["username"] = true;
		else $response["username"] = false;

		$result = $this->db->select("SELECT email FROM users WHERE email = ?", array($email), "s");

		if (empty($result)) $response["email"] = true;
		else $response["email"] = false;

		return $response;
	}

	public function registerNewUser($username, $email, $password)
	{
		$this->db->query("INSERT INTO users (username, email, password) VALUES (?, ?, ?)", array($username, $email, password_hash($password, PASSWORD_BCRYPT)), "sss");
	}

	public function getProfileInfo($username)
	{
		return $this->db->select("SELECT github, bio as description FROM users WHERE username = ?", array($username), "s");
	}

	public function setProfileInfo($username, $github, $description, $newUsername)
	{
		$this->db->query("UPDATE users set github = ?, bio = ?, username = ?, WHERE username = ?", array($github, $description, $newUsername, $username), "ssss");
	}

	public function isAdmin (int $userId) {
		$isAdmin = $this->db->select("SELECT isAdmin FROM users WHERE id = ?", array($userId), 'i')["isAdmin"];
		if ($isAdmin === 1) {
			return true;
		}
		return false;
	}
}
