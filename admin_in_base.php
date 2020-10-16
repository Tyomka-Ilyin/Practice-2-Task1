<?php

$url=$_POST['URL'];

$id_user=$_POST['Id_user'];

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class add_admin{

  public function __construct($id_user,$conn,$url){

          $this->id_user=$id_user;
          $this->conn=$conn;
          $this->url=$url;

    }

    public function in_base(){

    	$del_tab_user_sql="UPDATE Users SET position = 'Админ' WHERE id_user='$this->id_user'";

    	$sth=$this->conn->prepare($del_tab_user_sql);
      	$sth->execute();

      	header("Location: $this->url");

    }

}

$del=new add_admin($id_user,$conn,$url);
$del->in_base();

?>