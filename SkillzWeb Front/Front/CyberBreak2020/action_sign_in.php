<?php ob_start();?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
  <title>Обработчик формы входа</title>
  <link rel="stylesheet" href="css/style_table.css">
  <script>
	function changeTest(obj){
		<?php
			$idJ = $result_j['Id'];
		?>
	}
</script>
</head>
<body>

<div>
<?php
$login = "Не известно";
$password = "Не известно";
if(isset($_POST['username']) && isset($_POST['psw'])) {
	$login = $_POST['username']; 
	$password = $_POST['psw'];
}
$link = mysqli_connect("localhost", "root", "", "cyber2020_2.0");
$querry = "SELECT * FROM employees WHERE Login = '$login' AND Password = '$password'";
$result = mysqli_query($link, $querry); 
if ($result && mysqli_num_rows($result)>0) {
	$string = mysqli_fetch_array($result);
	$result_s = $string[1] . ' ' . $string[2] . ' ' . $string[3];
	$idR = $string[0];
} else {
	$url = 'http://cyberbreak2020/sign_in.html';
	header('Location: '.$url);}
?>
</div>
<table class="table1">

			<tr>
				<td width=25% style="text-align: center">Личный кабинет</td>
				<td width=75% colspan="3" align = "center"><span class="Name_client"><?php echo $result_s;?></span></td>
			</tr>
			<tr>
				<th width=25% rowspan="2">Должность</th>
				<th width=25% align="center">Прогресс:</th>
				
				<td width=50% colspan = "2">
					<div class="meter">
						<span style="width: 15%"></span>
					</div>
				</td>
			</tr>
			<tr>
				<th width=25% align="center">Имеющиеся компетенции</th>
				<th width=25% align="center">Изучаемые сейчас</th>
				<th width=25% align="center">Необходимо изучить</th>
					
				
			</tr>
			<tr>
				<th width=25%>
				<div>
				<?php
				$querry = "SELECT JobId FROM jobforemployees WHERE EmployeeId = $idR";
				$result = mysqli_query($link, $querry);
				$Predresult = mysqli_fetch_array($result);
				$querry = "SELECT Name FROM jobs WHERE Id = $Predresult[0]";
				$result = mysqli_query($link, $querry);
				$Postresult = mysqli_fetch_array($result);
				echo $Postresult[0];
				?>
				</div>
				</th>
				<td width=25% align="center">
				<div>
				<?php
				$querry = "SELECT s.Name FROM skills s WHERE s.Id IN (SELECT es.SkillId FROM EmployeeSkills es JOIN SkillSFORJobs sj ON es.SkillId = sj.SkillId WHERE es.EmployeeId = $idR AND sj.JobId = $Predresult[0] AND es.LevelId = 1)";
				$result = mysqli_query($link, $querry);
				while ($Postresult = mysqli_fetch_array($result)){
					echo '<p>'.$Postresult['Name'].'</p>';
				}
				?>
				</div>
				</td>
				<td width=25% align="center">
				<div>
				<?php
				$querry = "SELECT s.Name FROM skills s WHERE s.Id IN (SELECT sj.SkillId FROM skillsforjobs sj JOIN employeeskills es on sj.SkillId = es.SkillId WHERE sj.SkillId NOT IN (SELECT es.SkillId FROM employeeskills es WHERE es.EmployeeId = $idR AND (es.LevelId = 1 OR es.LevelId = 3)) AND sj.JobId = $Predresult[0])";
				$result = mysqli_query($link, $querry);
				while ($Postresult = mysqli_fetch_array($result)){
					echo '<p>'.$Postresult['Name'].'</p>';
				}
				?>
				</div>
				</td>
				<td width=25% align="center">
				<div>
				<?php
				$querry = "SELECT s.Name FROM skills s WHERE s.Id IN (SELECT sj.SkillId FROM skillsforjobs sj WHERE sj.SkillId NOT IN (SELECT es.SkillId FROM employeeskills es WHERE es.EmployeeId = $idR AND (es.LevelId = 1 OR es.LevelId = 2)) AND sj.JobId = $Predresult[0])";
				$result = mysqli_query($link, $querry);
				while ($Postresult = mysqli_fetch_array($result)){
					echo '<p>'.$Postresult['Name'].'</p>';
				}
				?>
				</div>
				</td>
			</tr>
			<tr>
				<th width=25%>
				<div>
				<?php
				$querry = "SELECT * FROM jobs";
				$result = mysqli_query($link, $querry);
				echo '<select name="Jobs" onChange="changeTest(this)">';
				$idJ = -1;
				echo '<option>Желаемая должность</option>';
				while ($result_j = mysqli_fetch_array($result)) {
					echo '<option>'.$result_j['Name'].'</option>';
				}
				echo '</select>';
				?>
				</div>
				</th>
				<td width=25% align="center">
				<div>
				<?php
				$querry = "SELECT s.Name FROM skills s WHERE s.Id IN (SELECT es.SkillId FROM EmployeeSkills es JOIN SkillSFORJobs sj ON es.SkillId = sj.SkillId WHERE es.EmployeeId = $idR AND sj.JobId = $idJ AND es.LevelId = 1)";
				$result = mysqli_query($link, $querry);
				while ($Postresult = mysqli_fetch_array($result)){
					echo '<p>'.$Postresult['Name'].'</p>';
				}
				?>
				</div>
				</td>
				<td width=25% align="center">
				<div>
				<?php
				$querry = "SELECT s.Name FROM skills s WHERE s.Id IN (SELECT sj.SkillId FROM skillsforjobs sj JOIN employeeskills es on sj.SkillId = es.SkillId WHERE sj.SkillId NOT IN (SELECT es.SkillId FROM employeeskills es WHERE es.EmployeeId = $idR AND (es.LevelId = 1 OR es.LevelId = 3)) AND sj.JobId = 5)";
				$result = mysqli_query($link, $querry);
				while ($Postresult = mysqli_fetch_array($result)){
					echo '<p>'.$Postresult['Name'].'</p>';
				}
				?>
				</div>
				</td>
				<td width=25% align="center">
				<div>
				<?php
				$querry = "SELECT s.Name FROM skills s WHERE s.Id IN (SELECT sj.SkillId FROM skillsforjobs sj WHERE sj.SkillId NOT IN (SELECT es.SkillId FROM employeeskills es WHERE es.EmployeeId = $idR AND (es.LevelId = 1 OR es.LevelId = 2)) AND sj.JobId = 5)";
				$result = mysqli_query($link, $querry);
				while ($Postresult = mysqli_fetch_array($result)){
					echo '<p>'.$Postresult['Name'].'</p>';
				}
				?>
				</div>
				</td>
			</tr>
