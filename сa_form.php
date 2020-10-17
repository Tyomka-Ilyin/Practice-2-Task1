<?php

$id_ca=$_POST['Id_ca'];

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class ca{

  public function __construct($id_ca,$conn){

          $this->id_ca=$id_ca;
          $this->conn=$conn;

    }

    public function marking_page(){

    $out_sql="SELECT * FROM creators_actors WHERE id_ca = '$this->id_ca'";

    $sth = $this->conn->prepare($out_sql);
    $sth->execute();
    $array = $sth->fetch(PDO::FETCH_ASSOC);

    ?>
    <h1 ><?php print($array['FIO']); ?></h1>
    <h2 ><?php print($array['position']); ?></h4>
    <img src="<?php print($array['photo_ca']); ?>" width=300 height=400 ><br>
    <br>
    <label>Участвовал в фильмах:</label><br>
    <?php

    $id_fs_ca_sql="SELECT id_fs FROM Creators_actors_film WHERE id_ca = '$this->id_ca'";

    $sth = $this->conn->prepare($id_fs_ca_sql);
    $sth->execute();
    $array_id_fs = $sth->fetch(PDO::FETCH_ASSOC);

    if(!empty($array_id_fs)){
      foreach ($array_id_fs as $key => $value){
      $id_fs=$array_id_fs[$key];
      $title_sql="SELECT Title FROM Films_series WHERE id_fs = '$id_fs'";

      $sth = $this->conn->prepare($title_sql);
      $sth->execute();
      $array_title = $sth->fetch(PDO::FETCH_ASSOC);

      ?>
      <label><?php print($array_title['Title']);?></label><br>
      <?php
      }
    }

    }

}

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Персона</title>
  <style type="text/css">
  </style>
 </head>
 <body>

<?php

$ca=new ca($id_ca,$conn);
$ca->marking_page();

?>

 </body>
</html>