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

<form method="post" action="add_person.php" enctype="multipart/form-data">
	<label>ФИО</label>
	<input type="input" name="FIO" required><br>

	<label>Должность</label>
	<select name = "Position">
		<option value = "Актёр">Актёр</option>
		<option value = "Режиссёр">Режисёр</option>
	</select><br>

	<input type="file" name="Photo" accept="image/*" required><br>

	<input type="submit" value="Добавить">

    <input type="hidden" name="Id_user" value="<?php echo "$id_user" ?>">
    <input type="hidden" name="Nickname" value="<?php echo "$nickname" ?>">
</form>

 </body>
</html>