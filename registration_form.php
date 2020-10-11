<html>
 <head>
  <meta charset="utf-8">
  <title>Регистрация</title>
  <style type="text/css">
  </style>
 </head>
 <body>
        <h1 style="margin-left: 45%; width: 40%;background: #FFFFFF;padding: 10px;">Регистрация</h1>

        <form method="post" action="Registration.php" enctype="multipart/form-data" style="margin-left: 43.4%; width: 40%;background: #FFFFFF;">
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

    	if($this->nickname!="" and $this->login!="" and $this->password!=""){
    		$add_sql = "INSERT INTO User(name_user, login, password)
    				Values('$this->nickname','$this->login','$this->password')";

    		$this->conn->exec($add_sql);
		}
		else{
			echo "Заполните все поля";
		}
    }

}

$servername = "localhost:3305";
$username = "root"; 
$password = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$nickname=$_POST('pole_nick');
$login=$_POST('pole_login');
$password=$_POST('pole_password');

$reg=new registration($nickname,$login,$password,$conn);

if (array_key_exists('but_reg',$_POST)){
	$reg->click_reg();
}


?>