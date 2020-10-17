<?php

$id_fs=$_GET['Id_fs'];
$id_user=$_GET['Id_user'];

$url=$_SERVER['REQUEST_URI'];

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class fs{

  public function __construct($id_fs,$conn,$id_user,$url){

          $this->id_fs=$id_fs;
          $this->conn=$conn;
          $this->id_user=$id_user;
          $this->url=$url;

    }

    public function marking_page(){

    $out_sql="SELECT * FROM Films_series WHERE id_fs = '$this->id_fs'";

    $sth = $this->conn->prepare($out_sql);
    $sth->execute();
    $array_fs = $sth->fetch(PDO::FETCH_ASSOC);

    ?>
    <h1 ><?php print($array_fs['title']); ?></h1>
    <label><?php print("Жанр: ".$array_fs['genre']); ?></label><br>
    <label><?php print("Продолжительность: ".$array_fs['length']); ?></label><br>
    <label><?php print("Оценка: ".$array_fs['score']); ?></label><br>
    <label><?php print("Оценивших: ".$array_fs['kol_scores']); ?></label><br>
    <br>
    <label>Состав:</label><br>
    <?php

    $id_ca_sql="SELECT id_ca FROM Creators_actors_film WHERE id_fs = '$this->id_fs'";
    $sth = $this->conn->prepare($id_ca_sql);
    $sth->execute();
    $array_id_ca = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach ($array_id_ca as $key => $value){
      $id_ca=$array_id_ca[$key]['id_ca'];
      $ca_sql="SELECT FIO,position FROM Creators_actors WHERE id_ca = '$id_ca'";

      $sth = $this->conn->prepare($ca_sql);
      $sth->execute();
      $array_ca = $sth->fetch(PDO::FETCH_ASSOC);

      ?>
      <label><?php print("ФИО: ".$array_ca['FIO']." | Должность: ".$array_ca['position']); ?></label><br>
      <?php
      }

    ?>

    <br>
    <label>Фото:</label><br>

    <?php

    $photos_sql="SELECT photo_fs FROM Photo_fs WHERE id_fs = '$this->id_fs'";

    $sth = $this->conn->prepare($photos_sql);
    $sth->execute();
    $array_photo = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach ($array_photo as $key => $value){
      ?>
      <img src="<?php print($array_photo[$key]['photo_fs']); ?>" width=400 height=300>
      <?php
      }


    $search_user="SELECT COUNT(id_user) FROM Scores WHERE id_user='$this->id_user' and id_fs = '$this->id_fs'";

    $st = $this->conn->prepare($search_user);
    $st->execute();
    $kol_user = $st->fetch(PDO::FETCH_COLUMN);

    if($kol_user==0 and $this->id_user!="guest"){
      ?>
      <form method="post" action="give_score.php" enctype="multipart/form-data">
        <p><b>Оцените фильм</b></p>
        <p><input name="Score" type="radio" value="1">1</p>
        <p><input name="Score" type="radio" value="2">2</p>
        <p><input name="Score" type="radio" value="3">3</p>
        <p><input name="Score" type="radio" value="4">4</p>
        <p><input name="Score" type="radio" value="5" checked>5</p>
        <p><input type="submit" value="Поставить оценку"></p>
        <input type="hidden" name="Id_user" value="<?php echo($this->id_user) ?>">
        <input type="hidden" name="Id_fs" value="<?php echo($this->id_fs) ?>">
        <input type="hidden" name="URL" value="<?php echo($this->url) ?>">
      </form>
    
    <?php
    }

    }



}

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Зрелище</title>
  <style type="text/css">
  </style>
 </head>
 <body>

 <?php

$ca=new fs($id_fs,$conn,$id_user,$url);
$ca->marking_page();

 ?>

 </body>
</html>