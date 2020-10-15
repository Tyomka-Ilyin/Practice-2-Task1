<?php

$nickname=$_GET['Nickname'];
$id_user=$_GET['Id_user'];
$position=$_GET['Position'];

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class list_users{

	public function __construct($conn,$nickname,$id_user,$position){

       		$this->conn=$conn;
          $this->nickname=$nickname;
          $this->id_user=$id_user;
          $this->position=$position;

    }

    public function marking_page(){

    $list_user_sql="SELECT * FROM Users WHERE position='Пользователь'";

    $sth = $this->conn->prepare($list_user_sql);
		$sth->execute();
		$array_users = $sth->fetchAll(PDO::FETCH_ASSOC);

		?>

    	<h1 style="margin-left: 45%; width: 40%;background: #FFFFFF;padding: 10px;">Пользователи</h1>

    	<?php

		foreach($array_users as $key=>$value){ 
      	?>
			   <form method="post" action="user_form.php" enctype="multipart/form-data">
            <input name="Nickname_user" type="submit" value="<?php echo($array_users[$key]['name_user']); ?>">
            <input type="hidden" name="Nickname" value="<?php echo "$this->nickname" ?>">
            <input type="hidden" name="Id_user" value="<?php echo "$this->id_user" ?>">
            <input type="hidden" name="Position" value="<?php echo "$this->position" ?>">
         </form>
      	<?php
		}

    }

}

$list_p=new list_users($conn,$nickname,$id_user,$position);
$list_p->marking_page();

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Список персон</title>
  <style type="text/css">
  </style>
 </head>
 <body>

 </body>
</html>