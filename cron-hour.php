<?php
$db = new SQLite3('version.db');
/*
$results = $db->query('CREATE TABLE ver (
    id   INTEGER    PRIMARY KEY AUTOINCREMENT,
    ver  NUMERIC,
    name TEXT (200),
    usr  TEXT (200) 
);');
*/


$results = $db->query("insert into ver (id,ver,name,usr) values(null,1,'".date("d.m.y H:i",strtotime("+3 hour"))."','')");
echo date("d.m.y H:i",strtotime("+3 hour")); 

?>