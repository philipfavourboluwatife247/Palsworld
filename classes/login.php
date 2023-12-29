<?php

class Login
{

	private $error = "";
 
	public function evaluate($data)
	{

		$username = addslashes($data['username']);
		$password = addslashes($data['password']);

		$query = "select * from users where username = '$username' limit 1 ";

		$Database = new Automated_DB();
		$result = $Database->read_from_db($query);

		if($result)
		{

			$row = $result[0];

			if($this->hash_text($password) == $row['password'])
			{

				//create session data
				$_SESSION['palsworld_userid'] = $row['userid'];

			}else
			{
				$this->error .= "wrong username or password<br>";
			}
		}else
		{

			$this->error .= "wrong username or password<br>";
		}

		return $this->error;
		
	}

	private function hash_text($text){

		$text = hash("sha1", $text);
		return $text;
	}

	public function check_login($id,$redirect = true)
	{
		if(is_numeric($id))
		{

			$query = "select * from users where userid = '$id' limit 1 ";

			$Database = new Automated_DB();
			$result = $Database->read_from_db($query);

			if($result)
			{

				$user_data = $result[0];
				return $user_data;
			}else
			{
				if($redirect){
					header("Location: ".ROOT."login");
					die;
				}else{

					$_SESSION['palsworld_userid'] = 0;
				}
			}
 
			 
		}else
		{
			if($redirect){
				header("Location: ".ROOT."login");
				die;
			}else{
				$_SESSION['palsworld_userid'] = 0;
			}
		}

	}
 
}