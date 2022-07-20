<?php
 if(isset($_GET['act']))$act=$_GET['act'];
 if(isset($_GET['s']))$step=$_GET['s'];
 if(isset($_POST['p1']))$p1=$_POST['p1'];
 if(isset($_POST['p2']))$p2=$_POST['p2'];
 if(isset($_POST['naz']))$naz=$_POST['naz'];

$db = new SQLite3('verhov.db');

switch ($act) {
    case "create":
       $results = $db->query('CREATE TABLE IF NOT EXISTS zg ('.
    'list  NUMERIC,
    name TEXT (200),
    god  NUMERIC,
    nomer  NUMERIC,
    cena  NUMERIC,
    obloz TEXT (2000),
    izd  TEXT (200));');

        echo "База создана<br>";
        break;
    case "listall":
        $results = $db->query("select * from zg");
        $p="<table border=1><caption>Записи о журналах:</caption><tbody>";
        $p.="<tr><th>Название</th></tr>";
			while($r = $results->fetchArray()){
				$p.="<tr>";
				$p.= "<td>".$r['name']."</td>";

				$p.="</tr>";
				}
		$p.="</tbody></table>";
		echo $p;
        break;
    case "zapros":
        switch ($step){         case "naz":
          $results = $db->query("select * from zg where name='$naz'");

          break;
         case "list":
          $results = $db->query("select * from zg where list between $p1 and $p2");

          break;
        }
        echo "zapros";
        break;
    case "insert":
        echo "insert";
        break;
}


//$results = $db->query("insert into ver (id,ver,name,usr) values(null,1,'".date("d.m.y H:i",strtotime("+3 hour"))."','')");
//echo date("d.m.y H:i",strtotime("+3 hour"));
echo"<br><br><center><a href='verhovdb.html'>Перейти в начало</a></center>";
?>