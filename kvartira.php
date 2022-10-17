<?php
 $b1=-1;
 $b2=-1;
 if(isset($_GET['act']))$act=$_GET['act'];
 if(isset($_GET['s']))$s=$_GET['s'];
 if(isset($_POST['g']))$g=$_POST['g'];
 if(isset($_POST['b1']))$b1=$_POST['b1'];
 if(isset($_POST['b2']))$b2=$_POST['b2'];

 if(isset($_POST['raon']))$raon=$_POST['raon'];
 if(isset($_POST['etag']))$etag=$_POST['etag'];
 if(isset($_POST['square']))$square=$_POST['square'];
 if(isset($_POST['room']))$room=$_POST['room'];
 if(isset($_POST['vladelec']))$vladelec=$_POST['vladelec'];
 if(isset($_POST['price']))$price=$_POST['price'];


$db = new SQLite3('kvartira.db3');

switch ($act) {
    case "listall":
        $results = $db->query("select * from kvartira");
        $p="<table border=1><caption>Список квартир:</caption><tbody>";
        $p.="<tr><th>Район</th><th>Этаж</th><th>Площадь</th><th>Кол-во комнат</th><th>Владелец</th><th>Цена</th></tr>";
			while($r = $results->fetchArray()){
				$p.="<tr>";
				$p.= "<td>".$r['raon']."</td>";
                $p.= "<td>".$r['etag']."</td>";
				$p.= "<td>".$r['square']."</td>";
 				$p.= "<td>".$r['room']."</td>";
 				$p.= "<td>".$r['vladelec']."</td>";
 				$p.= "<td>".$r['price']."</td>";
				$p.="</tr>";
				}
		$p.="</tbody></table>";
		echo $p;
        break;
    case "zapros":
        switch ($s){         case "g":
         if($g=='' ){
          	 echo "Не указан этаж, посмотрите все записи ";
          	 $results = $db->query("select * from kvartira where 1=1");
          }
          else {
          $results = $db->query("select * from kvartira where etag='".$g."'");
          }
          break;
         case "list":
          if($b1=='' || $b2=='' ){
          	 echo "Неправильный диапазон, выводим все записи ";
          	 $results = $db->query("select * from kvartira where 1=1");
          }
          else {
          echo "Площадь от: ".$b1." и до: ".$b2;
          $results = $db->query("select * from kvartira where square between $b1 and $b2");
          }
          break;
        }
         $p="<table border=1><caption>Список квартир:</caption><tbody>";
         $p.="<tr><th>Район</th><th>Этаж</th><th>Площадь</th><th>Кол-во комнат</th><th>Владелец</th><th>Цена</th></tr>";
			while($r = $results->fetchArray()){
				$p.="<tr>";
				$p.= "<td>".$r['raon']."</td>";
                $p.= "<td>".$r['etag']."</td>";
				$p.= "<td>".$r['square']."</td>";
 				$p.= "<td>".$r['room']."</td>";
 				$p.= "<td>".$r['vladelec']."</td>";
 				$p.= "<td>".$r['price']."</td>";
				$p.="</tr>";
				}
		$p.="</tbody></table>";
		echo $p;

        break;
    case "insert":
        if($raon=='' || $etag==''||$square==''||$room==''||$vladelec==''||$price==''){
         echo "Заполниите все поля!!";
        }
        else{
         $z="INSERT INTO kvartira (
                         raon,
                         etag,
                         square,
                         room,
                         vladelec,
                         price
                     )
                     VALUES (
                         '".$raon."',
                         '".$etag."',
                         '".$square."',
                         '".$room."',
                         '".$vladelec."',
                         '".$price."')";
        $results = $db->query($z);
        echo "Запись вставлена";        }
        break;
}
echo"<br><br><center><a href='kvartira.html'>На главную страницу</a></center>";
?>