<?php 

Class Settings
{

	public function get_settings($id)
	{
		$Database = new Automated_DB();
		$sql = "select * from users where userid = '$id' limit 1";
		$row = $Database->read_from_db($sql);

		if(is_array($row)){

			return $row[0];
		}
	}

	public function save_settings($data,$id){

		$Database = new Automated_DB();

		$password = isset($data['password']) ? $data['password'] : "";

		if(strlen($password) < 30 && isset($data['password2'])){

			if($data['password'] == $data['password2']){
				$data['password'] = hash("sha1", $password);
			}else{

				unset($data['password']);
			}
		}

		unset($data['password2']);

		$sql = "update users set ";
		foreach ($data as $key => $value) {
			# code...

			$sql .= $key . "='" . $value. "',";
		}

		$sql = trim($sql,",");
		$sql .= " where userid = '$id' limit 1";
		$Database->save_query_in_db($sql);
	}
}