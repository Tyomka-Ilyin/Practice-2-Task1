<?php

$url=$_POST['URL'];

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class list_users{

	public function __construct($conn,$url){

       		$this->conn=$conn;
          $this->url=$url;

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
            <input type="hidden" name="URL" value="<?php echo "$this->url" ?>">
         </form>
      	<?php
		}

    }

}

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Список пользователей</title>
  <style type="text/css">
  </style>
 </head>
 <body>

<?php

$list_p=new list_users($conn,$url);
$list_p->marking_page();

?>

 </body>
</html>