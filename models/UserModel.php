<?php
namespace Models;

require_once("../vendor/autoload.php");
use Models\DB;


class UserModel {
	private int $id;
	private $db;

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
	public function checkIfLogin ($username, $password) {
		
		$hash = $this->db->select('SELECT password, id FROM users WHERE username = "'.$username.'" OR email = "'. $username .'"');
		if (empty($hash)) {
			return false;
		} else {
			$hash = $hash["password"];
			$this->id = $hash[1];
			return password_verify($password, $hash);
		}
	}

	/**
	 * Samuel Barbeau 01/11/2022
	 * function to the user id
	 * 
	 * @return int|bool return the id if it's set else return false because the user isn't logged in and you're trying to access it's ID
	 */
	public function getUserId() {
		if(isset($id))
			return $id;
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
	public function CheckIfUsernameOrEmailExist ($username, $email) {
		$response = array();
		$result = $this->db->select("SELECT username FROM users WHERE username = '".$username."'");

		if (empty($result)) $response["username"] = true;
		else $response["username"] = false;

		$result = $this->db->select("SELECT email FROM users WHERE email = '".$email."'");

		if(empty($result)) $response["email"] = true;
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
	public function registerNewUser ($username, $email, $password) {
		$this->db->query("INSERT INTO users (username, email, password) VALUES ('".$username."','".$email."','".password_hash($password,PASSWORD_BCRYPT)."')");
	}
}