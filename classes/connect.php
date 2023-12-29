<?php


class Automated_DB{

  private $host = "localhost";
  private $username ="root";
  private $password ="";
  private $db = "palsworld_db";

  function connect_to_db(){

    $connection = mysqli_connect($this->host,$this->username,$this->password,$this->db);

    return $connection;
  }

  function read_from_db($query){

    $connect = $this->connect_to_db();
    $result = mysqli_query($connect,$query);

    if(!$result){

        return false;

    }

    else{
        $data = false;
        while($row = mysqli_fetch_assoc($result)){
           
          $data[] = $row;

    }
          return $data;
    }
  }

  function save_query_in_db($query){

    $connect = $this->connect_to_db();
    $result = mysqli_query($connect,$query);

    if(!$result){

        return false;

    }

    else{

      return true;

}

  }


}









