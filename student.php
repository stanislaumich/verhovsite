<?php
 $b1=-1;
 $b2=-1;
 if(isset($_GET['act']))$act=$_GET['act'];
 if(isset($_GET['s']))$s=$_GET['s'];
 if(isset($_POST['g']))$g=$_POST['g'];
 if(isset($_POST['b1']))$b1=$_POST['b1'];
 if(isset($_POST['b2']))$b2=$_POST['b2'];

 if(isset($_POST['fam']))$fam=$_POST['fam'];
 if(isset($_POST['god']))$god=$_POST['god'];
 if(isset($_POST['sex']))$sex=$_POST['sex'];
 if(isset($_POST['gruppa']))$gruppa=$_POST['gruppa'];
 if(isset($_POST['fak']))$fak=$_POST['fak'];
 if(isset($_POST['ball']))$ball=$_POST['ball'];
 if(isset($_POST['rab']))$rab=$_POST['rab'];
 if(isset($_POST['gorod']))$gorod=$_POST['gorod'];

$db = new SQLite3('student.db3');

switch ($act) {
    case "create":
       $results = $db->query('CREATE TABLE IF NOT EXISTS student ('.
   		 'fam  text(200),    god numeric,    sex numeric,    gruppa  text(20),
   		 fak  text(300),   ball numeric,      rab text(300), gorod text(300));');
        echo "База создана<br>";
        break;
    case "listall":
        $results = $db->query("select * from student");
        $p="<table border=1><caption>Студенты:</caption><tbody>";
        $p.="<tr><th>Фамилия</th><th>Год</th><th>Пол</th><th>Группа</th><th>Факультет</th><th>Балл</th><th>Работа</th><th>Город</th></tr>";
			while($r = $results->fetchArray()){
				$p.="<tr>";
				$p.= "<td>".$r['fam']."</td>";
                $p.= "<td>".$r['god']."</td>";
                if ($r['sex']==0){
 					$p.= "<td>Женский</td>";
 				}
 				else{ 					$p.= "<td>Мужской</td>"; 					}
 				$p.= "<td>".$r['gruppa']."</td>";
 				$p.= "<td>".$r['fak']."</td>";
 				$p.= "<td>".$r['ball']."</td>";
 				$p.= "<td>".$r['rab']."</td>";
 				$p.= "<td>".$r['gorod']."</td>";
				$p.="</tr>";
				}
		$p.="</tbody></table>";
		echo $p;
        break;
    case "zapros":
        switch ($s){         case "g":
         if($g=='' ){
          	 echo "Не указан город, посмотрите все записи ";
          	 $results = $db->query("select * from student where 1=1");
          }
          else {
          $results = $db->query("select * from student where gorod='".$g."'");
          }
          break;
         case "list":
          if($b1=='' || $b2=='' ){
          	 echo "Неправильный диапазон, выводим все записи ";
          }
          else {
          echo "Балл от: ".$b1." и до: ".$b2;
          $results = $db->query("select * from student where ball between $b1 and $b2");
          }
          break;
        }
          $p="<table border=1><caption>Студенты:</caption><tbody>";
          $p.="<tr><th>Фамилия</th><th>Год</th><th>Пол</th><th>Группа</th><th>Факультет</th><th>Балл</th><th>Работа</th><th>Город</th></tr>";
			while($r = $results->fetchArray()){
				$p.="<tr>";
				$p.= "<td>".$r['fam']."</td>";
                $p.= "<td>".$r['god']."</td>";
                if ($r['sex']==0){
 					$p.= "<td>Женский</td>";
 				}
 				else{
 					$p.= "<td>Мужской</td>";
 					}
 				$p.= "<td>".$r['gruppa']."</td>";
 				$p.= "<td>".$r['fak']."</td>";
 				$p.= "<td>".$r['ball']."</td>";
 				$p.= "<td>".$r['rab']."</td>";
 				$p.= "<td>".$r['gorod']."</td>";
				$p.="</tr>";
				}
		$p.="</tbody></table>";
		echo $p;

        break;
    case "insert":
        if($fam=='' || $gorod==''||$god==''||$sex==''||$gruppa==''||$fak==''||$ball==''||$rab==''){
         echo "Заполниите все поля!!";
        }
        else{
         $z="INSERT INTO student (
                        fam,
                        god,
                        sex,
                        gruppa,
                        fak,
                        ball,
                        rab,
                        gorod
                    )
                    VALUES (
                        '$fam',
                        '$god',
                        '$sex',
                        '$gruppa',
                        '$fak',
                        '$ball',
                        '$rab',
                        '$gorod'
                    );";
        $results = $db->query($z);
        echo "Запись вставлена";        }
        break;
}
echo"<br><br><center><a href='student.html'>На главную страницу</a></center>";
?>