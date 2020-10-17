<?php

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class list_person{

	public function __construct($conn,$nickname,$id_user,$position){

       		$this->conn=$conn;
          $this->nickname=$nickname;
          $this->id_user=$id_user;
          $this->position=$position;

    }

    public function marking_page(){

    $list_person_sql="SELECT * FROM Creators_actors";

    $sth = $this->conn->prepare($list_person_sql);
		$sth->execute();
		$array_persons = $sth->fetchAll(PDO::FETCH_ASSOC);

		?>

    	<h1 style="margin-left: 45%; width: 40%;background: #FFFFFF;padding: 10px;">Персоны</h1>

    	<?php

		foreach($array_persons as $key=>$value){ 
      	?>
			   <form method="post" action="сa_form.php" enctype="multipart/form-data">
               	<input type="submit" value="<?php echo("ФИО: ".$array_persons[$key]['FIO']." | Должность:".$array_persons[$key]['position']); ?>">
               	<input type="hidden" name="Id_ca" value="<?php echo($array_persons[$key]['id_ca']) ?>">  
         </form>
      	<?php
		}

    }

}

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Список персон</title>
  <style type="text/css">
  </style>
 </head>
 <body>

<?php

$list_p=new list_person($conn,$nickname,$id_user,$position);
$list_p->marking_page();

?>

 </body>
</html>