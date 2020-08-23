<?php ob_start();
$link = mysqli_connect("localhost", "root", "", "cyber2020_2.0");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
  <title>Регистрация</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

 <div class="container">
	<form action="" method="POST">
	 
		<h1>Регистрация</h1>
		<hr>
		
		<label for="fname"><b>Имя</b></label>
		<input type="text" id="fname" name="firstname" placeholder="First name" required>
		
		<label for="lname"><b>Фамилия</b></label>
		<input type="text" id="lname" name="lastname" placeholder="Last name" required>
		
		<label for="mlname"><b>Отчество</b></label>
		<input type="text" id="mlname" name="middlename" placeholder="Middle name">
		
		<label for="username"><b>Логин</b></label>
		<input type="text" placeholder="Enter username" name="username" required>
		
		<label for="psw"><b>Пароль</b></label>
		<input type="password" placeholder="Enter Password" name="psw" required>
		
		<label for="psw-repeat"><b>Подтверждение пароля</b></label>
		<input type="password" placeholder="Repeat Password" name="psw-repeat" required>
		
		<label for="present_post"><b>Должность</b></label>
			<div>
				<?php
				$quest = "SELECT * FROM `jobs`";
				$result = mysqli_query($link, $quest);
				echo '<select name="jobs">';
				while ($result_j = mysqli_fetch_array($result)) {
					echo '<option>'.$result_j['Name'].'</option>';
				}
				echo '</select>';
				?>
			</div>
			
		<label for="skills"><b>Предпочитаемый формат</b></label>
		<div>
			<?php
			$quest = "SELECT * FROM `contenttypenames`";
			$result = mysqli_query($link, $quest);
			while ($result_j = mysqli_fetch_array($result)) {
				echo '<p><input type="checkbox" name="ContentType" value="">'.$result_j['ContentTypeName'].'</p>';
			}
			?>
		</div>

		<label for="other_skills"><b>Компетенции</b></label>
		<div>
			<?php
			$quest = "SELECT * FROM `skills`";
			$result = mysqli_query($link, $quest);
			while ($result_j = mysqli_fetch_array($result)) {
				echo '<p><input type="checkbox" name="Skills" value="">'.$result_j['Name'].'</p>';
			}
			?>
		</div>
		
		<hr>

		<button type="submit" class="registerbtn">Регистрация</button>
	   

		<div class="container signin">
			<p>У Вас есть аккаунт? <a href="sign_in.html">Вход</a></p>
		</div>

	</form>
 </div>
  
<?php
	$mysqli = new mysqli('localhost', 'root', '', 'cyber2020_2.0');
	if ($mysqli->connect_error) {
	    die('Ошибка : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
	
	if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['middlename']) && isset($_POST['username']) && isset($_POST['psw']) && isset($_POST['jobs'])){
		$Firstname = $_POST['firstname'];
		$Surname = $_POST['lastname'];
		$Middlename = $_POST['middlename'];
		$Login = $_POST['username'];
		$Password = $_POST['psw'];
		$Jobs = $_POST['jobs'];
		
		
		$Block1 = $mysqli->query("INSERT INTO `employees` (`SurName`, `FirstName`, `SecondName`, `Login`, `Password`) VALUES ('$Surname', '$Firstname', '$Middlename', '$Login', '$Password')");
		
		$select1 = mysqli_fetch_array($mysqli->query("SELECT `Id` FROM `employees` WHERE `Login` = '$Login'"));
		$select2 = mysqli_fetch_array($mysqli->query("SELECT `Id` FROM `jobs` WHERE `Name` = '$Jobs'"));
		$Block2 = $mysqli->query("INSERT INTO `jobforemployees` (`EmployeeId`, `JobId`) VALUES ('$select1[0]', '$select2[0]')");
		
		if ($Block1 && $Block2){
			echo "<a href='action_sign_in.php'>";
		} else {
			echo "Not OK";
		}
	} else {
		echo "Произошла ошибка записи в БД";
	}
?>
</body>
</html>

