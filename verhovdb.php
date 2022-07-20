<?php
$act=$_GET['act'];
$step=$_GET['s'];
$p1=$_POST['p1'];
$p2=$_POST['p2'];

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
          break;
         case "list":
          break;
        }
        echo "i это пирог";
        break;
    case "insert":
        echo "i это пирог";
        break;
}


//$results = $db->query("insert into ver (id,ver,name,usr) values(null,1,'".date("d.m.y H:i",strtotime("+3 hour"))."','')");
//echo date("d.m.y H:i",strtotime("+3 hour"));
echo"<br><br><center><a href='verhovdb.html'>Перейти в начало</a></center>";
?>