<?php

$id_user=$_POST['Id_user'];
$nickname=$_POST['Nickname'];

?>

<html>
 <head>
  <meta charset="utf-8">
  <title>Добавить персону</title>
  <style type="text/css">
  </style>
 </head>
 <body>

<form method="post" action="add_sight.php" enctype="multipart/form-data">
  <label>Название</label>
	<input type="input" name="Title" required><br>

	<label>Жанр</label>
	<input type="input" name="Genre" required><br>

	<label>Продолжительность</label>
	<input type="input" name="Length" required><br>

	<label>Режиссёр</label>
	<input type="input" name="Creator" required><br>

	<label>Актёры</label>
	<input type="input" name="Actors" required><br>

	<input type="file" name="Photo" accept="image/*" required multiple><br>

	<input type="submit" value="Добавить">

    <input type="hidden" name="Id_user" value="<?php echo "$id_user" ?>">
    <input type="hidden" name="Nickname" value="<?php echo "$nickname" ?>">
</form>

 </body>
</html>