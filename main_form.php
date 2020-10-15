<?php

$id_user="guest";

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Главная</title>
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
        <input type="hidden" name="Id_user" value="<?php echo "$id_user" ?>">
  		</form>

  		<form method="post" action="list_persons_form.php" enctype="multipart/form-data">
        <input type="submit" name="" value="Список персон">
      </form>

      <form method="post" action="input_form.php" enctype="multipart/form-data">
        <input type="submit" name="" value="Вход">
      </form>

  		<form method="post" action="registration_form.php" enctype="multipart/form-data">
  			<input type="submit" name="" value="Регистрация">
  		</form>
	</ul>


 </body>
</html>

