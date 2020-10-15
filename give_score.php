<?php

$id_user=$_GET['Id_user'];
$score=$_GET['Score'];
$id_fs=$_GET['Id_fs'];

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class give_score{

	public function __construct($conn,$id_user,$score,$id_fs){

       		$this->conn=$conn;
          $this->id_user=$id_user;
          $this->score=$score;
          $this->id_fs=$id_fs;

    }

    public function in_base(){

    	$add_kol_score_sql="UPDATE Films_series SET kol_scores = kol_scores+1 WHERE id_fs = '$this->id_fs'";

      $sth=$this->conn->prepare($add_kol_score_sql);
      $sth->execute();

      $add_score="INSERT INTO Scores(id_fs,score,id_user) VALUES('$this->id_fs','$this->score','$this->id_user')";

      $sth=$this->conn->prepare($add_score);
      $sth->execute();

      $kol_score_sql="SELECT kol_scores FROM Films_series WHERE id_fs = '$this->id_fs'";

      $st = $this->conn->prepare($kol_score_sql);
      $st->execute();
      $kol_score = $st->fetch(PDO::FETCH_COLUMN);

      $sum_score_sql="SELECT SUM(score) FROM Scores WHERE id_fs = '$this->id_fs'";

      $st = $this->conn->prepare($sum_score_sql);
      $st->execute();
      $sum_score = $st->fetch(PDO::FETCH_COLUMN);

      $av_score=$sum_score/$kol_score;

      $add_av_score_sql="UPDATE Films_series SET score = $av_score WHERE id_fs='$this->id_fs'";

      $sth=$this->conn->prepare($add_av_score_sql);
      $sth->execute();

      header("Location: fs_form.php?Id_fs=$this->id_fs&Id_user=$this->id_user");

    }

}

$list_p=new give_score($conn,$id_user,$score,$id_fs);
$list_p->in_base();

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