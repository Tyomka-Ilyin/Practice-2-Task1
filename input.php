<?php

class input{

  public function __construct($login,$password,$conn){

          $this->login=$login;
          $this->password=$password;
          $this->conn=$conn;

    }

    public function click_input(){

      $id_user_sql="SELECT id_user,name_user,position FROM Users WHERE login = '$this->login'";

      $stmt = $this->conn->prepare($id_user_sql);
      $stmt->execute();
      $array = $stmt->fetch(PDO::FETCH_ASSOC);

      $nickname=$array['name_user'];
      $id_user=$array['id_user'];
      $position=$array['position']; 

      header("Location: page.php?nickname=$nickname&id_user=$id_user&position=$position");

    }

    public function check_user(){

      $check_user_sql="SELECT COUNT(id_user) from Users Where login = ? and password='$this->password'";

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

$login=$_POST['pole_login'];
$password=$_POST['pole_password'];


if(!empty($login) && !empty($password)){

  $inp=new input($login,$password,$conn);

  if($inp->check_user()==1){

    $inp->click_input();

  }
  else{

    echo "Неверный логин или пароль";

  }
  
}
else{

  echo "Заполнены не все поля";
}

?>