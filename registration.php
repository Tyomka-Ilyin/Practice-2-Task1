<?php

class registration{

	public function __construct($nickname,$login,$password,$conn){

       		$this->nickname=$nickname;
       		$this->login=$login;
       		$this->password=$password;
       		$this->conn=$conn;

    }

    public function click_reg(){

    	$add_sql="INSERT INTO Users(name_user,login,password,position)
    			  VALUES('$this->nickname','$this->login','$this->password','Пользователь')";

    	$sth=$this->conn->prepare($add_sql);
    	$sth->execute();

      $id_user_sql="SELECT id_user FROM Users WHERE login = ?";

      $stmt = $this->conn->prepare($id_user_sql);
      $stmt->execute(array("$this->login"));

      $id_user = $stmt->fetch(PDO::FETCH_COLUMN);


      header("Location: page.php?nickname=$this->nickname&id_user=$id_user");

    }

    public function check_user(){

    	$check_user_sql="SELECT COUNT(id_user) from Users Where login = ?";

    	$stmt = $this->conn->prepare($check_user_sql);
      $stmt->execute(array("$this->login"));

      $result = $stmt->fetch(PDO::FETCH_COLUMN);

      return $result;

    }

}


$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$nickname=$_POST['pole_nick'];
$login=$_POST['pole_login'];
$password=$_POST['pole_password'];


if(!empty($nickname) && !empty($login) && !empty($password)){

	$reg=new registration($nickname,$login,$password,$conn);

	if($reg->check_user()==0){

		$reg->click_reg();

	}
	else{

		echo "Пользователь с подобным логином уже зарегестрирован";

	}
  
}
else{

	echo "Заполнены не все поля";
}

?>