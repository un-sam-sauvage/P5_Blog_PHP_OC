<?php
use DB\DB;

class Login {
	public int $id;
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
		$db = new DB();
		$hash = $db->select('SELECT password, id FROM users WHERE username = "'.$username.'" OR email = "'. $username .'"');
		if (empty($hash)) {
			return false;
		} else {
			$hash = $hash["password"];
			return password_verify($password, $hash);
			$this->id = $hash["id"];
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
}