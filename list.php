<!DOCTYPE HTML>
<html>

 <head>
  <meta charset="utf-8">
  <title>Данные формы</title>
  <link rel="stylesheet" href="list.css"
 </head>
 <body>
  <form action="servapp.php" method="POST">
      <p>Имя:</p>
      <p><input  type="text" name="name" maxlength="30" value="<?=array_key_exists('name', $_POST) ? strval($_POST['name']) : ''?>"></p>
      <p>Фамилия:</p>
      <p><input name="surname" maxlength="30" value="<?=array_key_exists('surname', $_POST) ? strval($_POST['surname']) : ''?>"></p>
      <p>Пол:</p>
      <p><select name="gender">
          <option value="Мужской"> Мужской </option>
          <option value="Женский"> Женский </option>
         </select> 
      </p>
      <p>Группа:</p>
      <p><input name="gruop" maxlength="5" value="<?=array_key_exists('gruop', $_POST) ? strval($_POST['gruop']) : ''?>" ></p>
      <p>Электронная почта:</p>
      <p><input type="email" name="mail" value="<?=array_key_exists('mail', $_POST) ? strval($_POST['mail']) : ''?>"></p>
      <p>Сумма балов за ЕГЭ:</p>
      <p><input type="number" min="0" max="300" name="score" value="<?=array_key_exists('score', $_POST) ? strval($_POST['score']) : ''?>"></p>
      <p>Год рождения:</p>
      <p><input type="number" min="1950" max="2000" name="yearofbirth" value="<?=array_key_exists('yearofbirth', $_POST) ? strval($_POST['yearofbirth']) : ''?>"></p>
      <p>Местный или иногородний:</p>
      <p><select name="placeofbirth">
          <option value="Местный"> Местный </option>
          <option value="Иногородний"> Иногородний </option>
         </select> 
      </p>
      <p>Пароль:</p>
      <p><input type="password" name="password"></p>
      <p><input type="submit"></p>
  </form>
 </body>

</html>