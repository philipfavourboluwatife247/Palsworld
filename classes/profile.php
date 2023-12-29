<?php

Class Profile
{
	
	function get_profile($id){

		$id = addslashes($id);
		$Database = new Automated_DB();
		$query = "select * from users where userid = '$id' limit 1";
		return $Database->read_from_db($query);

	}
}