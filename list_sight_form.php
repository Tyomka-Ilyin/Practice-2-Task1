<?php

$id_user=$_POST['Id_user'];
$nickname=$_POST['Nickname'];

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class list_sight{

	public function __construct($conn,$id_user,$nickname){

       		$this->conn=$conn;
          $this->id_user=$id_user;

    }

    public function marking_page(){

    	$list_sight_sql="SELECT * FROM Films_series";

    	$sth = $this->conn->prepare($list_sight_sql);
		  $sth->execute();
		  $array_sight = $sth->fetchAll(PDO::FETCH_ASSOC);

		?>

    	<h1 style="margin-left: 45%; width: 40%;background: #FFFFFF;padding: 10px;">Зрелища</h1>

    	<?php

		foreach($array_sight as $key=>$value){ 
      	?>
			   <form method="GET" action="fs_form.php" enctype="multipart/form-data">
            <input type="submit" value="<?php echo($array_sight[$key]['title']); ?>">
            <input type="hidden" name="Id_fs" value="<?php echo($array_sight[$key]['id_fs']) ?>">
            <input type="hidden" name="Id_user" value="<?php echo($this->id_user) ?>"> 
         </form>
      	<?php
		}

    }

}

$list_p=new list_sight($conn,$id_user,$nickname);
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