<?php

$nickname=$_GET['nickname'];
$id_user=$_GET['id_user'];
$position=$_GET['position'];

$url=$_SERVER['REQUEST_URI'];

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
 	<h1 ><?php echo "$nickname"; ?></h1>

 	<form method="post" action="search_form_sight.php" enctype="multipart/form-data">
		<input type="input" placeholder="Название зрелища" name="Title">
		<input type="submit" value="Найти">
    <input type="hidden" name="Id_user" value="<?php echo "$id_user" ?>">
	</form>

  <form method="post" action="search_form_person.php" enctype="multipart/form-data">
    <input type="input" placeholder="Имя персоны" name="FIO">
    <input type="submit" value="Найти">   
  </form>

	<ul class="menu">
  		<form method="post" action="list_sight_form.php" enctype="multipart/form-data">
  			<input type="submit" name="" value="Список зрелищ">
  			<input type="hidden" name="Id_user" value="<?php echo "$id_user"; ?>">
  		</form>

  		<form method="get" action="list_persons_form.php" enctype="multipart/form-data">
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

        <?php
        if($position=="Админ"){
          ?>
          <form method="post" action="list_users_form.php" enctype="multipart/form-data">
            <input type="submit" name="" value="Список пользователей">
            <input type="hidden" name="URL" value="<?php echo "$url" ?>">
          </form>
        <?php
        }
        ?>

        <form method="post" action="index.php" enctype="multipart/form-data">
        	<input type="submit" name="" value="Выход">
        </form>

        <?php

        $page=new page($nickname,$id_user,$conn);
        $page->output_my_records();

        ?>

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

    <h1 >Мои записи</h1>

    <label>Персоны:</label><br>
    <?php

		foreach($array_ca as $key=>$value){ 
      ?>
			   <form method="post" action="сa_form.php" enctype="multipart/form-data">
            <input type="submit" value="<?php echo("ФИО: ".$array_ca[$key]['FIO']." | Должность:".$array_ca[$key]['position']); ?>">
            <input type="hidden" name="Id_ca" value="<?php echo($array_ca[$key]['id_ca']) ?>">  
         </form><br>
      <?php
		}
    
    $out_sql_fs="SELECT * FROM Films_series WHERE id_user = '$this->id_user'";

    $sth = $this->conn->prepare($out_sql_fs);
    $sth->execute();
    $array_fs = $sth->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <br>
    <label>Зрелища:</label><br>
    <?php

    foreach($array_fs as $key=>$value){ 
      ?>
         <form method="GET" action="fs_form.php" enctype="multipart/form-data">
            <input type="submit" value="<?php echo($array_fs[$key]['title']); ?>">
            <input type="hidden" name="Id_fs" value="<?php echo($array_fs[$key]['id_fs']) ?>">
            <input type="hidden" name="Id_user" value="<?php echo($this->id_user) ?>">
            <input type="hidden" name="Nickname" value="<?php echo($this->nickname) ?>">  
         </form><br>
      <?php
    }

    }

}

?>