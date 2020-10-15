<?php

class add_person{

	public function __construct($nickname,$FIO,$position,$full_path,$id_user,$conn){

			$this->nickname=$nickname;
			$this->FIO=$FIO;
			$this->position=$position;
			$this->full_path=$full_path;
      $this->id_user=$id_user;
      $this->conn=$conn;

    }

    public function in_base(){

    	$add_sql="INSERT INTO creators_actors(FIO,position,photo_ca,id_user) VALUES ('$this->FIO','$this->position','$this->full_path','$this->id_user')";

    	$sth=$this->conn->prepare($add_sql);
    	$sth->execute();

    	header("Location: page.php?nickname=$this->nickname&id_user=$this->id_user");

    }

}

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id_user=$_POST['Id_user'];
$nickname=$_POST['Nickname'];

$FIO=$_POST['FIO'];
$position=$_POST['Position'];

$image = $_FILES["Photo"]["name"];
$tmp_path = $_FILES['Photo']['tmp_name'];
$path='photo_person/';
$full_path=$path.$image;

move_uploaded_file($tmp_path, $full_path);

$add_person= new add_person($nickname,$FIO,$position,$full_path,$id_user,$conn);
$add_person->in_base();

?>