</table>
<table class="table1">
<!-- Мои курсы-->
			<tr>
				<td width=100% colspan="4" align = "center"><span class="Title_kurs">Мои курсы</span></td>
			</tr>
			<tr>
				<th width=50% colspan="2" align="center">Завершенные курсы</th>
				<th width=50% colspan="2" align="center">Текущие курсы</th>

			</tr>
			<tr>
				<td width=50% colspan="2" align="center"></td>
				<td width=50% colspan="2"  align="center">курс<br>курс<br>курс<br>курс<br>курс</td>
			</tr>
</table>

<table class="table1">
<!--Рекомендуемые курсы -->
			<tr>
				<td width=100% colspan="4" align = "center"><span class="Title_kurs">Рекомендуемые курсы</span></td>
			</tr>
			<tr>
				<th width=50% colspan="2" align="center">Название курса</th>
				<th width=50% colspan="2" align="center">Охват компетенций</th>
			</tr>
			<tr>
				<td width=50% colspan="2" align="center">Курс1</td>
				<td width=50%  colspan="2"  align="center">компетенция1<br>компетенция2</td>
			</tr>
			<tr>
				<td width=50% colspan="2" align="center">Курс2</td>
				<td width=50% colspan="2"  align="center">компетенция1<br>компетенция2<br>компетенция3</td>
			</tr>
			<tr>
				<td width=50% colspan="2" align="center">Курс3</td>
				<td width=50% colspan="2"  align="center">компетенция1<br>компетенция2<br>компетенция3</td>
			</tr>
	</table>
	
</body>
</html>