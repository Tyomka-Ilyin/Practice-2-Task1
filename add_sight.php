<?php

class add_sight{

	public function __construct($nickname,$title,$genre,$length,$image,$id_user,$conn,$creator,$actors){

			$this->nickname=$nickname;
      $this->id_user=$id_user;
      $this->conn=$conn;
      $this->title=$title;
      $this->genre=$genre;
      $this->length=$length;
      $this->creator=$creator;
      $this->actors=$actors;

    }

    public function in_table_films_series(){

    	$add_sql="INSERT INTO Films_series(title,genre,length,id_user) VALUES ('$this->title','$this->genre','$this->length','$this->id_user')";

    	$sth=$this->conn->prepare($add_sql);
    	$sth->execute();

      }

    public function in_table_photo_fs(){

      $id_fs_sql="SELECT id_fs FROM Films_series WHERE title = '$this->title'";
      $id_fs=$this->conn->query($id_fs_sql)->fetch(PDO::FETCH_COLUMN);

      foreach($_FILES['Photos']['name'] as $k=>$f){
        $path='photo_fs/';
        $full_path=$path.$_FILES['Photos']['name'][$k];

        move_uploaded_file($_FILES['Photos']['tmp_name'][$k], $full_path);

        $add_images_sql="INSERT INTO Photo_fs(id_fs, photo_fs) VALUES ('$id_fs','$full_path')";

        $sth=$this->conn->prepare($add_images_sql);
        $sth->execute();
      }

    }

    public function in_table_creators_actors_films(){

      try{
        $id_fs_sql="SELECT id_fs FROM Films_series WHERE title = '$this->title'";
        $id_fs=$this->conn->query($id_fs_sql)->fetch(PDO::FETCH_COLUMN);

        $array_actors=explode(", ", $this->actors);

        array_push($array_actors, $this->creator);

        foreach ($array_actors as $value) {
          $id_creators_or_actors_sql="SELECT id_ca FROM Creators_actors WHERE FIO = '$value'";
          $id_creators_or_actors=$this->conn->query($id_creators_or_actors_sql)->fetch(PDO::FETCH_COLUMN);

          $add_creator_or_actor_sql="INSERT INTO Creators_actors_film(id_fs,id_ca) VALUES('$id_fs','$id_creators_or_actors')";
          $sth=$this->conn->prepare($add_creator_or_actor_sql);
          $sth->execute();

        }

        header("Location: page.php?nickname=$this->nickname&id_user=$this->id_user");
      }
      catch(Exception $e){
        echo "Имя персоны с ошибкой";
      }
    }

    

}

$servername = "localhost:3305";
$username = "root"; 
$password_db = "artyom56";
$dbname = "Base_movies"; 

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id_user=$_POST['Id_user'];
$nickname=$_POST['Nickname'];

$title=$_POST['Title'];
$genre=$_POST['Genre'];
$length=$_POST['Length'];

$creator=$_POST["Creator"];
$actors=$_POST["Actors"];

$add_person= new add_sight($nickname,$title,$genre,$length,$image,$id_user,$conn,$creator,$actors);
$add_person->in_table_films_series();
$add_person->in_table_photo_fs();
$add_person->in_table_creators_actors_films();

?>