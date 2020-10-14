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
    <h1 style="margin-left: 45%; width: 40%;background: #FFFFFF;padding: 10px;"><?php print($array['FIO']); ?></h1>
    <h2 style="margin-left: 50%; width: 40%;background: #FFFFFF;padding: 10px;"><?php print($array['position']); ?></h4>
    <img src="<?php print($array['photo_ca']); ?>" width=300 height=300 style="margin-left: 45%;">
    <?php

    }

}

$ca=new ca($id_ca,$conn);
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