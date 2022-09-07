<?php
 $p1=-1;
 $p2=-1;
 if(isset($_GET['act']))$act=$_GET['act'];
 if(isset($_GET['s']))$step=$_GET['s'];
 if(isset($_POST['p1']))$p1=$_POST['p1'];
 if(isset($_POST['p2']))$p2=$_POST['p2'];
 if(isset($_POST['dt']))$dt=$_POST['dt'];

 if(isset($_POST['country']))$country=$_POST['country'];
 if(isset($_POST['gorod']))$gorod=$_POST['gorod'];
 if(isset($_POST['photo']))$photo=$_POST['photo'];
 if(isset($_POST['day']))$day=$_POST['day'];
 if(isset($_POST['data']))$data=$_POST['data'];
 if(isset($_POST['class']))$class=$_POST['class'];
 if(isset($_POST['price']))$price=$_POST['price'];
$db = new SQLite3('database.db3');
switch ($act) {
    case "create":
       $results = $db->query('CREATE TABLE IF NOT EXISTS kurort ('.
   		 'country  text(200),    gorod TEXT (200),    photo  text(500),    day  NUMERIC,
   		 data  text(30),    class numeric,      price numeric);');
        echo "База создана<br>";
        break;
    case "listall":
        $results = $db->query("select * from kurort");
        $p="<table border=1><caption>Записи о турах:</caption><tbody>";
        $p.="<tr><th>Страна</th><th>Город</th><th>Фото</th><th>Дней</th><th>Дата</th><th>Класс</th><th>Цена</th></tr>";
			while($r = $results->fetchArray()){
				$p.="<tr>";
				$p.= "<td>".$r['country']."</td>";
                $p.= "<td>".$r['gorod']."</td>";
 				$p.= "<td><a href='".$r['photo']."' target=_blank><img src='".$r['photo']."' width=100></a></td>";
 				$p.= "<td>".$r['day']."</td>";
 				$p.= "<td>".$r['data']."</td>";
 				$p.= "<td>".$r['class']."</td>";
 				$p.= "<td>".$r['price']."</td>";
				$p.="</tr>";
				}
		$p.="</tbody></table>";
		echo $p;
        break;
    case "zapros":
        switch ($step){         case "dt":
         if($dt=='' ){
          	 echo "Непорядок с датой, выводим все записи ";
          	 $results = $db->query("select * from kurort where 1=1");
          }
          else {
          $results = $db->query("select * from kurort where data='".$dt."'");
          }
          break;
         case "list":
          if($p1=='' || $p2=='' ){
          	 echo "Непорядок с диапазоном, выводим все записи ";
          }
          else {
          echo "Дни от: ".$p1." и до: ".$p2;
          $results = $db->query("select * from kurort where day between $p1 and $p2");
          }
          break;
        }
                $p="<table border=1><caption>Записи о турах:</caption><tbody>";
          $p.="<tr><th>Страна</th><th>Город</th><th>Фото</th><th>Дней</th><th>Дата</th><th>Класс</th><th>Цена</th></tr>";
			while($r = $results->fetchArray()){
				$p.="<tr>";
				$p.= "<td>".$r['country']."</td>";
                $p.= "<td>".$r['gorod']."</td>";
 				$p.= "<td><a href='".$r['photo']."' target=_blank><img src='".$r['photo']."' width=100></a></td>";
 				$p.= "<td>".$r['day']."</td>";
 				$p.= "<td>".$r['data']."</td>";
 				$p.= "<td>".$r['class']."</td>";
 				$p.= "<td>".$r['price']."</td>";
				$p.="</tr>";
				}
		$p.="</tbody></table>";
		echo $p;

        break;
    case "insert":
        if($country=='' || $gorod==''||$photo==''||$day==''||$data==''||$class==''||$price==''){
         echo "Заполниите все поля!!";
        }
        else{
         $z="insert into kurort(country,gorod,photo,day,data,class,price) values('$country','$gorod','$photo','$day','$data','$class','$price')";
        $results = $db->query($z);
        echo "Запись вставлена";        }
        break;
}
echo"<br><br><center><a href='database.html'>Перейти в начало</a></center>";
?>