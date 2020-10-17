<?php

$FIO=$_POST['FIO'];

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class ca{

  public function __construct($FIO,$conn){

          $this->FIO=$FIO;
          $this->conn=$conn;

    }

    public function marking_page(){

    $list_person_sql="SELECT * FROM Creators_actors WHERE FIO LIKE '%$this->FIO%'";

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
  <title>Персоны</title>
  <style type="text/css">
  </style>
 </head>
 <body>

<?php

$ca=new ca($FIO,$conn);
$ca->marking_page();

?>

 </body>
</html>