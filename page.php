<?php

$nickname=$_GET['nickname'];
$id_user=$_GET['id_user'];

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Моя страница</title>
  <style type="text/css">
  	.menu {
     margin: 0;
     padding: 0;
     list-style-type: none;
     }
  .menu form {
     margin: 0 10px 0 0;
     padding: 0;
     display: inline-block;
     }
  </style>
 </head>
 <body>
 	<h1 style="margin-left: 45%; width: 40%;background: #FFFFFF;padding: 10px;"><?php echo "$nickname"; ?></h1>

 	<form method="post" action="" enctype="multipart/form-data">
		<input type="input" placeholder="Название фильма или имя персоны" name="inp_search_all">
		<input type="submit" name="but_search_all" id="but_search_all" value="Найти">		
	</form>

	<ul class="menu">
  		<form method="post" action="" enctype="multipart/form-data">
  			<input type="submit" name="" value="Список зрелищ">
  		</form>

  		<form method="post" action="list_persons_form.php" enctype="multipart/form-data">
  			<input type="submit" name="" value="Список персон">
  		</form>

  		<form method="post" action="add_person_form.php" enctype="multipart/form-data">
        	<input type="submit" value="Добавить персону">
            <input type="hidden" name="Id_user" value="<?php echo "$id_user" ?>">
            <input type="hidden" name="Nickname" value="<?php echo "$nickname" ?>">
        </form>

        <form method="post" action="add_sight_form.php" enctype="multipart/form-data">
        	<input type="submit" name="" value="Добавить зрелище">
            <input type="hidden" name="Id_user" value="<?php echo "$id_user" ?>">
            <input type="hidden" name="Nickname" value="<?php echo "$nickname" ?>">
        </form>

        <form method="post" action="input_form.php" enctype="multipart/form-data">
        	<input type="submit" name="" value="Выход">
        </form>

	</ul>

 </body>
</html>

<?php

class page{

	public function __construct($nickname,$id_user,$conn){

			$this->nickname=$nickname;
       		$this->id_user=$id_user;
       		$this->conn=$conn;

    }

    public function output_my_records(){

    $out_sql_ca="SELECT * FROM creators_actors WHERE id_user = '$this->id_user'";

    $sth = $this->conn->prepare($out_sql_ca);
		$sth->execute();
		$array_ca = $sth->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <h1 style="margin-left: 45%; width: 40%;background: #FFFFFF;padding: 10px;">Мои записи</h1>

    <label>Персоны</label>
    <?php

		foreach($array_ca as $key=>$value){ 
      ?>
			   <form method="post" action="сa_form.php" enctype="multipart/form-data">
            <input type="submit" value="<?php echo("ФИО: ".$array_ca[$key]['FIO']." | Должность:".$array_ca[$key]['position']); ?>">
            <input type="hidden" name="Id_ca" value="<?php echo($array_ca[$key]['id_ca']) ?>">  
         </form>
      <?php
		}
    
    $out_sql_fs="SELECT * FROM Films_series WHERE id_user = '$this->id_user'";

    $sth = $this->conn->prepare($out_sql_fs);
    $sth->execute();
    $array_fs = $sth->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <label>Зрелища</label>
    <?php

    foreach($array_fs as $key=>$value){ 
      ?>
         <form method="post" action="сa_form.php" enctype="multipart/form-data">
            <input type="submit" value="<?php echo($array_fs[$key]['title']); ?>">
            <input type="hidden" name="Id_ca" value="<?php echo($array_ca[$key]['id_ca']) ?>">  
         </form>
      <?php
    }

    }

}

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$page=new page($nickname,$id_user,$conn);
$page->output_my_records();

?>