<?php
header ("Content-Type: text/html; charset=utf-8");
echo '<html> <head> <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"> <title>Вход</title> <link rel="stylesheet" href="css/style.css"> </head> <body> <div class="container"> <form action="action_sign_in.php" method="POST"> <h1>Вход</h1> <hr> <label for="username"><b>Имя пользователя</b></label> <input type="text" placeholder="Enter username" name="username" required> <label for="psw"><b>Пароль</b></label> <input type="password" placeholder="Enter Password" name="psw" required> <button type="submit" class="registerbtn">Вход</button> <div class="container signin"> <p>У Вас нет аккаунта? <a href="sign_up.php">Регистрация</a></p> </div> </form> </div> </body> </html>';
?>
