<?php
https://www.cyberforum.ru/php-database/thread452055.html
$db = new SQLite3('version.db');
$name=$_GET['name'];
$usr=$_GET['usr'];
/*
$results = $db->query('CREATE TABLE ver (
    id   INTEGER    PRIMARY KEY AUTOINCREMENT,
    ver  NUMERIC,
    name TEXT (200),
    usr  TEXT (200) 
);');
*/
$results = $db->query("select ver from ver where name='$name' and usr='$usr' order by id desc");
if($results){
$r=$results->fetchArray();
echo ">".$r['ver'];}
else
{echo"NOT FOUND!!!";}
?>