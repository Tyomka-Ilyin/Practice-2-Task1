<html>
 <head>
  <meta charset="utf-8">
  <title>Регистрация</title>
  <style type="text/css">
  </style>
 </head>
 <body>
        <h1 style="margin-left: 45%; width: 40%;background: #FFFFFF;padding: 10px;">Регистрация</h1>

        <form name="form" method="post" action="" enctype="multipart/form-data" style="margin-left: 43.4%; width: 40%;background: #FFFFFF;">
          <input name="pole_nick" type="text" placeholder="Nickname" style="width:270px;height:40px;font-size:1.4vw" /><br>
          <input name="pole_login" type="text" placeholder="Логин" style="width:270px;height:40px;font-size:1.4vw" /><br>
          <input name="pole_password" type="text" placeholder="Пароль" style="width:270px;height:40px;font-size:1.4vw" /><br>
          <input type="submit" id="but_reg" name="but_reg" value="Зарегестрироваться" style="width:270px;height:75px;font-size:1.4vw">
        </form>
 </body>
</html>


<?php

class registration{

	public function __construct($nickname,$login,$password,$conn){

       		$this->nickname=$nickname;
       		$this->login=$login;
       		$this->password=$password;
       		$this->conn=$conn;

    }

    public function click_reg(){

    	$add_sql="INSERT INTO Users(name_user,login,password)
    			  VALUES('$this->nickname','$this->login','$this->password')";

    	$sth=$this->conn->prepare($add_sql);
    	$sth->execute();

    }

    public function check_user(){

    	$check_user_sql="SELECT COUNT(id_user) from Users Where login = ?";

    	$stmt = $this->conn->prepare($check_user_sql);
        $stmt->execute(array("$this->login"));

        // set the resulting array to associative
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


if (isset($_POST['but_reg'])){

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
}

?>