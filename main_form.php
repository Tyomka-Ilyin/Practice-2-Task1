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


	<form method="post" action="" enctype="multipart/form-data">
		<input type="input" placeholder="Название фильма или имя персоны" name="inp_search_all">
		<input type="submit" name="but_search_all" id="but_search_all" value="Найти">		
	</form>

	<ul class="menu">
  		<form method="post" action="" enctype="multipart/form-data">
  			<input type="submit" name="" value="Список фильмов и сериалов">
  		</form>

  		<form method="post" action="" enctype="multipart/form-data">
  			<input type="submit" name="" value="Список персон">
  		</form>

  		<form method="post" action="registration_form.php" enctype="multipart/form-data">
  			<input type="submit" name="" value="Регистрация">
  		</form>
	</ul>


 </body>
</html>

<?php


if (array_key_exists('but_search_all',$_POST)) {
	}


?>

