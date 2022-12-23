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
	/**
	 * Samuel Barbeau 28/10/2022
	 * function to verify if the password is valid for the user
	 *
	 * @param string $username the username entered by the user
	 *
	 * @param string $password the password enter by the user (without hashing)
	 *
	 * @return bool true if password match and false otherwise
	 */
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

	/**
	 * Samuel Barbeau 01/11/2022
	 * function to the user id
	 * 
	 * @return int|bool return the id if it's set else return false because the user isn't logged in and you're trying to access it's ID
	 */
	public function getUserId()
	{
		if (isset($this->id))
			return $this->id;
		return false;
	}

	/**
	 * Samuel Barbeau 04/11/2022
	 * function to verify that username and email doesn't already exist in db
	 * 
	 * @param string $username the usernmae to check
	 * 
	 * @param string $email the email to check
	 * 
	 * @return array and array with username and email inside if true that means no match were found else it's false
	 */
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
	/**
	 * 
	 * Samuel Barbeau 03/11/2022
	 * Function to register a new user in database
	 * 
	 * @param string $username the username to insert in db
	 * 
	 * @param string $password the password to be hashed
	 * 
	 * @return array an array that will contain the messagee of success or failure and a bool
	 */
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
		$isAdmin = $this->db->select("SELECT isAdmin FROM users WHERE id = ?", array($userId), 'i');
		if ($isAdmin === 1) {
			return true;
		}
		return false;
	}
}
