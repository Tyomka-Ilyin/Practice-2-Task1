<?php

$url=$_POST['URL'];

$nickname_user=$_POST['Nickname_user'];

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class user{

  public function __construct($nickname_user,$conn,$url){

          $this->nickname_user=$nickname_user;
          $this->url=$url;
          $this->conn=$conn;

    }

    public function marking_page(){

    $out_sql="SELECT * FROM Users WHERE name_user = '$this->nickname_user'";

    $sth = $this->conn->prepare($out_sql);
    $sth->execute();
    $array_user = $sth->fetch(PDO::FETCH_ASSOC);

    ?>
    <h1 ><?php print($this->nickname_user); ?></h1>
    <label><?php print("Логин: ".$array_user['login']); ?></label><br>
    <label><?php print("Пароль: ".$array_user['password']); ?></label><br>
    <br>
    <label>Его записи:</label><br>
    <br>
    <label>Персоны:</label>
    <?php

    $id_user=$array_user['id_user'];

    echo "$id_user";

    $out_sql_ca="SELECT * FROM creators_actors WHERE id_user = '$id_user'";

    $sth = $this->conn->prepare($out_sql_ca);
    $sth->execute();
    $array_ca = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach($array_ca as $key=>$value){ 
      ?>
         <form method="post" action="сa_form.php" enctype="multipart/form-data">
            <input type="submit" value="<?php echo("ФИО: ".$array_ca[$key]['FIO']." | Должность:".$array_ca[$key]['position']); ?>">
            <input type="hidden" name="Id_ca" value="<?php echo($array_ca[$key]['id_ca']) ?>">  
         </form>
      <?php
    }
    
    $out_sql_fs="SELECT * FROM Films_series WHERE id_user = '$id_user'";

    $sth = $this->conn->prepare($out_sql_fs);
    $sth->execute();
    $array_fs = $sth->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <label>Зрелища:</label>
    <?php

    foreach($array_fs as $key=>$value){ 
      ?>
         <form method="GET" action="fs_form.php" enctype="multipart/form-data">
            <input type="submit" value="<?php echo($array_fs[$key]['title']); ?>">
            <input type="hidden" name="Id_fs" value="<?php echo($array_fs[$key]['id_fs']) ?>">
            <input type="hidden" name="Id_user" value="<?php echo($this->id_user) ?>">
            <input type="hidden" name="Nickname" value="<?php echo($this->nickname) ?>">  
         </form>
      <?php
    }

    ?>

    <form method="post" action="admin_in_base.php" enctype="multipart/form-data">
      <input type="submit" value="Сделать админом">
      <input type="hidden" name="Id_user" value="<?php echo($id_user) ?>">
      <input type="hidden" name="URL" value="<?php echo($this->url) ?>">
    </form>

    <form method="post" action="delete_user.php" enctype="multipart/form-data">
      <input type="submit" value="Удалить">
      <input type="hidden" name="Id_user" value="<?php echo($id_user) ?>">
      <input type="hidden" name="URL" value="<?php echo($this->url) ?>">
    </form>

    <?php


    }

}

$ca=new user($nickname_user,$conn,$url);
$ca->marking_page();

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Персона</title>
  <style type="text/css">
  </style>
 </head>
 <body>

 </body>
</html>